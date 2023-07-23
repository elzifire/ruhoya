<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use App\Helpers\HttpStatus;
use App\Helpers\HttpMessage;

use App\Models\Base\ResponseModel;
use App\Models\User;

use DB;

class AuthController extends Controller
{

    public function index()
    {
        return view("pages.auth.login");
    }

    public function login(Request $request)
    {
        $response = new ResponseModel(HttpStatus::NOT_FOUND, HttpMessage::AUTH_NO_RECORD);
        $credential = [
            'email'     => $request->email,
            'password'  => $request->password,
        ];

        if (Auth::attempt($credential, (bool)$request->remember_me)) {
            Auth::guard('web')->attempt($credential);

            $response->status_code = HttpStatus::SUCCESS;
            $response->message     = HttpMessage::AUTH_SUCCESS_LOGIN;
            $response->redirect_to = url("/");
        }

        return response()->json($response, $response->status_code);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/login');
    }

    public function forgot()
    {
        return view("forgot-password");
    }

    public function changePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "old_password" => "required",
            "new_password" => "required",
            "confirm_new_password" => "required|same:new_password",
        ]);

        if ($validator->fails()) {
            return response()->json(["status_code" => 400, "message" => "Validation error", "errors" => $validator->errors()]);
        }

        DB::beginTransaction();
        try {
            if (Hash::check($request->old_password, Auth::user()->password)) {
                $user = User::find(Auth::user()->id);
                $user->update(["password" => bcrypt($request->new_password)]);

                Log::addToLog("User {$user->name} mengganti password", "-", "-");
                DB::commit();

                return response()->json(["status_code" => 200, "message" => "Sukses Mengganti Password", "data" => null]);
            }

            return response()->json(["status_code" => 500, "message" => "Password lama tidak sesuai", "data" => null]);
        } catch (Exception $e) {
            DB::rollback();
            return response()->json(["status_code" => 500, "message" => $e->getMessage(), "data" => null]);
        }
    }
}
