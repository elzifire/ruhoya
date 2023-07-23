<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use App\Helpers\HttpStatus;
use App\Helpers\HttpMessage;

use App\Models\Base\ResponseModel;
use App\Models\Hoya;
use App\Models\HoyaSpread;

use DB;

class HomeController extends Controller
{

    public function index(Request $request)
    {
        if ($request->mode === "load-hoya") return $this->loadHoya();
        return view("pages.home.index");
    }

    public function loadHoya()
    {
        $response = new ResponseModel();
        $data = Hoya::all();

        $response->data = $data;
        
        return response()->json($response, $response->status_code);
    }
}
