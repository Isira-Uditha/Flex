<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Services\PackageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;

class PackageController extends Controller
{
    public function index(Request $request)
    {
        $package_service = new PackageService();

        $package_data = $package_service->getAllPackages($request->all());

        if($request->ajax()) {
            return datatables()->of($package_data)
            ->addColumn('package_id', function($row) {
                return $row->package_id;
            })
            ->addColumn('package_name', function($row) {
                return Str::title($row->package_name);
            })
            ->addColumn('package_description', function($row) {
                return $row->package_description;
            })
            ->addColumn('package_duration', function($row) {
                return $row->package_duration;
            })
            ->addColumn('package_price', function($row) {
                return $row->package_price;
            })
            ->addColumn('discount', function($row) {
                return $row->discount;
            })
            ->addColumn('action', function ($row) {
                $delete = '<a data-placement="top" data-toggle="tooltip-primary" title="Delete" data-appid = "'.$row->package_id.'" ><i class="fas fa-trash-alt text-danger  fa-lg delete"></i></a> ';
                $edit = ' <a href="' . route('package_view', ['action' => 'Edit','id' => $row->package_id]) . '" data-toggle="tooltip-primary" title="Edit"><i class="fas fa-edit text-warning fa-lg" data-placement="top"></i></a>';
                return $edit.' '.$delete;
            })
            ->rawColumns(['action'])

            ->make(true);
        }
        return view('package.index');
    }

    public function view(Request $request)
    {
        $action = $request->action;
        $id = $request->id;
        $dates = $request->all();

        switch($action) {
            case 'Add':
                $data['action'] = 'Add';
                return view('package.create', compact('data'));
                break;
            case 'Edit':
                $data['id'] = $id;
                $data['result'] = Package::where('package_id',$id)->first();
                $data['action'] = 'Edit';
                return view('package.create', compact('data'));
                break;
            case 'All':
                $package_service = new PackageService();
                $package_data = $package_service->getAllPackages($request->all());
                $data['action'] = 'All';
                $data['packages'] = $package_data;
                return view('package.view_all', compact('data'));
                break;
            case 'Summary':
                $package_service = new PackageService();
                $package_data = $package_service->packageOrderByUser($dates);

                if($request->ajax()) {
                    return datatables()->of($package_data)
                    ->addColumn('package_id', function($row) {
                        return $row->package_id;
                    })
                    ->addColumn('package_name', function($row) {
                        return Str::title($row->package_name);
                    })
                    ->addColumn('package_duration', function($row) {
                        return $row->package_duration;
                    })
                    ->addColumn('package_price', function($row) {
                        return $row->package_price;
                    })
                    ->addColumn('member_count', function($row) {
                        return $row->count;
                    })
                    ->make(true);
                }
                return view('package.summary');
                break;
            default;
        }
    }

    public function create(Request $request)
    {
        $action = $request->action;
        $id = $request->id;
        $data = $request->all();
        $package_service = new PackageService();

        if($action == 'Add' || $action == 'Edit') {
            $rules  = [
                'package_name' => 'required',
                'package_description' => 'required',
                'package_price' => 'required|numeric',
                'package_duration' => 'required',
                'image' => ['mimes:jpg,bmp,png','required'],
            ];
        } else {
            $rules = [];
        }

        $validatedDate = Validator::make(
            $request->all(),
            $rules,
            [
                'packge_name.required' => 'This field is required',
                'package_description.required' => 'This field is required',
                'package_duration.required' => 'This field is required',
                'package_price.required' => 'This field is required',
                'image.required' => 'Image is required',
            ]
        );

        if($validatedDate->fails()) {
            return redirect()->back()->withInput()->withErrors($validatedDate->errors())
                ->with('error_message','Please check the missing information');
        } else {
            switch($action){
                case 'Add':
                    $res = $this->store($request);
                    if($res) {
                        return redirect(route('package_index'))->with('success_message', 'Record created succefully ');
                    } else {
                        return redirect()->back()->withInput()->withErrors($validatedDate->errors())
                            ->with('error_message','Please check the missing information');
                    }
                    break;
                case 'Edit':
                    $res = $this->update($data, $id);
                    if($res) {
                        return redirect()->back()->with('success_message', 'Record updated successfully ');
                    } else {
                        return redirect()->back()->with('success_message', 'Something went wrong, package details not updated');
                    }
                    break;
                case 'Delete':
                    $res = $this->destroy($id);
                    if($res){
                        return response()->json(['success' => 1, 'success_message' => 'Record deleted succefully'], 200);
                    }else{
                        return response()->json(['success' => 0, 'success_message' => 'Request unsuccefull'], 200);
                    }
                    break;
                case 'Print':
                    $data = $package_service->packageOrderByUser($request->all());

                    if(!isset($request->sts_date)){
                        $date['from'] = $request->from;
                        $date['to'] = $request->to;
                    } else{
                        $date['from'] = '';
                        $date['to'] = '';
                    }

                    $name = 'Packages Report to '. date('Y-m-d') .'.pdf';
                    $pdf = App::make('dompdf.wrapper');
                    $pdf->loadView('package.report',['data'=> $data, 'date'=> $date]);
                    // $pdf->loadHTML('123');
                    return $pdf->stream($name);
                    break;
                default:
            }
        }
    }

    public function store($data)
    {
        $file_path = Storage::disk('accountsdocs')->putFileAs('PACKAGE', $data->file('image'), $data->image->getClientOriginalName());
        $package = new Package();

        $package->package_name = $data['package_name'];
        $package->package_description = $data['package_description'];
        $package->package_price = $data['package_price'];
        $package->package_duration = $data['package_duration'];
        $package->image_path = $file_path;

        return $package->save();
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

    public function update($data, $id)
    {
        $package = Package::where('package_id', $id)->first();

        $package->package_name = $data['package_name'];
        $package->package_description = $data['package_description'];
        $package->package_duration = $data['package_duration'];
        $package->package_price = $data['package_price'];
        $package->discount = $data['discount'];

        return $package->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = Package::where('package_id', $id)->delete();
        return $result;
    }
}
