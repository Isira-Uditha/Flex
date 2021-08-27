<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\test;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('auth.login');
})->name('login');

Route::get('/sample', function () {
    return view('sample');
});

Route::get('/test',[test::class, 'index'])->name('test');

Route::get('/appointment/index',[AppointmentController::class, 'index'])->name('appointment_index');

Route::get('/appointment/view/{action}/{id?}',[AppointmentController::class, 'view'])->name('appointment_view');

Route::get('/appointment/getSugestedSchedules',[AppointmentController::class, 'getSugestedSchedules'])->name('getSugestedSchedules');

Route::get('/appointment/checkAppointmentStatus',[AppointmentController::class, 'checkAppointmentStatus'])->name('checkAppointmentStatus');

Route::post('/appointment/create/{action}/{id?}',[AppointmentController::class, 'create'])->name('appointment_create');

Route::get('/payment/index',[PaymentController::class, 'index'])->name('payment_index');

Route::get('/payment/view/{action}/{id?}',[PaymentController::class, 'view'])->name('payment_view');

Route::get('/payment/getPackagePrice',[PaymentController::class, 'getPackagePrice'])->name('getPackagePrice');

Route::post('/payment/create/{action}/{id?}',[PaymentController::class, 'create'])->name('payment_create');
