<?php

use App\Http\Controllers\WorkoutExerciseController;
use App\Http\Controllers\WorkoutPlanController;
use App\Http\Controllers\DietPlanController;
use App\Models\Equipment;
use App\Models\WorkoutExercise;
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



Route::get('/workout/workout_exercise', function () {
    $equipments=Equipment::all();
    return view('workoutplans.create_exercise')->with('equipments', $equipments);
})->name('createExercise_view');

Route::get('/workout/workout_plan/create', function () {
    $exercises=WorkoutExercise::all();
    return view('workoutplans.create_workoutplan')->with('exercises',  $exercises);;
})->name('create_workoutPlan_view');

Route::get('/diet_plan/create', function () {
    return view('dietplans.create_diet_plan');
})->name('create_dietPlan_view');

Route::post('/workout/workout_exercise/create',[WorkoutExerciseController::class, 'store'])->name('createExercise');

Route::post('/workout/workout_plan/create',[WorkoutPlanController::class, 'store'])->name('create_workout_plan');

Route::post('/diet/diet_plan/create',[DietPlanController::class, 'store'])->name('create_diet_plan');
