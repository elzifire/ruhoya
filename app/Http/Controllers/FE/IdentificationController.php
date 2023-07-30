<?php

namespace App\Http\Controllers\FE;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IdentificationController extends Controller
{
    public function index()
    {
        return view("pages.fe.identification.index");
    }
}
