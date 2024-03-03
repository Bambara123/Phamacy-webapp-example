<?php

use App\Models\Prescriptions;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\userController;
use App\Http\Controllers\drugsController;
use App\Http\Controllers\prescriptionController;
use App\Models\Drugs;

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
    $user = Auth::user(); // Get the currently authenticated user

    if ($user == null) return view('home', ['prescriptions' => []]); // If no user is authenticated, return an empty array

    $prescriptions = Prescriptions::where('user_id', $user->id)
        ->orderByRaw("FIELD(status,  'Quotation Available','Pending Quotation','Accepted', 'Rejected')")
        ->get(); // Get prescriptions of the user ordered by status

    return view('home', ['prescriptions' => $prescriptions]);
});

Route::get('/phamacy', function () {
    $prescriptions = Prescriptions::orderByRaw("FIELD(status, 'Accepted', 'Pending Quotation', 'Quotation Available','Rejected')")
        ->get();

    return view('phamacy', ['prescriptions' => $prescriptions]);
});


Route::get('/onepres/{id}', function ($id) {
    $prescription = Prescriptions::with('images')->findOrFail($id);

    return view('onepres', ['prescription' => $prescription]);
});

Route::get('/userone/{id}', function ($id) {
    $prescription = Prescriptions::with('images')->findOrFail($id);
    $medicines = Drugs::where('prescription_id', $id)->get();

    return view('userone', ['prescription' => $prescription,  'medicines' => $medicines]);
});

Route::get('/boots', function () {

    return view('boots');
});

// user  

Route::post('/register', [userController::class, 'register']);

Route::post('/logout', [userController::class, 'logout']);

Route::post('/login', [userController::class, 'login']);

// prescription routes

Route::post('/createPrescription', [prescriptionController::class, 'createPrescription']);

// update prescription + update drugs

Route::post('/createDrugs', [drugsController::class, 'createDrugs']);

// reject or accept quotation

Route::post('/reject/{id}', [prescriptionController::class, 'rejectQuotation']);
Route::post('/accept/{id}', [prescriptionController::class, 'acceptQuotation']);
