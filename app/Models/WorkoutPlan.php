<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkoutPlan extends Model
{
    use HasFactory;
    protected $table = 'workout_plan';
    protected $primaryKey = 'workout_plan_id ';
    public $incrementing = true;
    public $timestamps = true;
    protected $fillable = [
        'workout_plan_name',
        'duration',
        'workout_desc',
        'workout_bmi_category',
        'workout_monday',
        'workout_tuesday',
        'workout_wednesday',
        'workout_thursday',
        'workout_friday',
        'workout_saturday',
        'workout_sunday',
        'exerises_set_id',
        'created_at',
        'updated_at',
    ];
}
