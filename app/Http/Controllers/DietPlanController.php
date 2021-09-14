<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DietPlan;
use App\Services\DietPlanService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;


class DietPlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $diet_service = new DietPlanService();

        if ($request->ajax()) {
            $diets = $diet_service->getAllDietPlans($request->all());
            return datatables()->of($diets)
            ->addColumn('diet_id', function ($row) {
                return $row->diet_plan_id;
            })
            ->addColumn('created_date', function ($row) {
                $date =  Carbon::createFromFormat('Y-m-d H:i:s',$row->created_at)->format('m/d/Y');
                return $date;
            })
            ->addColumn('diet_plan_name', function ($row) {
                return $row->diet_plan_name;
            })
            ->addColumn('bmi_category', function ($row) {

                return $row->bmi_category;
            })
            ->addColumn('breakfast', function ($row) {
                return $row->breakfast;
            })
            ->addColumn('lunch', function ($row) {
                return $row->lunch;
            })
            ->addColumn('dinner', function ($row) {
                return $row->dinner;
            })
            ->addColumn('description', function ($row) {
                return $row->diet_desc;
            })
            ->addColumn('action', function ($row) {
                $delete = '<a data-placement="top" data-toggle="tooltip-primary" title="Delete" data-dietid = "'.$row->diet_plan_id.'" ><i class="fas fa-trash-alt text-danger  fa-lg delete"></i></a>';
                $edit = ' <a href="' . route('diet_plan_edit_view',['id' => $row->diet_plan_id]) . '" data-toggle="tooltip-primary" title="Edit"><i class="fas fa-edit text-warning fa-lg" data-placement="top"></i></a>';
                $view = ' <a href="' . route('diet_plan_view',['id' => $row->diet_plan_id]) . '" data-toggle="tooltip-primary" title="View"><i class="fas fa-search text-primary fa-lg" data-placement="top"></i></a>';
                return $view.' '.$edit.' '.$delete;

            })
            ->rawColumns(['action'])

            ->make(true);
        }
        return view('dietplans.index_diet_plan');
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
        $dietPlansCount=DietPlan::count();

        if($dietPlansCount >= 4){
            return redirect()->back()->withInput()
            ->with('error_message', 'SORRY , System is not allowed to create more than 4 diet plans, There are already 4 diet plans in the system');

        }else{
        $rules = [
            'diet_plan_name' => 'required|min:5|unique:diet_plan',
            'diet_plan_dinner' => 'required',
            'diet_plan_lunch' => 'required',
            'diet_plan_breakfast' => 'required',
            'diet_plan_bmi_category' => 'required',
        ];

        $validatedData = Validator::make(
            $request->all(),
            $rules,
            [
                'diet_plan_name.required' => 'This field is required',
                'diet_plan_lunch.required' => 'Enter meals for lunch is required',
                'diet_plan_breakfast.required' => 'Enter meals for breakfast is required',
                'diet_plan_dinner.required' => 'Enter meals for dinner is required',
                'diet_plan_bmi_category.required' => 'Select a BMI Category is required',
            ]
        );

        if ($validatedData->fails()) {
            return redirect()->back()->withInput()->withErrors($validatedData->errors())
                ->with('error_message', 'please check as we’re missing some information.');
        }else{

            $diet_plan = new DietPlan();

            $statusNo = "no";

            $diet_plan->diet_plan_name=$request->diet_plan_name;
            $diet_plan->bmi_category=$request->diet_plan_bmi_category;
            $diet_plan->breakfast=$request->diet_plan_breakfast;
            $diet_plan->lunch=$request->diet_plan_lunch;
            $diet_plan->dinner=$request->diet_plan_dinner;
            $diet_plan->diet_desc=$request->diet_plan_description;

            if($request->diet_day_monday == null){
                $diet_plan->diet_monday = $statusNo;
            }else{
                $diet_plan->diet_monday=$request->diet_day_monday;
            }

            if($request->diet_day_tuesday == null){
                $diet_plan->diet_tuesday = $statusNo;
            }else{
                $diet_plan->diet_tuesday=$request->diet_day_tuesday;
            }

            if($request->diet_day_wednesday == null){
                $diet_plan->diet_wednesday = $statusNo;
            }else{
                $diet_plan->diet_wednesday=$request->diet_day_wednesday;
            }

            if($request->diet_day_thursday == null){
                $diet_plan->diet_thursday = $statusNo;
            }else{
                $diet_plan->diet_thursday=$request->diet_day_thursday;
            }

            if($request->diet_day_friday == null){
                $diet_plan->diet_friday = $statusNo;
            }else{
                $diet_plan->diet_friday=$request->diet_day_friday;
            }

            if($request->diet_day_saturday == null){
                $diet_plan->diet_saturday = $statusNo;
            }else{
                $diet_plan->diet_saturday=$request->diet_day_saturday;
            }

            if($request->diet_day_sunday == null){
                $diet_plan->diet_sunday = $statusNo;
            }else{
                $diet_plan->diet_sunday=$request->diet_day_sunday;
            }

            $res_plan = $diet_plan->save();


        if($res_plan){
            return redirect(route('diet_plan_index'))->with('success_message', 'Diet Plan created succefully ');
        }else{
            return redirect()->back()->withInput()->withErrors($validatedData->errors())
            ->with('error_message', 'please check as we’re missing some information.');
        }
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

        $dietservice = new DietPlan();

        $data['result'] = DietPlan::where('diet_plan_id',$id)->first();
        $data['id'] = $id;

         return view('dietplans.edit_diet_plan',compact('data'));
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
        $dietPlanOldName = $request->diet_plan_name_old;
        $dietPlanNewName = $request->diet_plan_name;

        if($dietPlanOldName == $dietPlanNewName){
            $rules = [

                'diet_plan_dinner' => 'required',
                'diet_plan_lunch' => 'required',
                'diet_plan_breakfast' => 'required',
                'diet_plan_bmi_category' => 'required',
            ];
        }else{
        $rules = [
            'diet_plan_name' => 'required|min:5|unique:diet_plan',
            'diet_plan_dinner' => 'required',
            'diet_plan_lunch' => 'required',
            'diet_plan_breakfast' => 'required',
            'diet_plan_bmi_category' => 'required',
        ];
    }

        $validatedData = Validator::make(
            $request->all(),
            $rules,
            [
                'diet_plan_name.required' => 'This field is required',
                'diet_plan_lunch.required' => 'Enter meals for lunch is required',
                'diet_plan_breakfast.required' => 'Enter meals for breakfast is required',
                'diet_plan_dinner.required' => 'Enter meals for dinner is required',
                'diet_plan_bmi_category.required' => 'Select a BMI Category is required',
            ]
        );


        if ($validatedData->fails()) {
            return redirect()->back()->withInput()->withErrors($validatedData->errors())
                ->with('error_message', 'please check as we’re missing some information.');
        }else{


            $diet_plan = DietPlan::where('diet_plan_id',$id)->first();

            $statusNo = "no";

            $diet_plan->diet_plan_name=$request->diet_plan_name;
            $diet_plan->bmi_category=$request->diet_plan_bmi_category;
            $diet_plan->breakfast=$request->diet_plan_breakfast;
            $diet_plan->lunch=$request->diet_plan_lunch;
            $diet_plan->dinner=$request->diet_plan_dinner;
            $diet_plan->diet_desc=$request->diet_plan_description;

            if($request->diet_day_monday == null){
                $diet_plan->diet_monday = $statusNo;
            }else{
                $diet_plan->diet_monday=$request->diet_day_monday;
            }

            if($request->diet_day_tuesday == null){
                $diet_plan->diet_tuesday = $statusNo;
            }else{
                $diet_plan->diet_tuesday=$request->diet_day_tuesday;
            }

            if($request->diet_day_wednesday == null){
                $diet_plan->diet_wednesday = $statusNo;
            }else{
                $diet_plan->diet_wednesday=$request->diet_day_wednesday;
            }

            if($request->diet_day_thursday == null){
                $diet_plan->diet_thursday = $statusNo;
            }else{
                $diet_plan->diet_thursday=$request->diet_day_thursday;
            }

            if($request->diet_day_friday == null){
                $diet_plan->diet_friday = $statusNo;
            }else{
                $diet_plan->diet_friday=$request->diet_day_friday;
            }

            if($request->diet_day_saturday == null){
                $diet_plan->diet_saturday = $statusNo;
            }else{
                $diet_plan->diet_saturday=$request->diet_day_saturday;
            }

            if($request->diet_day_sunday == null){
                $diet_plan->diet_sunday = $statusNo;
            }else{
                $diet_plan->diet_sunday=$request->diet_day_sunday;
            }

            $res_plan = $diet_plan->save();

        if($res_plan){
            return redirect(route('diet_plan_index'))->with('success_message', 'Diet Plan updated succefully ');
        }else{
            return redirect()->back()->withInput()->withErrors($validatedData->errors())
            ->with('error_message', 'please check as we’re missing some information.');
        }
    }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dietPlan=DietPlan::find($id);
        $res =   $dietPlan->delete();

        if($res){
            return response()->json(['success' => 1, 'success_message' => 'Record deleted succefully'], 200);
        }else{
            return response()->json(['success' => 0, 'success_message' => 'Request unsuccefull'], 200);
        }
    }

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function checkValid()
    {
        //
        $dietPlansCount=DietPlan::count();

        if($dietPlansCount < 4){
            $availablity = true;

        }else{
            $availablity = false;

        }
        return response()->json(['data' => $availablity],200);
    }

    public function view(Request $request){

        $id = $request->id;
        $dietservice = new DietPlan();

        $data['result'] = DietPlan::where('diet_plan_id',$id)->first();
        $data['id'] = $id;

         return view('dietplans.view_diet_plan',compact('data'));
    }

    public function getUsage()
    {
        //
        $usage = DB::table('diet_plan')
                ->selectRaw('diet_plan.diet_plan_id as diet_plan_id, diet_plan.created_at as created_at,diet_plan.diet_plan_name as diet_plan_name, count(appointment.uid) as user_count, diet_plan.bmi_category as bmi_category ')
                ->leftJoin('appointment', 'diet_plan.diet_plan_id', '=', 'appointment.diet_plan_id')
                ->groupBy('diet_plan.diet_plan_id')
                ->get();

        return    $usage ;

    }

    public function viewReport(Request $request){
        $res = $this->getUsage();

        if ($request->ajax()) {
            return datatables()->of( $res)
            ->addColumn('diet_id', function ($row) {
                return $row->diet_plan_id;
            })
            ->addColumn('created_date', function ($row) {
                $date =  Carbon::createFromFormat('Y-m-d H:i:s',$row->created_at)->format('m/d/Y');
                return $date;
            })
            ->addColumn('diet_plan_name', function ($row) {
                return $row->diet_plan_name;
            })
            ->addColumn('user_count', function ($row) {
                return $row->user_count;
            })

            ->addColumn('bmi_category', function ($row) {
                $bmi_category = '';

                if($row->bmi_category == 'Underweight'){
                    $bmi_category = '<span class="tag tag-red">Underweight</span>';
                }else if($row->bmi_category== 'Normal weight'){
                    $bmi_category = '<span class="tag tag-green">Normal weight</span>';
                }else if($row->bmi_category == 'Overweight'){
                    $bmi_category = '<span class="tag tag-yellow">Overweight</span>';
                }else{
                    $bmi_category = '<span class="tag tag-red tx-12">Obesity</span>';
                }

                return $bmi_category;
            })
            ->rawColumns(['bmi_category'])

            ->make(true);
        }
        return view('dietplans.view_report_diet_plan');

    }

    public function printReport()
    {
        //
        $data = $this->getUsage();
         $name = 'Diet Plans Usage Report to '. date('Y-m-d') .'.pdf';
         $pdf = App::make('dompdf.wrapper');
         $pdf->loadView('dietplans.report_diet_plan',['data'=> $data]);
         return $pdf->stream($name);

    }

}
