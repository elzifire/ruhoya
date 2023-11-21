<?php

namespace App\Http\Controllers\BE;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Http\Controllers\Controller;

use App\Helpers\HttpStatus;
use App\Helpers\HttpMessage;

use App\Models\Base\ResponseModel;
use App\Models\User as Model;

use DB;
use DataTables;

class UserController extends Controller
{

    public function index()
    {
        return view('pages.be.user.index');
    }

    public function api(Request $request)
    {
        $model = Model::get();

        return DataTables::of($model)
                ->addIndexColumn()
                ->addColumn('action', function($data) {
                    return view("components.action", [
                        "edit"      => url("admin/user/edit/".$data->id),
                        "delete"    => url("admin/user/delete/".$data->id),
                    ]);
                })
                ->rawColumns(['action'])
                ->make(true);
    }

    public function create()
    {
        $action = url('admin/user/store');
        return view("pages.be.user.form", compact("action"));
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
            $payload["password"] = bcrypt($payload["password"]);
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
        $action = url('admin/user/update/' . $id);
        $data   = Model::findOrFail($id);

        return view("pages.be.user.form", compact("action", "data"));
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
            $data   = Model::findOrFail($id);

            if (isset($payload["password"]) || !empty($payload["password"])) {
                $payload["password"] = bcrypt($payload["password"]);
            }
            
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
