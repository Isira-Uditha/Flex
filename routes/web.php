<?php

use App\Http\Controllers\PackageController;
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

Route::get('/package/index',[PackageController::class, 'index'])->name('package_index');

// Route::get('/package/createform', function () {
//     return view('package.create');
// });

Route::post('/package/create', [PackageController::class, 'create'])->name('package_create');

Route::get('/package/view/{action}', [PackageController::class, 'view'])->name('package_view');
