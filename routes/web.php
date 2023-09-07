<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get("/", "FE\HomeController@index");
Route::get("/tentang", "FE\AboutController@index");
Route::get("/galeri", "FE\GalleryController@index");
Route::get("/identifikasi", "FE\IdentificationController@index");
Route::get("/tim-ahli", "FE\TeamController@index");
Route::get("/database", "FE\DatabaseController@index");
Route::get("/database/{id}", "FE\DatabaseController@find");

Route::middleware("guest")->group(function() {
    Route::get("login", "AuthController@index")->name("login");
    Route::post("login", "AuthController@login");
});

Route::middleware("auth")->group(function() {
    Route::get("logout", "AuthController@logout");
    
    Route::prefix("admin")->group(function() {
        Route::get("/", "BE\HomeController@index");
    
        Route::get("/hoya", "BE\HoyaController@index");
        Route::get("/hoya/api", "BE\HoyaController@api");
        Route::get("/hoya/create", "BE\HoyaController@create");
        Route::post("/hoya/store", "BE\HoyaController@store");
        Route::get("/hoya/edit/{id}", "BE\HoyaController@edit");
        Route::post("/hoya/update/{id}", "BE\HoyaController@update");
        Route::get("/hoya/delete/{id}", "BE\HoyaController@destroy");
        Route::get("/hoya/export", "BE\HoyaController@export");
        Route::get("/hoya/import", "BE\HoyaController@import");
        Route::post("/hoya/upload", "BE\HoyaController@upload");
    
        Route::get("/insect-association", "BE\InsectAssociationController@index");
        Route::get("/insect-association/api", "BE\InsectAssociationController@api");
        Route::get("/insect-association/create", "BE\InsectAssociationController@create");
        Route::post("/insect-association/store", "BE\InsectAssociationController@store");
        Route::get("/insect-association/edit/{id}", "BE\InsectAssociationController@edit");
        Route::post("/insect-association/update/{id}", "BE\InsectAssociationController@update");
        Route::get("/insect-association/delete/{id}", "BE\InsectAssociationController@destroy");
    
        Route::get("/pest", "BE\PestController@index");
        Route::get("/pest/api", "BE\PestController@api");
        Route::get("/pest/create", "BE\PestController@create");
        Route::post("/pest/store", "BE\PestController@store");
        Route::get("/pest/edit/{id}", "BE\PestController@edit");
        Route::post("/pest/update/{id}", "BE\PestController@update");
        Route::get("/pest/delete/{id}", "BE\PestController@destroy");
    
        Route::get("/slider", "BE\SliderController@index");
        Route::get("/slider/api", "BE\SliderController@api");
        Route::get("/slider/create", "BE\SliderController@create");
        Route::post("/slider/store", "BE\SliderController@store");
        Route::get("/slider/edit/{id}", "BE\SliderController@edit");
        Route::post("/slider/update/{id}", "BE\SliderController@update");
        Route::get("/slider/delete/{id}", "BE\SliderController@destroy");
    
        Route::get("/team", "BE\TeamController@index");
        Route::get("/team/api", "BE\TeamController@api");
        Route::get("/team/create", "BE\TeamController@create");
        Route::post("/team/store", "BE\TeamController@store");
        Route::get("/team/edit/{id}", "BE\TeamController@edit");
        Route::post("/team/update/{id}", "BE\TeamController@update");
        Route::get("/team/delete/{id}", "BE\TeamController@destroy");
    });
});
