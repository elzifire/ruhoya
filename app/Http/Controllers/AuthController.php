<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

use App\Helpers\HttpStatus;
use App\Helpers\HttpMessage;

use App\Models\Base\ResponseModel;
use App\Models\PasswordResetToken;
use App\Models\User;


use DB;

class AuthController extends Controller
{

    public function index()
    {
        return view("pages.auth.login");
    }

    public function register()
    {
        return view("pages.auth.register");
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name'      => 'required',
            'email'     => 'required|email|unique:users',
            'password'  => 'required|min:6',
        ]);

        $user = User::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => bcrypt($request->password),
        ]);

        if ($user) {
            return redirect('/login')->with('success', 'Registrasi berhasil, silahkan login');
        }else{
            return redirect('/register')->with('error', 'Registrasi gagal, silahkan coba lagi');
        }
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
            $response->redirect_to = url("/admin");
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
        return view("pages.auth.forgot");
    }

    public function sendResetLinkEmail(Request $request)
    {
        $mesaage = [
            'email.required' => 'Email harus diisi',
            'email.email' => 'Email tidak valid',
            'email.exists' => 'Email tidak terdaftar di sistem',
        ];

        $request->validate([
            'email' => 'required|email|exists:users,email',
        ], $mesaage); 

        PasswordResetToken::updateOrCreate(
        [
            'email' => $request->email,
        ].
        [
            'email' => $request->email,
            'token' => Str::random(60),
            'created_at' => now(),
        ]);

        $data = [
            'email' => $request->email,
        ];

        return redirect()->route('forgot')->with('success', 'Email reset password telah dikirim');
       
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
