<?php

use App\Http\Controllers\ActController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::middleware('auth')->group(function () {    
    
    Route::get("/", [HomeController::class, 'index'])->name("home");

    Route::get('act/index', [ActController::class, 'index'])->name("act.index");
   

});

//Route::get("/", [HomeController::class, 'index'])->name("home");
Route::get("logout", [AuthController::class, "logout"])->name("logout");
Route::get("login/corp", function () {    
    return redirect( env("URL_CORP") . '/login?SIS=ACT');
})->name("login");

Route::any('api/auth/{token}', [AuthController::class, 'authenticate']);
