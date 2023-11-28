<?php

namespace App\Http\Controllers\BE;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Http\Controllers\Controller;

use App\Helpers\HttpStatus;
use App\Helpers\HttpMessage;

use App\Models\Base\ResponseModel;
use App\Models\Collaborator as Model;

use DB;
use DataTables;

class CollaboratorController extends Controller
{

    public function index()
    {
        return view('pages.be.collaborator.index');
    }

    public function api(Request $request)
    {
        $model = Model::orderBy("sequence", "ASC");

        return DataTables::of($model)
                ->filter(function ($query) use ($request) {
                    $filterable = [
                        "name",
                        "institute",
                        "contribution",
                        "image",
                        "sequence",
                    ];

                    $search = $request["search"]["value"];
                    if ($search) {
                        foreach ($filterable as $key => $column) {
                            $query->orWhere($column, "like", "%$search%");
                        }    
                    }
                })
                ->addIndexColumn()
                ->addColumn('image', function($data) {
                    $src = url("uploads/" . $data->image);
                    return "<img src='$src' width='250' >";
                })
                ->addColumn('action', function($data) {
                    return view("components.action", [
                        "edit"      => url("admin/collaborator/edit/".$data->id),
                        "delete"    => url("admin/collaborator/delete/".$data->id),
                    ]);
                })
                ->rawColumns(['image', 'action'])
                ->make(true);
    }

    public function create()
    {
        $action = url('admin/collaborator/store');
        return view("pages.be.collaborator.form", compact("action"));
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
            $payload["image"] = $request->file("image")->store("collaborators");
            $data = Model::create($payload);
            
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
        $action = url('admin/collaborator/update/' . $id);
        $data   = Model::findOrFail($id);

        return view("pages.be.collaborator.form", compact("action", "data"));
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
            if ($request->file("image"))
                $payload["image"] = $request->file("image")->store("collaborators");
                
            $data   = Model::findOrFail($id);
            $data->update($payload);

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
