<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AuthController;

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




Route::post('/post',[PostController::class, 'showPost']);

Route::get('/user/login/{name}/{password}',[AuthController::class, 'logInUser'])
    ->middleware('guest');
Route::post('/post/edit/',[PostController::class, 'updatePost'])
    ->middleware('admin');

Route::get('/user/create/{name}/{email}/{password}',[AuthController::class, 'register'])
    ->middleware('guest');
Route::get('/user/status/',[AuthController::class, 'getUserStatus']);
Route::get('/user/logout/',[AuthController::class, 'logOutUser']);

Route::get('/{any}', function () {
    return view('index');
})->where('any','.*');



