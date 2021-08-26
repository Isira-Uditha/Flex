<?php

namespace App\Http\Controllers;

use App\Models\Packages;
use App\Models\User;
use App\Services\PaymentService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = $request->all();
        $payment_service = new PaymentService();
        if ($request->ajax()) {
            $payment_data = $payment_service->getPayments($data);
            return datatables()->of($payment_data)
            ->addColumn('payment_id', function ($row) {
                return $row->payment_id;
            })
            ->addColumn('payment_date', function ($row) {
                return Carbon::createFromFormat('Y-m-d',$row->payment_date)->format('m/d/Y');
            })
            ->addColumn('package_name', function ($row) {
                return $row->package_name;
            })
            ->addColumn('package_price', function ($row) {
                return $row->package_price;
            })
            ->addColumn('action', function ($row) {
                $edit = ' <a href="' . route('appointment_view',['action' => 'Print','id' => $row->payment_id]) . '" data-toggle="tooltip-primary" title="Print"><i class="fe fe-file text-success fa-lg" data-placement="top"></i></a>';
                $view = ' <a href="' . route('appointment_view',['action' => 'View','id' => $row->payment_id]) . '" data-toggle="tooltip-primary" title="View"><i class="fas fa-search text-primary fa-lg" data-placement="top"></i></a>';
                return $view.' '.$edit;
            })
            ->rawColumns(['action'])

            ->make(true);
        }

        return view('payment.index');
    }

    public function view(Request $request){
        $action = $request->action;
        $id = $request->id;
        // $uid = Auth::();
        $payment_service = new PaymentService();

        switch($action){
            case 'Add':
                $data['action'] = 'Add';
                $data['packages'] = $payment_service->getAllPackages();
                $data['package_id'] = $payment_service->getSelectedPackages(1)->package_id;
                $data['user'] = User::where('uid',1)->first();
                return view('payment.create',compact('data'));

                break;
            case 'View':
                break;
            default;
        }
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

    public function getPackagePrice(Request $request){
        $package_id = $request->package_id;

        $res = Packages::select('package_price')
        ->where('package_id',$package_id)
        ->first();

        return response()->json(['data' => $res], 200);

    }
}
