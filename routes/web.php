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
});
