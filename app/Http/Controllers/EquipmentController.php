<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Equipment;
use Illuminate\Support\Facades\Validator;

class EquipmentController extends Controller
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
        // dd($request-> all());
        $rules = [
            'equipment_code' => 'required',
            'category' => 'required',
            'equipment_price' => 'required',
            'equipment_name' => 'required',
            'registered_date' => 'required',
            'status' => 'required',
            'image' => 'required',
            'muscles_used' => 'required',
            'equipment_desc' => 'required',
        ];

        $validatedData = Validator::make(
            $request->all(),
            $rules,
            [
                'equipment_code.required' => 'Equipment Code is required ',
                'category.required' => 'Equipment Category field is required b',
                'equipment_price.required' => 'Equipment Price field is required',
                'equipment_name.required' => 'Equipment Name field is required',
                'registered_date.required' => 'Equipment Registered Date field is required',
                'status.required' => 'Equipment Status field is required',
                'image.required' => 'Equipment Image field is required',
                'muscles_used.required' => 'Mucles used field is required',
                'equipment_desc.required' => 'Please add an Equipment Description',
            ]
        );

        if ($validatedData->fails()) {
            return redirect()->back()->withInput()->withErrors($validatedData->errors())
                ->with('error_message', 'please check as we’re missing some information.');
        }else{

            $equipment = new Equipment();

            $equipment->equipment_code=$request->equipment_code;
            $equipment->category=$request->category;
            $equipment->equipment_price=$request->equipment_price;
            $equipment->equipment_name=$request->equipment_name;
            $equipment->registered_date=$request->registered_date;
            $equipment->status=$request->status;
            $equipment->image=$request->image;
            $equipment->muscles_used=$request->muscles_used;
            $equipment->equipment_desc=$request->equipment_desc;

            $eqp = $equipment->save();

            if($eqp){
                return redirect(route('createEquipment'))->with('success_message', 'Equipment Succcessfully Registered');
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
