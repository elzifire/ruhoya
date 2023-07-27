<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Helpers\HttpStatus;
use App\Helpers\HttpMessage;

use App\Models\Base\ResponseModel;
use App\Models\Hoya as Model;
use App\Models\HoyaImage;
use App\Models\HoyaSpread;

use DB;
use DataTables;

class HoyaController extends Controller
{

    public function index()
    {
        return view('pages.hoya.index');
    }

    public function api(Request $request)
    {
        $model = Model::orderBy("id", "DESC");

        return DataTables::of($model->get())
                ->addIndexColumn()
                ->addColumn('action', function($data) {
                    return view("components.action", [
                        "edit"      => url("admin/hoya/edit/".$data->id),
                        "delete"    => url("admin/hoya/delete/".$data->id),
                    ]);
                })
                ->rawColumns(['action'])
                ->make(true);
    }

    public function create()
    {
        $action = url('admin/hoya/store');
        return view("pages.hoya.form", compact("action"));
    }

    public function store(Request $request)
    {
        $response = new ResponseModel(HttpStatus::SUCCESS, HttpMessage::SUCCESS_INSERT);

        $payload = $request->all();
        $validator = Validator::make($payload, Model::rules());

        if ($validator->fails()) {
            $response->status_code  = HttpStatus::VALIDATION_ERROR;
            $response->message      = HttpMessage::VALIDATION_ERROR;
            $response->errors       = $validator->errors();
            return response()->json($response, $response->status_code);
        }

        DB::beginTransaction();
        try {
            $hoyaImages     = $payload["hoya_images"];
            $hoyaSpreads    = $payload["hoya_spreads"];
            unset($payload["hoya_images"], $payload["hoya_spreads"]);

            $data = Model::create($payload);
            $hoyaId = $data->id;

            $response->data = $data;
            $response->data->hoya_images    = [];
            $response->data->hoya_spreads   = [];

            foreach ($hoyaImages as $key => $hoyaImage) {
                $validator = Validator::make($hoyaImage, HoyaImage::rules());

                if ($validator->fails()) {
                    $response->status_code  = HttpStatus::VALIDATION_ERROR;
                    $response->message      = HttpMessage::VALIDATION_ERROR;
                    $response->errors       = $validator->errors();
                    $response->data         = null;
                    return response()->json($response, $response->status_code);
                }

                HoyaImage::create([
                    "hoya_id"       => $hoyaId,
                    "image"         => $hoyaImage["file"]->store("hoya"),
                    "description"   => $hoyaImage["description"]
                ]);
            }

            foreach ($hoyaSpreads as $key => $hoyaSpread) {
                $validator = Validator::make($hoyaSpread, HoyaSpread::rules());

                if ($validator->fails()) {
                    $response->status_code  = HttpStatus::VALIDATION_ERROR;
                    $response->message      = HttpMessage::VALIDATION_ERROR;
                    $response->errors       = $validator->errors();
                    $response->data         = null;
                    return response()->json($response, $response->status_code);
                }

                HoyaSpread::create([
                    "hoya_id"       => $hoyaId,
                    "latitude"      => $hoyaSpread["latitude"],
                    "longitude"     => $hoyaSpread["longitude"],
                    "description"   => $hoyaSpread["description"]
                ]);
            }

    		DB::commit();

            return response()->json($response);
        } catch (Exception $e) {
            DB::rollback();

            $response->status_code  = HttpStatus::INTERNAL_SERVER_ERROR;
            $response->message      = $e->getMessage();
            return response()->json($response);
        }
    
    }
    public function edit($id)
    {
        $action = url('admin/hoya/update/' . $id);
        $data   = Model::findOrFail($id);

        return view("pages.hoya.form", compact("action", "data"));
    }

    public function update(Request $request, $id)
    {
        $response = new ResponseModel(HttpStatus::SUCCESS, HttpMessage::SUCCESS_UPDATE);

        $payload = $request->all();
        $validator = Validator::make($payload, Model::rules());

        if ($validator->fails()) {
            $response->status_code  = HttpStatus::VALIDATION_ERROR;
            $response->message      = HttpMessage::VALIDATION_ERROR;
            $response->errors       = $validator->errors();
            return response()->json($response, $response->status_code);
        }

        DB::beginTransaction();
        try {
            $hoyaImages     = $payload["hoya_images"];
            $hoyaSpreads    = $payload["hoya_spreads"];
            unset($payload["hoya_images"], $payload["hoya_spreads"]);

            $data   = Model::findOrFail($id);
            $data->update($payload);
            $hoyaId = $data->id;

            $response->data = $data;
            $response->data->hoya_images    = [];
            $response->data->hoya_spreads   = [];

            $hoyaImageIds   = [];
            $hoyaSpreadIds  = [];

            foreach ($hoyaImages as $key => $hoyaImage) {
                $validator = Validator::make($hoyaImage, HoyaImage::rules(true));

                if ($validator->fails()) {
                    $response->status_code  = HttpStatus::VALIDATION_ERROR;
                    $response->message      = HttpMessage::VALIDATION_ERROR;
                    $response->errors       = $validator->errors();
                    $response->data         = null;
                    return response()->json($response, $response->status_code);
                }

                $payload = [
                    "hoya_id"       => $hoyaId,
                    "description"   => $hoyaImage["description"]
                ];

                if (isset($hoyaImage["file"]))
                    $payload["image"] = $hoyaImage["file"]->store("hoya");

                if (isset($hoyaImage["id"])) {
                    $hoyaImage  = HoyaImage::findOrFail($hoyaImage["id"]);
                    $hoyaImage->update($payload);
                } else {
                    $hoyaImage = HoyaImage::create($payload);
                }

                array_push($hoyaImageIds, $hoyaImage["id"]);
            }

            foreach ($hoyaSpreads as $key => $hoyaSpread) {
                $validator = Validator::make($hoyaSpread, HoyaSpread::rules());

                if ($validator->fails()) {
                    $response->status_code  = HttpStatus::VALIDATION_ERROR;
                    $response->message      = HttpMessage::VALIDATION_ERROR;
                    $response->errors       = $validator->errors();
                    $response->data         = null;
                    return response()->json($response, $response->status_code);
                }

                $payload = [
                    "hoya_id"       => $hoyaId,
                    "latitude"      => $hoyaSpread["latitude"],
                    "longitude"     => $hoyaSpread["longitude"],
                    "description"   => $hoyaSpread["description"]
                ];

                if (isset($hoyaSpread["id"])) {
                    $hoyaSpread  = HoyaSpread::findOrFail($hoyaSpread["id"]);
                    $hoyaSpread->update($payload);
                } else {
                    $hoyaSpread = HoyaSpread::create($payload);
                }

                array_push($hoyaSpreadIds, $hoyaSpread["id"]);
            }

            HoyaImage::whereNotIn("id", $hoyaImageIds)->delete();
            HoyaSpread::whereNotIn("id", $hoyaSpreadIds)->delete();

    		DB::commit();
            $response->data = $data;

            return response()->json($response, $response->status_code);
        } catch (Exception $e) {
            DB::rollback();

            $response->status_code  = HttpStatus::INTERNAL_SERVER_ERROR;
            $response->message      = $e->getMessage();
            return response()->json($response);
        }
    }

    public function destroy($id)
    {
        $response = new ResponseModel(HttpStatus::SUCCESS, HttpMessage::SUCCESS_DELETE);

        DB::beginTransaction();
        try 
        {
            $data   = Model::findOrFail($id);
            $data->delete();

            DB::commit();

            return response()->json($response, $response->status_code);
        }
        catch (Exception $e) 
        {
            DB::rollback();

            $response->status_code  = HttpStatus::INTERNAL_SERVER_ERROR;
            $response->message      = $e->getMessage();
            return response()->json($response, $response->status_code);
        }
    }
}
