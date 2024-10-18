<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\DiagnosticController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\DentistAvailabilityController;

// use App\Http\Controllers\SmsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//Route::get('/appointments/create', [AppointmentController::class, 'create'])->name('appointments.create');
Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/logout', function() {
    Auth::logout(); // Logs out the user
    return redirect('/login'); // Redirect to login or home
})->name('/');

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/appointments/manage', [AppointmentController::class, 'manage'])->name('appointments.manage');
Route::get('/appointments/my-appointments', [AppointmentController::class, 'myAppointments'])->name('appointments.my-appointments');

Route::middleware(['auth', 'verified'])->group(function () {
    // Appointments
    Route::get('/appointments', [AppointmentController::class, 'index'])->name('appointments.index');
    Route::get('/appointment/form', [AppointmentController::class, 'create'])->name('appointments.create');
    Route::post('/appointments', [AppointmentController::class, 'store'])->name('appointments.store');
    Route::get('/appointments/{id}', [AppointmentController::class, 'show'])->name('appointments.show');
    Route::put('/appointments/{appointment}/update-status', [AppointmentController::class, 'updateStatus'])->name('appointments.update-status');

    Route::get('/appointments/manage', [AppointmentController::class, 'manage'])->name('appointments.manage');
    Route::get('/appointments/view/{id}', [AppointmentController::class, 'view'])->name('appointments.view');
    
    
    // Diagnostics
    Route::get('/diagnostic', [DiagnosticController::class, 'index'])->name('diagnostic.index');
    Route::get('/diagnostic/form', [DiagnosticController::class, 'create'])->name('diagnostic.create');
    Route::post('/diagnostic/store', [DiagnosticController::class, 'store'])->name('diagnostic.store');

    // Reports
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    Route::get('/reports/{id}', [ReportController::class, 'show'])->name('reports.show');
    Route::get('/reports/{id}/export-pdf', [ReportController::class, 'exportPdf'])->name('reports.export-pdf');

    //Staff management
    Route::get('/staff', [StaffController::class, 'index'])->name('staff');
    Route::post('/staff', [StaffController::class, 'store'])->name('staff.store');
    Route::delete('/staff/{id}', [StaffController::class, 'destroy'])->name('staff.destroy');

    Route::get('/dentist/availability', [DentistAvailabilityController::class, 'index'])->name('dentist.availability');
    Route::post('/dentist/availability', [DentistAvailabilityController::class, 'store'])->name('dentist.availability.store');
    Route::delete('/dentist/availability/{id}', [DentistAvailabilityController::class, 'destroy'])->name('availability.destroy');
});


// Route::match(['get', 'post'], '/send-sms', [SmsController::class, 'sendSms'])->name('sms.send');


Route::get('/download-apk', function () {
    $filePath = public_path('application/dentalClinic.apk');
    
    if (file_exists($filePath)) {
        return response()->download($filePath, 'dentalClinic.apk');
    } else {
        abort(404, 'File not found.');
    }
});

require __DIR__.'/auth.php';
