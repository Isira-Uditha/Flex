<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkoutExercise extends Model
{
    use HasFactory;
    protected $table = 'workout_exericse';
    protected $primaryKey = 'exercise_id';
    public $incrementing = true;
    public $timestamps = true;
    protected $fillable = [
        'exercise_name',
        'exercise_desc',
        'equip_id',
        'created_at',
        'updated_at',
    ];
}
