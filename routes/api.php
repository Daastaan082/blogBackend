<?php
use App\Http\Controllers\BlogController;
use App\Http\Controllers\AuthController;

use Illuminate\Http\Request;
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

Route::post('blogs',[BlogController::class,'store']);
Route::put('update/{id}',[BlogController::class,'update']);
Route::get('blogs/{id}',[BlogController::class,'show']);
Route::get('blogsee',[BlogController::class,'index']);
Route::delete('blogs/{id}',[BlogController::class,'destroy']);
Route::post('register',[AuthController::class,'register']);
Route::post('login',[AuthController::class,'login']);
Route::post('logout',[AuthController::class,'logout']);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
