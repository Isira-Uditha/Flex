<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkoutPlanExercise extends Model
{
    use HasFactory;
    protected $table = 'workout_plan_exercise';
    protected $primaryKey = ['workout_plan_id','exercise_id'];
    public $incrementing = false;
    public $timestamps = true;
    protected $fillable = [
        'created_at',
        'updated_at',
    ];
}
