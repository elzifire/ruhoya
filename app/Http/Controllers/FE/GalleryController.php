<?php

namespace App\Http\Controllers\FE;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\HoyaImage;

class GalleryController extends Controller
{
    public function index()
    {
        $data = HoyaImage::whereHas("hoya")->paginate(21)->withQueryString();
        return view("pages.fe.gallery.index", compact("data"));
    }
}
