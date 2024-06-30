<?php

use App\Http\Controllers\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\WarshaController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['prefix'=>'user'],function(){

    Route::post('register',[RegisterController::class,'Register']);
    Route::post('send-code',[RegisterController::class,'SendCode']);
    Route::post('check-code',[RegisterController::class,'CheckCode']);
    Route::post('login',[LoginController::class,'Login']);
    Route::delete('logout',[LoginController::class,'Logout']);
});

// Route::group(['prefix'=>'user','middleware'=>'auth:sanctum'],function(){

//     Route::get('warshas',[WarshaController::class,'GetAllWarsha']);
//     Route::get('warsha-info/{id}',[WarshaController::class,'GetWarshaInfo']);

// });

Route::group(['prefix'=>'user'],function(){

    Route::get('warshas',[WarshaController::class,'GetAllWarsha']);
    Route::get('warsha-info/{id}',[WarshaController::class,'GetWarshaInfo']);

    Route::get('fanys',[WarshaController::class,'GetAllFany']);
    Route::get('fany-info/{id}',[WarshaController::class,'GetFanyInfo']);

    Route::get('wenshs',[WarshaController::class,'GetAllWenshs']);
    Route::get('wensh-info/{id}',[WarshaController::class,'GetWenshInfo']);

});

