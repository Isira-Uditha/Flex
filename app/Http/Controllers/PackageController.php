<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Services\PackageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class PackageController extends Controller
{
    public function index(Request $request)
    {
        // dd($request->all());
        $package_service = new PackageService();

        $package_data = $package_service->getAllPackages($request->all());

        // dd($package_data);
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
            ->addColumn('action', function ($row) {
                return '<a href="' . url('sample/' . $row->id) . '" class="' . "delete-giveaway" . '"><i class="fas fa-trash-alt text-danger font-16 fa-lg"></i></a>';
            })
            ->rawColumns(['action'])

            ->make(true);
        }
        return view('package.index');
    }

    public function view(Request $request)
    {
        $action = $request->action;

        switch($action) {
            case 'Add':
                $data['action'] = 'Add';
                return view('package.create', compact('data'));
                break;
            case 'Edit':
                $data['action'] = 'Edit';
                return view('package.create', compact('data'));
                break;
            default;
        }
    }

    public function create(Request $request)
    {
        //
        $data = $request->all();

        $rules = [
            'package_name' => 'required',
            'package_description' => 'required',
            'package_price' => 'required',
            'package_duration' => 'required',
        ];

        $validatedDate = Validator::make(
            $request->all(),
            $rules,
            [
                'packge_name.required' => 'This field is required',
                'package_description.required' => 'This field is required',
                'package_duration.required' => 'This field is required',
                'package_price.required' => 'This field is required',
            ]
        );

        if($validatedDate->fails()) {
            return redirect()->back()->withInput()->withErrors($validatedDate->errors())
                ->with('error_message','Please check the missing information');
        } else {
            $this->store($data);
        }
    }

    public function store($data)
    {
        //
        $package = new Package();

        $package->package_name = $data['package_name'];
        $package->package_description = $data['package_description'];
        $package->package_price = $data['package_price'];
        $package->package_duration = $data['package_duration'];

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
