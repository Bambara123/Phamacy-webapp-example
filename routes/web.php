<?php

use App\Models\Prescriptions;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\userController;
use App\Http\Controllers\prescriptionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    $prescriptions = Prescriptions::all();
    return view('home', ['prescriptions' => $prescriptions]);
});

Route::get('/boots', function () {

    return view('boots');
});

Route::post('/register', [userController::class, 'register']);

Route::post('/logout', [userController::class, 'logout']);

Route::post('/login', [userController::class, 'login']);

// prescription routes

Route::post('/createPrescription', [prescriptionController::class, 'createPrescription']);
