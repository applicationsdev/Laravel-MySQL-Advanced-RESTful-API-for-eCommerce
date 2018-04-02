<?php

use Illuminate\Http\Request;

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

// User
Route::resource('users', 'UserController', ['except' => ['create', 'edit']]);
Route::resource('clients', 'ClientController', ['only' => ['index', 'show']]);
Route::resource('merchants', 'MerchantController', ['only' => ['index', 'show']]);
