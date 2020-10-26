<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    UserController
};

use App\Http\Middleware\{
    AuthMiddleware
};


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|



Route::group(['prefix' => 'user','namespace' => 'User'
],function(){
    Route::post('/register', [UserController::class, 'register']);
    Route::post('/login', [UserController::class, 'login']);
    Route::post('/logout', [UserController::class, 'logout']);
});

Route::group(['middleware' => ['auth:users']], function () {
    
    Route::get('/get_users', [UserController::class, 'getUsers']);
});

*/

Route::group(['prefix' => 'auth'], function ($router) {
    Route::post('/register', [UserController::class, 'register']);
    Route::post('/login', [UserController::class, 'login']);
});



Route::group(['middleware' => 'auth:api'], function ($router) {

    Route::group(['prefix' => 'auth'], function ($router) {
        Route::post('/logout', [UserController::class, 'logout']);
        Route::get('/logged_user', [UserController::class, 'loggedUser']);
    });

    

});


