<?php

use App\Http\Controllers\PackageController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\test;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

//Login
Route::get('/', function () {return redirect('/login');});
Auth::routes();

Route::get('/sample', function () {
    return view('sample');
});

Route::get('/test',[test::class, 'index'])->name('test');

//Package Routes
Route::get('/package/index',[PackageController::class, 'index'])->name('package_index');
Route::post('/package/create/{action}/{id?}', [PackageController::class, 'create'])->name('package_create');
Route::get('/package/view/{action}/{id?}', [PackageController::class, 'view'])->name('package_view');

//User Routes
Route::get('/user/index/{u_type}',[UserController::class, 'index'])->name('user_index');
Route::get('/user/view/{u_type}/{action}/{id?}', [UserController::class, 'view'])->name('user_view');
Route::post('/user/create/{u_type}/{action}/{id?}', [UserController::class, 'create'])->name('user_create');


Route::get('/appointment/index',[AppointmentController::class, 'index'])->name('appointment_index');

Route::get('/appointment/view/{action}/{id?}',[AppointmentController::class, 'view'])->name('appointment_view');

Route::get('/appointment/getSugestedSchedules',[AppointmentController::class, 'getSugestedSchedules'])->name('getSugestedSchedules');

Route::get('/appointment/checkAppointmentStatus',[AppointmentController::class, 'checkAppointmentStatus'])->name('checkAppointmentStatus');

Route::post('/appointment/create/{action}/{id?}',[AppointmentController::class, 'create'])->name('appointment_create');

