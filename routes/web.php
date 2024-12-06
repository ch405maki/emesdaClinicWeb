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
use App\Http\Controllers\SidebarController;

use Illuminate\Support\Facades\Mail;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
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
    Auth::logout();
    return redirect('/login');
})->name('/logout');

Route::get('/login', function() {
    return view('auth.login');
})->name('login');


// Mail

Route::get('/test-email', function () {
    $details = [
        'subject' => 'Test Email from Emesda Dental Clinic',
        'body' => 'This is a test email to verify the SMTP configuration.',
    ];

    Mail::raw($details['body'], function ($message) use ($details) {
        $message->from('em@emesdadentalclinic.com', 'Emesda Dental Clinic')
                ->to('markmanuel0317@gmail.com')
                ->subject($details['subject']);
    });

    return 'Test email sent!';
});

// MAIL_MAILER=smtp
// MAIL_HOST=mail.emesdadentalclinic.com
// MAIL_PORT=465
// MAIL_USERNAME=em@emesdadentalclinic.com
// MAIL_PASSWORD=Ch405maki
// MAIL_ENCRYPTION=ssl
// MAIL_FROM_ADDRESS=em@emesdadentalclinic.com
// MAIL_FROM_NAME="Emesda Dental Clinic"
// MAIL_ENCRYPTION=tls

///////////////////////

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/sidebar', [SidebarController::class, 'fetchPendingAppointments']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/appointments/manage', [AppointmentController::class, 'manage'])->name('appointments.manage');
Route::get('/appointments/my-appointments', [AppointmentController::class, 'myAppointments'])->name('appointments.my-appointments');
Route::get('/appointments/staff', [AppointmentController::class, 'staffAppointmentsManage'])->name('appointments.staff');

Route::post('/send-appointment-email', [AppointmentController::class, 'sendConfirmationEmail'])->name('appointments.email');

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/dashboard'); // Fixed missing closing quote
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');


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
    return redirect()->away('https://www.mediafire.com/file/3sbgr6d1qot5icd/Emes+Da+Dental+Clinic_1.0.0.apk/file');
})->name('download-apk');

require __DIR__.'/auth.php';
