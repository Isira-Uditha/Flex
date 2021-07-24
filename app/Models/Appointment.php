<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;
    protected $table = 'appointment';
    protected $primaryKey = 'appointment_id';
    public $incrementing = true;
    public $timestamps = true;
    protected $fillable = [
        'time_slot',
        'appointment_date',
        'current_height',
        'current_weight',
        'bmi',
        'bmi_type',
        'uid',
        'diet_plan_id',
        'workout_plan_id',
        'created_at',
        'updated_at',
    ];
}
