<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    PoliticoController,
    ProcessoController,
    UserController,
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

// Politicos
Route::get('/politico/search', [PoliticoController::class, 'searchPoliticos']);
Route::get('/processo/search', [ProcessoController::class, 'searchProcessess']);

Route::group(['prefix' => 'auth'], function ($router) {
    Route::post('/register', [UserController::class, 'register']);
    Route::post('/login', [UserController::class, 'login']);
});



Route::group(['middleware' => 'auth:api'], function ($router) {

    Route::group(['prefix' => 'auth'], function ($router) {
        Route::post('/logout', [UserController::class, 'logout']);
        Route::get('/logged_user', [UserController::class, 'loggedUser']);
    });

    Route::group(['prefix' => 'politico'], function ($router) {
        Route::get('/{politico}/get', [PoliticoController::class, 'getPolitico']);
        Route::post('/create', [PoliticoController::class, 'createPolitico']);
        Route::patch('/{politico}/edit', [PoliticoController::class, 'editPolitico']);
        Route::delete('/{politico}/delete', [PoliticoController::class, 'deletePolitico']);
    });

    Route::group(['prefix' => 'processo'], function ($router) {
        Route::get('/{processo}/get', [ProcessoController::class, 'getProcesso']);
        Route::post('/create', [ProcessoController::class, 'createProcesso']);
        Route::patch('/{processo}/edit', [ProcessoController::class, 'editProcesso']);
        Route::delete('/{processo}/delete', [ProcessoController::class, 'deleteProcesso']);
    });

});


