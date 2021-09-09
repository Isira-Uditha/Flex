<?php
namespace App\Services;


use App\Models\DietPlan;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class DietPlanService
{


    public function getAllDietPlans($data){
        $res =  DietPlan::when(isset($data['diet_plan_id']) && $data['diet_plan_id'] != '', function($q) use($data) {
            return $q->where('diet_plan.diet_plan_id', $data['diet_plan_id']);
        })
        ->when(isset($data['diet_plan_name']) && $data['diet_plan_name'] != '', function($q) use($data) {
            return $q->where('diet_plan.diet_plan_name', $data['diet_plan_name']);
        })
        ->when(!isset($data['sts_date']) && $data['diet_plan_id'] != 'on', function($q) use($data) {
            return $q->when(isset($data['created_date']) && $data['created_date'] != '', function($q) use($data) {
                return $q->where(DB::raw("DATE(created_at)"), 'LIKE',Carbon::createFromFormat('m/d/Y',$data['created_date'])->format('Y-m-d').'%');
            });

        })
        ->when(isset($data['diet_plan_bmi_category']) && $data['diet_plan_bmi_category'] != '', function($q) use($data) {
            return $q->where('diet_plan.bmi_category', $data['diet_plan_bmi_category']);
        })
        ->orderBy('diet_plan_id','desc')
        ->get();

        return $res;
    }


}

?>
