<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use App\Services\PackageService;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user.index');
    }

    public function view(Request $request)
    {
        $package_service = new PackageService();
        $action = $request->action;
        $id = $request->id;

        switch($action) {
            case 'Add':
                $data['action'] = 'Add';
                $data['packages'] = $package_service->getAllPackages($request->all());
                return view('user.create', compact('data'));
                break;
            case 'Edit':
                $data['id'] = $id;
                $data['result'] = User::where('uid',$id)->first();
                $data['action'] = 'Edit';
                return view('user.create', compact('data'));
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
        $data = $request->all();

        if($action == 'Add' || $action == 'Edit') {
            $rules  = [
                'first_name' => 'required',
                'last_name' => 'required',
                'dob' => 'required',
                'address' => 'required',
                'email' => 'required',
                'height' => 'required',
                'weight' => 'required',
                'package_id' => 'required',
            ];
        } else {
            $rules = [];
        }

        $validatedDate = Validator::make(
            $request->all(),
            $rules,
            [
                'first_name.required' => 'This field is required',
                'last_name.required' => 'This field is required',
                'dob.required' => 'This field is required',
                'address.required' => 'This field is required',
                'email.required' => 'This field is required',
                'height.required' => 'This field is required',
                'weight.required' => 'This field is required',
                'package_id.required' => 'This field is required',
            ]
        );

        if($validatedDate->fails()) {
            return redirect()->back()->withInput()->withErrors($validatedDate->errors())
                ->with('error_message','Please check the missing information');
        } else {
            switch($action){
                case 'Add':
                    $res = $this->store($data);
                    if($res) {
                        return redirect(route('user_index'))->with('success_message', 'Record created succefully ');
                    } else {
                        return redirect()->back()->withInput()->withErrors($validatedDate->errors())
                            ->with('error_message','Please check the missing information');
                    }
                    break;
                case 'Edit':
                    // $res = $this->update($data, $id);
                    // if($res) {
                    //     return redirect()->back()->with('success_message', 'Record updated succefully ');
                    // } else {
                    //     return redirect()->back()->with('success_message', 'Something went wrong, package details not updated');
                    // }
                    break;
                case 'Delete':
                    break;
                default:
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
        $user = new User();

        $user->first_name = $data['first_name'];
        $user->last_name = $data['last_name'];
        $user->address = $data['address'];
        $user->bod = $data['dob'];
        $user->role = $data['role'];
        $user->package_id = $data['package_id'];
        $user->height = $data['height'];
        $user->weight = $data['weight'];
        $user->email = $data['email'];
        $user->password = 'flex12345';

        return $user->save();
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
