<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Product\CategoryController;
use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);


Route::middleware('auth:sanctum')->group( function () {
    Route::get('user',       [AuthController::class, 'me']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::group(['middleware' => ['admin']], function () {
        Route::get('/getProducts', [ProductController::class, 'getProduct']);
    });

    Route::group(['middleware' => ['admin']], function () {
//        Route::resource('categories',CategoryController::class);
    });

    Route::group(['prefix'=>'users'],function (){
        Route::post('/update/info/{id}', [UserController::class, 'updateUser']);
    });
});

