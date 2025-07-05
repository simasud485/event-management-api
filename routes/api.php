<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\UsersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/healthcheck', function(){
    return response()->json(['message'=>'Api is working fine.']);
});

Route::post('/member-registration', [AuthController::class, 'memberRegistration']);

Route::post('/login', [AuthController::class, 'login']);
Route::get('/user/{id}', [AuthController::class, 'user'])->middleware('auth:sanctum');
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');


//get all users info
Route::get('/users', [UsersController::class, 'getUsers']);

//get single user info
//Route::get('/user/{id}', [UsersController::class, 'getUser']);

//create single user info
Route::post('/create-user', [UsersController::class, 'createUser']);

//update user info
Route::put('/update-user/{id}', [UsersController::class, 'updateUser']);

/**Event Routing**/
Route::get('/events', [EventsController::class,'events']);