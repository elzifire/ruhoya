<?php

namespace App\Http\Controllers\BE;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Http\Controllers\Controller;

use App\Helpers\HttpStatus;
use App\Helpers\HttpMessage;

use App\Models\Base\ResponseModel;
use App\Models\Hoya as Model;
use App\Models\HoyaImage;
use App\Models\HoyaSpread;
use App\Models\Enumeration;

use App\Exports\HoyaExport;
use App\Imports\HoyaImport;
use Maatwebsite\Excel\Facades\Excel;

use DB;
use DataTables;

class HoyaController extends Controller
{

    public function index()
    {
        return view('pages.be.hoya.index');
    }

    public function api(Request $request)
    {
        $model = Model::orderBy("id", "DESC");

        return DataTables::of($model)
                ->addIndexColumn()
                ->addColumn('name', function($data) {
                    return "Hoya <i>{$data->name}</i>, <b>{$data->author}</b>";
                })
                ->addColumn('action', function($data) {
                    return view("components.action", [
                        "edit"      => url("admin/hoya/edit/".$data->id),
                        "delete"    => url("admin/hoya/delete/".$data->id),
                    ]);
                })
                ->rawColumns(['name', 'action'])
                ->make(true);
    }

    public function create()
    {
        $action = url('admin/hoya/store');
        $deps   = [];
        $benefits   = Enumeration::where("key", "Benefit")->get();

        foreach (Model::ENUM_MORFOLOGY_KEYS as $key => $enum)
            $deps[$enum] = Enumeration::where("key", $enum)->get();

        return view("pages.be.hoya.form", compact("action", "deps", "benefits"));
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
            $hoyaImages     = $payload["hoya_images"] ?? [];
            $hoyaSpreads    = $payload["hoya_spreads"] ?? [];
            $payload["benefit"] = implode(",", $payload["benefit"] ?? []);

            unset($payload["hoya_images"], $payload["hoya_spreads"]);

            $data = Model::create($payload);
            $hoyaId = $data->id;

            $this->checkForBenefitEnumeration($request->benefit);

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
                    "description"   => $hoyaImage["description"],
                    "photographer"  => $hoyaImage["photographer"]
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
        $deps   = [];
        $benefits   = Enumeration::where("key", "Benefit")->get();

        foreach (Model::ENUM_MORFOLOGY_KEYS as $key => $enum)
            $deps[$enum] = Enumeration::where("key", $enum)->orderBy("value", "ASC")->get();

        return view("pages.be.hoya.form", compact("action", "data", "deps", "benefits"));
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
            $hoyaImages     = $payload["hoya_images"] ?? [];
            $hoyaSpreads    = $payload["hoya_spreads"] ?? [];
            $payload["benefit"] = implode(",", $payload["benefit"] ?? []);

            unset($payload["hoya_images"], $payload["hoya_spreads"]);

            $data   = Model::findOrFail($id);
            $data->update($payload);
            $hoyaId = $data->id;

            $this->checkForBenefitEnumeration($request->benefit);

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
                    "description"   => $hoyaImage["description"],
                    "photographer"  => $hoyaImage["photographer"]
                ];

                if (isset($hoyaImage["file"]))
                    $payload["image"] = $hoyaImage["file"]->store("hoya");

                if (isset($hoyaImage["id"])) {
                    $hoyaImage  = HoyaImage::findOrFail($hoyaImage["id"]);
                    $hoyaImage->update($payload);
                } else {
                    $hoyaImage = HoyaImage::create($payload);
                }

                array_push($hoyaImageIds, $hoyaImage->id);
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

            HoyaImage::where("hoya_id", $hoyaId)->whereNotIn("id", $hoyaImageIds)->delete();
            HoyaSpread::where("hoya_id", $hoyaId)->whereNotIn("id", $hoyaSpreadIds)->delete();

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

    public function export()
    {
        $t = date('dmyHis');
        return Excel::download(new HoyaExport, "hoya-{$t}.xlsx");
    }

    public function import()
    {
        $action = url('/admin/hoya/upload');
        return view("pages.be.hoya.import", compact("action"));
    }

    public function upload(Request $request)
    {
        $response = new ResponseModel(HttpStatus::SUCCESS, HttpMessage::SUCCESS_IMPORT);

        try {
            Excel::import(new HoyaImport, $request->file("file"));
            return response()->json($response);
        } catch (Exception $e) {
            $response->status_code  = HttpStatus::INTERNAL_SERVER_ERROR;
            $response->message      = $e->getMessage();
            return response()->json($response, $response->status_code);
        }
    }

    private function checkForBenefitEnumeration($benefits)
    {
        if (!is_array($benefits)) return;
        foreach ($benefits as $index => $benefit) {
            $count = Enumeration::where("value", $benefit)->count();
            if ($count < 1) Enumeration::insert([
                "group" => "Benefit",
                "key"   => "Benefit",
                "value" => $benefit
            ]);
        }
    }
}
