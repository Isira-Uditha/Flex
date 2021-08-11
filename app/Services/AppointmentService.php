<?php
namespace App\Services;

use App\Models\Appointment;
use App\Models\WorkoutPlan;
use Illuminate\Support\Carbon;

class AppointmentService
{
    public function getAllWorkouts(){
        $res = WorkoutPlan::get();
        return $res;
    }

    public function getAppointments($data){
        $res = Appointment::select('appointment.*','wplan.workout_plan_name','wplan.workout_plan_id')
        ->join('workout_plan as wplan','wplan.workout_plan_id','appointment.workout_plan_id')
        ->when(isset($data['appointment_id']) && $data['appointment_id'] != '', function($q) use($data) {
            return $q->where('appointment.appointment_id', $data['appointment_id']);
        })
        ->when(isset($data['time_slot']) && $data['time_slot'] != '', function($q) use($data) {
            return $q->where('appointment.time_slot', $data['time_slot']);
        })
        ->when(isset($data['workout_plan_id']) && $data['workout_plan_id'] != '', function($q) use($data) {
            return $q->where('wplan.workout_plan_id', $data['workout_plan_id']);
        })
        ->when(!isset($data['sts_date']) && $data['workout_plan_id'] != 'on', function($q) use($data) {
            return $q->when(isset($data['from']) && $data['from'] != '', function($q) use($data) {
                return $q->where('appointment.appointment_date','>=', Carbon::createFromFormat('m/d/Y',$data['from'])->format('Y-m-d'));
            })
            ->when(isset($data['to']) && $data['to'] != '', function($q) use($data) {
                return $q->where('appointment.appointment_date','<=',  Carbon::createFromFormat('m/d/Y',$data['to'])->format('Y-m-d'));
            });
        })
        ->orderBy('appointment_id','DESC')
        ->get();

        return $res;
    }

    public function getWorkoutPlans($id = ''){
        $result = WorkoutPlan::get();

        return $result;
    }
}

?>
