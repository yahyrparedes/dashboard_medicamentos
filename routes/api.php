<?php

use App\Http\Controllers\Api\AuthenticationController;
use App\Http\Controllers\Api\DocumentTypeController;
use App\Http\Controllers\Api\GenderController;
use App\Http\Controllers\Api\DoctorController;
use App\Http\Controllers\Api\Mailing;
use App\Http\Controllers\Api\MedicationController;
use App\Http\Controllers\Api\PatientController;
use App\Http\Controllers\Api\PharmacyController;
use App\Http\Controllers\Api\ReminderController;
use App\Http\Controllers\Api\ReminderDetailController;
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


Route::get('recovery-password/{email}', [Mailing::class, 'sendMail']);
Route::post('recovery-password', [AuthenticationController::class, 'validateToken']);
Route::post('change-password', [AuthenticationController::class, 'changePassword']);

Route::get('departments', [UbigeoController::class, 'departments']);
Route::get('provinces/{id}', [UbigeoController::class, 'provincesByDepartmentID']);
Route::get('districts/{id}', [UbigeoController::class, 'districtsByProvinceID']);
Route::get('genders', [GenderController::class, 'list']);
Route::get('documents', [DocumentTypeController::class, 'list']);

Route::get('doctors', [DoctorController::class, 'list']);
Route::get('doctors/{id}/patients', [PatientController::class, 'patientsByDoctor']);
Route::delete('doctors/{doctor}/patients/{patient}', [PatientController::class, 'deletePatientByDoctor']);
Route::get('doctor/reminder/detail/{id}', [DoctorController::class, 'reminderDetail']);
Route::post('doctor/patient/filter', [DoctorController::class, 'filterPatients']);
Route::post('doctor/patient', [DoctorController::class, 'addPatientToDoctor']);
Route::get('patients', [PatientController::class, 'list']);
Route::get('medication/types', [MedicationController::class, 'types']);
Route::get('medication/units', [MedicationController::class, 'units']);
Route::get('medications', [MedicationController::class, 'list']);

Route::post('auth/register', [AuthenticationController::class, 'register']);
Route::post('auth/login', [AuthenticationController::class, 'login']);
Route::post('auth/profile', [AuthenticationController::class, 'profile']);

Route::get('pharmacies', [PharmacyController::class, 'list']);
Route::post('pharmacies/stores', [PharmacyController::class, 'stores']);
Route::get('pharmacies/store/{id}', [PharmacyController::class, 'detail']);


Route::get('reminders', [ReminderController::class, 'list']);
Route::post('reminder', [ReminderController::class, 'create']);
Route::delete('reminder/{id}', [ReminderController::class, 'delete']);
Route::get('reminder/{id}', [ReminderController::class, 'detail']);
Route::get('reminder-full-detail/{id}', [ReminderController::class, 'fullDetail']);
Route::post('reminder/filter', [ReminderController::class, 'filter']);
Route::post('reminder/status', [ReminderController::class, 'status']);

Route::get('reminder-details', [ReminderDetailController::class, 'list']); // all
Route::get('reminder-details/{reminder}', [ReminderDetailController::class, 'listByReminder']); // allByReminderId
Route::post('reminder-detail', [ReminderDetailController::class, 'create']); // create
Route::get('reminder-detail/{id}', [ReminderDetailController::class, 'detail']); // detail
