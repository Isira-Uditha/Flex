<?php

namespace App\Http\Controllers;

use App\Models\Packages;
use App\Models\Payment;
use App\Models\User;
use App\Services\PaymentService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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
    public function create(Request $request)
    {
        $action = $request->action;
        $id = $request->id;
        // $uid = Auth::();
        $payment_service = new PaymentService();
        $data = $request->all();

        if($action == 'Add'){
            $rules = [
                'package_id' => 'required',
                'card_name' => 'required',
                'card_number' => 'required',
                'expiremonth' => 'required',
                'expireyear' => 'required',
                'cvv' => 'required',
            ];
        }

        $validatedData = Validator::make(
            $request->all(),
            $rules,
            [
                'package_id.required' => 'This field is required',
                'card_name.required' => 'This field is required',
                'card_number.required' => 'This field is required',
                'expiremonth.required' => 'This field is required',
                'expireyear.required' => 'This field is required',
                'cvv.required' => 'This field is required',
            ]
        );

        if ($validatedData->fails()) {
            return redirect()->back()->withInput()->withErrors($validatedData->errors())
                ->with('error_message', 'please check as we’re missing some information.');
        }else{
            switch($action){
                case 'Add':
                    if($this->store($data)){
                        $this->sendEmail($data);
                        return redirect(route('payment_index'))->with('success_message', 'Your payment was successful');
                    }else{
                        return redirect()->back()->with('error_message', 'Request Unsucessfull');
                    }
                    return view('payment.create',compact('data'));

                    break;
                default;
            }

        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($data)
    {
        $payment = new Payment();
        $payment->payment_date = Carbon::createFromFormat('m/d/Y',$data['date'])->format('Y-m-d');
        $payment->package_id = $data['package_id'];
        $payment->uid = $data['uid'];

        if($payment->save()){
            $user = User::where('uid',$data['uid'])->first();
            $user->package_id = $data['package_id'];
            return $user->save();
        }

        return false;

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

    public function sendEmail($data){
        $email['to'] = $data['email'];
        $email['subject'] = 'Payment summary due date - '.$data['date'];
        $data['user'] = User::where('uid',1)->first();
        Mail::send('payment.payment_email',compact('data'), function($message) use ($email) {
            $message->to($email['to'])
                    ->subject($email['subject']);
        });
    }
}
