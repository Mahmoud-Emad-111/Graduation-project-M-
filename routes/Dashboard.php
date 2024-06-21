<?php

use App\Http\Controllers\DoctorCategoryController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\LabCategoryController;
use App\Http\Controllers\LabController;
use App\Http\Controllers\PhysiotherapyCentreController;
use App\Http\Controllers\UserController;
use App\Models\Doctor_Category;
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


Route::controller(UserController::class)->prefix('/Users/')->group(function () {
    Route::get('Get', 'Get_All_Users');
});

Route::controller(DoctorCategoryController::class)->prefix('/Doctors_Categories/')->group(function () {
    Route::post('Store','Store');
    Route::get('Get','Get_All_Categories');
    Route::post('Delete','Delete');
    Route::post('Update','Update');

});

Route::controller(DoctorController::class)->prefix('/Doctors/')->group(function () {
    // Route::post('Store','Store');
    Route::post('Register', 'Register');

    Route::get('Get','Get');
    Route::post('Show','Show');
    Route::post('Update','Update')->middleware('auth:sanctum,Doctor');
    Route::post('Delete','Delete')->middleware('auth:sanctum,Doctor');
});

Route::controller(LabCategoryController::class)->prefix('/Labs_Categories/')->group(function () {
    Route::post('Store','Store');
    Route::get('Get','Get_All_Categories');
    Route::post('Delete','Delete');
    Route::post('Update','Update');

});

Route::controller(LabController::class)->prefix('/Lab/')->group(function () {
    Route::post('Store','Store');
    Route::get('Get','Get_All_Categories');
    Route::post('Show','Show');
    Route::post('Update','Update');
    Route::post('Delete','Delete');
});

Route::controller(PhysiotherapyCentreController::class)->prefix('/PhysiotherapyCentre/')->group(function () {
    Route::post('Store','Store');
    Route::get('Get','Get');
    Route::post('Show','Show');
    Route::post('Update','Update');
    Route::post('Delete','Delete');
});
