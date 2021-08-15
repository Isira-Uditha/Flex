<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class WorkoutPlan extends Model
{
    use HasFactory;
    protected $table = 'workout_plan';
    protected $primaryKey = 'workout_plan_id';
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

    protected function getAllWorkoutPlans($data){

        $res =  WorkoutPlan::when(isset($data['workout_plan_id']) && $data['workout_plan_id'] != '', function($q) use($data) {
            return $q->where('workout_plan.workout_plan_id', $data['workout_plan_id']);
        })
        ->when(isset($data['workout_plan_name']) && $data['workout_plan_name'] != '', function($q) use($data) {
            return $q->where('workout_plan.workout_plan_name', $data['workout_plan_name']);
        })
        ->when(isset($data['workout_plan_duration']) && $data['workout_plan_duration'] != '', function($q) use($data) {
            return $q->where('workout_plan.duration', $data['workout_plan_duration']);
        })
        // ->when(isset($data['created_date']) && $data['created_date'] != '', function($q) use($data) {
        //     return $q->where(DB::raw("DATE(created_at)"), 'LIKE',Carbon::createFromFormat('m/d/Y',$data['created_date'])->format('Y-m-d').'%');
        //     // return $q->orWhereRaw('created_at::text like ?', ['%'.Carbon::createFromFormat('m/d/Y',$data['created_date'])->format('Y-m-d').'%']);
        // })
        ->when(!isset($data['sts_date']) && $data['workout_plan_id'] != 'on', function($q) use($data) {
            return $q->when(isset($data['created_date']) && $data['created_date'] != '', function($q) use($data) {
                return $q->where(DB::raw("DATE(created_at)"), 'LIKE',Carbon::createFromFormat('m/d/Y',$data['created_date'])->format('Y-m-d').'%');
            });

        })
        ->when(isset($data['workout_plan_bmi_category']) && $data['workout_plan_bmi_category'] != '', function($q) use($data) {
            return $q->where('workout_plan.workout_bmi_category', $data['workout_plan_bmi_category']);
        })
        ->get();

        return $res;


    }
}
