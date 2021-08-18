<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Equipment;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class EquipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //,compact('data')

        if ($request->ajax()) {
            $equipments = Equipment::getEqipments($request->all());
            return datatables()->of($equipments)
            ->addColumn('equipment_id', function ($row) {
                return $row->equipment_id;
            })
            ->addColumn('image', function ($row) {
               //return Storage::get('accountsdocs/'.$row->image);
               $img = Storage::disk('accountsdocs')->get($row->image);
               $type =  pathinfo(Storage::disk('accountsdocs')->path($row->image), PATHINFO_EXTENSION);
               $path = 'data:image/' . $type . ';base64,' . base64_encode($img);
               return '<img src="'. $path .'">';
            })
            ->addColumn('equipment_code', function ($row) {
                return $row->equipment_code;
            })
            ->addColumn('equipment_name', function ($row) {
                return $row->equipment_name;
            })
            ->addColumn('registered_date', function ($row) {
                $app_date = Carbon::createFromFormat('Y-m-d',$row->registered_date)->format('m/d/Y');
                return $app_date;
            })
            ->addColumn('status', function ($row) {
                $status = '';

                if($row->status == 'In Use'){
                    $status = '<span class="tag tag-green">In Use</span>';
                }else if($row->status == 'Repair'){
                    $status = '<span class="tag tag-red">Repair</span>';
                }
                return $status;
            })
            ->addColumn('equipment_price', function ($row) {
                return $row->equipment_price;
            })
            ->addColumn('category', function ($row) {
                // $category = '';

                // if($row->category == 'Fitness & Body Building'){
                //     $category = '<span class="tag tag-red">Fitness & Body Building</span>';
                // }else if($row->category == 'Team Sport'){
                //     $category = '<span class="tag tag-green">Team Sport</span>';
                // }else if($row->category == 'Sport Safety'){
                //     $category = '<span class="tag tag-yellow">Sport Safety</span>';
                // }else if($row->category == 'Gym Equipment'){
                //     $category = '<span class="tag tag-yellow">Gym Equipment</span>';
                // }else if($row->category == 'Outdoor Sports'){
                //     $category = '<span class="tag tag-yellow">Outdoor Sports</span>';
                // }else if($row->category == 'Indoor Sports'){
                //     $category = '<span class="tag tag-yellow">Indoor Sports</span>';
                // }else if($row->category == 'Sports Gloves'){
                //     $category = '<span class="tag tag-yellow">Sports Gloves</span>';
                // }else if($row->category == 'Swimming & Diving'){
                //     $category = '<span class="tag tag-yellow">Swimming & Diving</span>';
                // }else if($row->category == 'Supplements'){
                //     $category = '<span class="tag tag-yellow">Supplements</span>';
                // }else{
                //     $category = '<span class="tag tag-red tx-12">Other Sports Equipment</span>';
                // }
                return $row->category;
                //return $category;
            })
            ->addColumn('muscles_used', function ($row) {
                return $row->muscles_used;
            })
            ->addColumn('equipment_desc', function ($row) {
                return $row->equipment_desc;
            })
            ->addColumn('action', function ($row) {
                $delete = '<a data-placement="top" data-toggle="tooltip-primary" title="Delete" data-appid = "'.$row->equipment_id.'" ><i class="fas fa-trash-alt text-danger  fa-lg delete"></i></a> ';
                $edit = ' <a href="' . route('appointment_view',['action' => 'Edit','id' => $row->equipment_id]) . '" data-toggle="tooltip-primary" title="Edit"><i class="fas fa-edit text-warning fa-lg" data-placement="top"></i></a>';
                return $edit.' '.$delete;
            })
            ->rawColumns(['action','category','status','image'])

            ->make(true);
        }


        return view('equipment.index_equipment');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
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
        // $sss = Storage::disk('accountsdocs')->download($file_path);

        // dd($request-> all());
        $rules = [
            'equipment_code' => 'required|min:5',
            'category' => 'required',
            'equipment_price' => 'required|numeric',
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
                'category.required' => 'Equipment Category field is required',
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
            $file_path = Storage::disk('accountsdocs')->putFileAs('EQUIPMENT', $request->file('image'), $request->image->getClientOriginalName());

            $equipment->equipment_code=$request->equipment_code;
            $equipment->category=$request->category;
            $equipment->equipment_price=$request->equipment_price;
            $equipment->equipment_name=$request->equipment_name;
            $equipment->registered_date= Carbon::createFromFormat('m/d/Y',$request->registered_date)->format('Y-m-d');
            $equipment->status=$request->status;
            $equipment->image= $file_path;
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
