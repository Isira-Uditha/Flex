<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WorkoutPlan;
use App\Models\WorkoutPlanExercise;
use Illuminate\Support\Facades\Validator;

class WorkoutPlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        $rules = [
            'workout_plan_name' => 'required',
            'workout_plan_duration' => 'required',
            'workout_plan_exercises' => 'required',
            'workout_plan_bmi_category' => 'required',
        ];

        $validatedData = Validator::make(
            $request->all(),
            $rules,
            [
                'workout_plan_name.required' => 'This field is required',
                'workout_plan_duration.required' => 'This field is required',
                'workout_plan_exercises.required' => 'Select at least one exercise is required',
                'workout_plan_bmi_category.required' => 'Select a BMI Category is required',
            ]
        );

        if ($validatedData->fails()) {
            return redirect()->back()->withInput()->withErrors($validatedData->errors())
                ->with('error_message', 'please check as we’re missing some information.');
        }else{

            $workout_plan = new WorkoutPlan();

            $statusNo = "no";

            $workout_plan->workout_plan_name=$request->workout_plan_name;
            $workout_plan->duration=$request->workout_plan_duration;
            $workout_plan->workout_desc=$request->workout_plan_description;
            $workout_plan->workout_bmi_category=$request->workout_plan_bmi_category;

            if($request->workout_day_monday == null){
                $workout_plan->workout_monday = $statusNo;
            }else{
                $workout_plan->workout_monday=$request->workout_day_monday;
            }

            if($request->workout_day_tuesday == null){
                $workout_plan->workout_tuesday = $statusNo;
            }else{
                $workout_plan->workout_tuesday=$request->workout_day_tuesday;
            }

            if($request->workout_day_wednesday == null){
                $workout_plan->workout_wednesday = $statusNo;
            }else{
                $workout_plan->workout_wednesday=$request->workout_day_wednesday;
            }

            if($request->workout_day_thursday == null){
                $workout_plan->workout_thursday = $statusNo;
            }else{
                $workout_plan->workout_thursday=$request->workout_day_thursday;
            }

            if($request->workout_day_friday == null){
                $workout_plan->workout_friday = $statusNo;
            }else{
                $workout_plan->workout_friday=$request->workout_day_friday;
            }

            if($request->workout_day_saturday == null){
                $workout_plan->workout_saturday = $statusNo;
            }else{
                $workout_plan->workout_saturday=$request->workout_day_saturday;
            }

            if($request->workout_day_sunday == null){
                $workout_plan->workout_sunday = $statusNo;
            }else{
                $workout_plan->workout_sunday=$request->workout_day_sunday;
            }

            $res_plan = $workout_plan->save();

            //Get the inserted workout plan id
            $inserted_workout_plan = WorkoutPlan::latest()->first();

            //Get the inserted exercises ids
            $exercises = $request->workout_plan_exercises;

            //Save in the workout_plan_exercise table
            foreach ($exercises as $exercise){
                $workout_plan_exercise = new WorkoutPlanExercise();

                $workout_plan_exercise->workout_plan_id=  $inserted_workout_plan->workout_plan_id;
                $workout_plan_exercise->exercise_id = $exercise ;

                $res_plan_exercise = $workout_plan_exercise->save();
        }

        if($res_plan && $res_plan_exercise){
            return redirect(route('create_workoutPlan_view'))->with('success_message', 'Workout Plan created succefully ');
        }else{
            return redirect()->back()->withInput()->withErrors($validatedData->errors())
            ->with('error_message', 'please check as we’re missing some information.');
        }
    }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
