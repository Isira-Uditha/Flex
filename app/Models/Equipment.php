<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Equipment extends Model
{
    use HasFactory;
    protected $table = 'equipment';
    protected $primaryKey = 'equipment_id';
    public $incrementing = true;
    public $timestamps = true;
    protected $fillable = [
        'equipment_code',
        'equipment_name',
        'category',
        'equipment_price',
        'registered_date',
        'muscles_used',
        'status',
        'equipment_desc',
        'image',
        'created_at',
        'updated_at',
    ];

    protected function getEqipments($data){
        $res =  Equipment::when(isset($data['equipment_name']) && $data['equipment_name'] != '', function($q) use($data) {
            return $q->where('equipment.equipment_name', $data['equipment_name']);
        })
        ->when(isset($data['category']) && $data['category'] != '', function($q) use($data) {
            return $q->where('equipment.category', $data['category']);
        })
        // ->when(isset($data['workout_plan_duration']) && $data['workout_plan_duration'] != '', function($q) use($data) {
        //     return $q->where('workout_plan.duration', $data['workout_plan_duration']);
        // })
        // ->when(isset($data['created_date']) && $data['created_date'] != '', function($q) use($data) {
        //     return $q->where(DB::raw("DATE(created_at)"), 'LIKE',Carbon::createFromFormat('m/d/Y',$data['created_date'])->format('Y-m-d').'%');
        //     // return $q->orWhereRaw('created_at::text like ?', ['%'.Carbon::createFromFormat('m/d/Y',$data['created_date'])->format('Y-m-d').'%']);
        // })
        ->when(isset($data['equipment_code']) && $data['equipment_code'] != '', function($q) use($data) {
            return $q->where('equipment.equipment_code', $data['equipment_code']);
        })
        ->when(!isset($data['sts_date']) && $data['equipment_name'] != 'on', function($q) use($data) {
            return $q->when(isset($data['registered_date']) && $data['registered_date'] != '', function($q) use($data) {
                return $q->where(DB::raw("DATE(registered_date)"), 'LIKE',Carbon::createFromFormat('m/d/Y',$data['registered_date'])->format('Y-m-d').'%');
            });

     })
        // ->when(isset($data['workout_plan_bmi_category']) && $data['workout_plan_bmi_category'] != '', function($q) use($data) {
        //     return $q->where('workout_plan.workout_bmi_category', $data['workout_plan_bmi_category']);
        // })
        ->get();

        return $res;

    }


}
