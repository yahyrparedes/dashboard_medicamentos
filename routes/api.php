<?php

use App\Http\Controllers\Api\AuthenticationController;
use App\Http\Controllers\Api\DocumentTypeController;
use App\Http\Controllers\Api\GenderController;
use App\Http\Controllers\Api\DoctorController;
use App\Http\Controllers\Api\MedicationController;
use App\Http\Controllers\Api\PharmacyController;
use App\Http\Controllers\Api\UbigeoController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('departments', [UbigeoController::class, 'departments']);
Route::get('provinces/{id}', [UbigeoController::class, 'provincesByDepartmentID']);
Route::get('districts/{id}', [UbigeoController::class, 'districtsByProvinceID']);
Route::get('genders', [GenderController::class, 'list']);
Route::get('documents', [DocumentTypeController::class, 'list']);

Route::get('doctors', [DoctorController::class, 'list']);
Route::get('medication/types', [MedicationController::class, 'types']);
Route::get('medication/units', [MedicationController::class, 'units']);
Route::get('medications', [MedicationController::class, 'list']);

Route::post('auth/register', [AuthenticationController::class, 'register']);
Route::post('auth/login', [AuthenticationController::class, 'login']);
Route::post('auth/profile', [AuthenticationController::class, 'profile']);

Route::get('pharmacies', [PharmacyController::class, 'list']);
Route::post('pharmacies/stores', [PharmacyController::class, 'stores']);