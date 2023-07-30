<?php

namespace App\Http\Controllers\FE;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Hoya;

class DatabaseController extends Controller
{
    public function index(Request $request)
    {
        $data = Hoya::orderBy("name", "ASC");

        if ($request->search)
            $data = $data->where("name", "like", "%$request->search%");

        $data   = $data->paginate(20)->withQueryString();
        return view("pages.fe.database.index", compact("data"));
    }

    public function find($id)
    {
        $data = Hoya::findOrFail($id);
        return view("pages.fe.database.detail", compact("data"));
    }
}
