<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DietPlan extends Model
{
    use HasFactory;
    protected $table = 'diet_plan';
    protected $primaryKey = 'diet_plan_id';
    public $incrementing = true;
    public $timestamps = true;
    protected $fillable = [
        'diet_plan_name',
        'bmi_category',
        'breakfast',
        'lunch',
        'dinner',
        'diet_desc',
        'diet_monday',
        'diet_tuesday',
        'diet_wednesday',
        'diet_thursday',
        'diet_friday',
        'diet_saturday',
        'diet_sunday',
        'created_at',
        'updated_at',
    ];
}
