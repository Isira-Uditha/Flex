<?php

namespace App\Http\Controllers;

use App\Models\WorkoutExercise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class WorkoutExerciseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

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
            'exercise_name' => 'required',
            'exercise_equipment_id' => 'required',
        ];

        $validatedData = Validator::make(
            $request->all(),
            $rules,
            [
                'exercise_name.required' => 'This field is required',
                'exercise_equipment_id.required' => 'This field is required',
            ]
        );

        if ($validatedData->fails()) {
            return redirect()->back()->withInput()->withErrors($validatedData->errors())
                ->with('error_message', 'please check as we’re missing some information.');
        }else{
        $exercise = new WorkoutExercise();

        $exercise->exercise_name=$request->exercise_name;
        $exercise->equip_id=$request->exercise_equipment_id;
        $exercise->exercise_desc=$request->exercise_description;

        $res = $exercise->save();

        if($res){
            return redirect(route('createExercise_view'))->with('success_message', 'Workout Exercise created succefully ');
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
