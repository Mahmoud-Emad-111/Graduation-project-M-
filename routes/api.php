<?php

use App\Http\Controllers\DoctorCategoryController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\LabCategoryController;
use App\Http\Controllers\LabController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(UserController::class)->prefix('/Auth/')->group(function () {

    Route::post('Register', 'Register');
    Route::post('Login', 'Login');
    Route::post('Logout', 'logout')->middleware('auth:sanctum');
    Route::get('Profile', 'ProfileUser')->middleware('auth:sanctum');

});

Route::controller(DoctorCategoryController::class)->prefix('/Doctors_Categories/')->group(function () {
    Route::get('Get','Get_All_Categories');
});


Route::controller(DoctorController::class)->prefix('/Doctors/')->group(function () {
    Route::get('Get','Get');
    Route::post('Register', 'Register');
    Route::post('Login', 'Login');

    Route::post('Show','Show');
});


Route::controller(LabCategoryController::class)->prefix('/Labs_Categories/')->group(function () {
    Route::get('Get','Get_All_Categories');
});

Route::controller(LabController::class)->prefix('/Lab/')->group(function () {
    Route::get('Get','Get_All_Categories');
    Route::post('Show','Show');

});










