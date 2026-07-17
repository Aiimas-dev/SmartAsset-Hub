<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/


/*
|--------------------------------------------------------------------------
| Authentication API
|--------------------------------------------------------------------------
*/


Route::post('/register', [
    AuthController::class,
    'register'
]);


Route::post('/login', [
    AuthController::class,
    'login'
]);





/*
|--------------------------------------------------------------------------
| Protected API (Sanctum Token)
|--------------------------------------------------------------------------
*/


Route::middleware('auth:sanctum')->group(function () {



    /*
    |--------------------------------------------------------------------------
    | Auth User
    |--------------------------------------------------------------------------
    */


    Route::post('/logout', [
        AuthController::class,
        'logout'
    ]);


    Route::get('/user', function () {


        return response()->json([

            'user' => auth()->user()

        ]);


    });






    /*
    |--------------------------------------------------------------------------
    | Category Management
    |--------------------------------------------------------------------------
    */


    Route::apiResource(
        'categories',
        CategoryController::class
    );



});