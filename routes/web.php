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

Route::middleware("guest")->group(function() {
    Route::get("login", "AuthController@index")->name("login");
    Route::post("login", "AuthController@login");
});
Route::get("/", function() {
    return phpinfo();
});

Route::middleware("auth")->group(function() {

    Route::get("/hoya", "HoyaController@index");
    Route::get("/hoya/api", "HoyaController@api");
    Route::get("/hoya/create", "HoyaController@create");
    Route::post("/hoya/store", "HoyaController@store");
    Route::get("/hoya/edit/{id}", "HoyaController@edit");
    Route::post("/hoya/update/{id}", "HoyaController@update");
    Route::get("/hoya/delete/{id}", "HoyaController@destroy");

    Route::get("/insect-association", "InsectAssociationController@index");
    Route::get("/insect-association/api", "InsectAssociationController@api");
    Route::get("/insect-association/create", "InsectAssociationController@create");
    Route::post("/insect-association/store", "InsectAssociationController@store");
    Route::get("/insect-association/edit/{id}", "InsectAssociationController@edit");
    Route::post("/insect-association/update/{id}", "InsectAssociationController@update");
    Route::get("/insect-association/delete/{id}", "InsectAssociationController@destroy");
});
