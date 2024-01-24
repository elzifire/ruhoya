<?php

namespace App\Http\Controllers\BE;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

use App\Http\Controllers\Controller;

use App\Helpers\HttpStatus;
use App\Helpers\HttpMessage;

use App\Models\Base\ResponseModel;
use App\Models\Morfology as Model;
use App\Models\Enumeration;

use DB;
use DataTables;

class MorfologyController extends Controller
{

    public function index()
    {
        return view('pages.be.morfology.index');
    }

    public function api(Request $request)
    {
        $model = Model::orderBy("created_at", "DESC");

        return DataTables::of($model)
                ->filter(function ($query) use ($request) {
                    $filterable = [
                        "name",
                        "slug",
                        "yes_no_question",
                    ];

                    $search = $request["search"]["value"];
                    if ($search) {
                        foreach ($filterable as $key => $column) {
                            $query->orWhere($column, "like", "%$search%");
                        }    
                    }
                })
                ->addIndexColumn()
                ->addColumn('yes_no_question', function($data) {
                    return $data->yes_no_question ? "Ya" : "Tidak";
                })
                ->addColumn('action', function($data) {
                    return view("components.action", [
                        "edit"      => url("admin/morfology/edit/".$data->id),
                        "delete"    => url("admin/morfology/delete/".$data->id),
                    ]);
                })
                ->rawColumns(['action'])
                ->make(true);
    }

    public function create()
    {
        $action = url('admin/morfology/store');
        return view("pages.be.morfology.form", compact("action"));
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
            $options    = $payload["options"] ?? [];
            unset($payload["options"]);

            $payload["slug"] = Str::snake($payload["name"]);
            $payload["yes_no_question"] = (isset($payload["yes_no_question"]) || !empty($payload["yes_no_question"])) ? $payload["yes_no_question"] : 0;
            $data = Model::create($payload);
            
            foreach ($options as $key => $option) {
                Enumeration::create([
                    "group" => "Morfologi",
                    "key"   => "Morfologi_" . $payload["slug"],
                    "value" => $option["value"]
                ]);
            }

            $response->data = $data;
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
        $action = url('admin/morfology/update/' . $id);
        $data   = Model::findOrFail($id);
        $data->options = Enumeration::where("key", "Morfologi_" . Str::snake($data->name))->get();

        return view("pages.be.morfology.form", compact("action", "data"));
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
            $options    = $payload["options"] ?? [];
            unset($payload["options"]);

            $payload["slug"] = Str::snake($payload["name"]);
            $payload["yes_no_question"] = (isset($payload["yes_no_question"]) || !empty($payload["yes_no_question"])) ? 1 : 0;

            $data   = Model::findOrFail($id);
            $data->update($payload);

            $morfologyIds   = [];
            foreach ($options as $key => $option) {
                $payload = [
                    "group" => "Morfologi",
                    "key"   => "Morfologi_" . $data->slug,
                    "value" => $option["value"]
                ];

                if (isset($option["id"])) {
                    $option  = Enumeration::findOrFail($option["id"]);
                    $option->update($payload);
                } else {
                    $option = Enumeration::create($payload);
                }

                array_push($morfologyIds, $option->id);
            }

            Enumeration::where("key", "Morfologi_" . $data->slug)->whereNotIn("id", $morfologyIds)->delete();

            $response->data = $data;
    		DB::commit();

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
