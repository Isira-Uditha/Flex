<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Services\UserService;
use App\Services\PackageService;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user_service = new UserService();

        $type = $request->u_type;
        switch($type){
            case 'Member':
                $member_data = $user_service->getAllMembers($request->all());
                if($request->ajax()) {
                    return datatables()->of($member_data)
                    ->addColumn('uid', function($row) {
                        return $row->uid;
                    })
                    ->addColumn('first_name', function($row) {
                        return Str::title($row->first_name);
                    })
                    ->addColumn('last_name', function($row) {
                        return $row->last_name;
                    })
                    ->addColumn('gender', function($row) {
                        return $row->gender;
                    })
                    ->addColumn('dob', function($row) {
                        return $row->bod;
                    })
                    ->addColumn('weight', function($row) {
                        return $row->weight;
                    })
                    ->addColumn('height', function($row) {
                        return $row->height;
                    })
                    ->addColumn('address', function($row) {
                        return $row->address;
                    })
                    ->addColumn('action', function ($row) {
                        $delete = '<a href="' . url('sample/' . $row->id) . '" class="' . "delete-giveaway" . '"><i class="fas fa-trash-alt text-danger font-16 fa-lg"></i></a>';
                        $edit = ' <a href="' . route('user_view', ['u_type' => 'Member', 'action' => 'Edit','id' => $row->uid]) . '" data-toggle="tooltip-primary" title="Edit"><i class="fas fa-edit text-warning fa-lg" data-placement="top"></i></a>';
                        return $edit.' '.$delete;
                    })
                    ->rawColumns(['action'])

                    ->make(true);
                }
                return view('user.index');
                break;
            case 'Employee':
                $employee_data = $user_service->getAllEmployees($request->all());
                if($request->ajax()) {
                    return datatables()->of($employee_data)
                    ->addColumn('uid', function($row) {
                        return $row->uid;
                    })
                    ->addColumn('first_name', function($row) {
                        return Str::title($row->first_name);
                    })
                    ->addColumn('last_name', function($row) {
                        return $row->last_name;
                    })
                    ->addColumn('gender', function($row) {
                        return $row->gender;
                    })
                    ->addColumn('dob', function($row) {
                        return $row->bod;
                    })
                    ->addColumn('weight', function($row) {
                        return $row->weight;
                    })
                    ->addColumn('height', function($row) {
                        return $row->height;
                    })
                    ->addColumn('address', function($row) {
                        return $row->address;
                    })
                    ->addColumn('role', function($row) {
                        return $row->role;
                    })
                    ->addColumn('action', function ($row) {
                        $delete = '<a href="' . url('sample/' . $row->id) . '" class="' . "delete-giveaway" . '"><i class="fas fa-trash-alt text-danger font-16 fa-lg"></i></a>';
                        $edit = ' <a href="' . route('user_view', ['u_type' => 'Employee', 'action' => 'Edit','id' => $row->uid]) . '" data-toggle="tooltip-primary" title="Edit"><i class="fas fa-edit text-warning fa-lg" data-placement="top"></i></a>';
                        return $edit.' '.$delete;
                    })
                    ->rawColumns(['action'])

                    ->make(true);
                }
                return view('employee.index');
                break;
            default;
        }
    }

    public function view(Request $request)
    {
        $package_service = new PackageService();
        $u_type = $request->u_type;
        $action = $request->action;
        $id = $request->id;

        if($u_type === 'Employee') {
            switch($action) {
                case 'Add':
                    $data['action'] = 'Add';
                    $data['u_type'] = $u_type;
                    $data['packages'] = $package_service->getAllPackages($request->all());
                    return view('user.create', compact('data'));
                    break;
                case 'Edit':
                    $data['id'] = $id;
                    $data['u_type'] = $u_type;
                    $data['result'] = User::where('uid',$id)->first();
                    $data['action'] = 'Edit';
                    return view('user.create', compact('data'));
                    break;
                default;
            }
        } else {
            switch($action) {
                case 'Add':
                    $data['action'] = 'Add';
                    $data['u_type'] = $u_type;
                    $data['packages'] = $package_service->getAllPackages($request->all());
                    return view('user.create', compact('data'));
                    break;
                case 'Edit':
                    $data['id'] = $id;
                    $data['u_type'] = $u_type;
                    $data['packages'] = $package_service->getAllPackages($request->all());
                    $data['result'] = User::where('uid',$id)->first();
                    $data['action'] = 'Edit';
                    return view('user.create', compact('data'));
                    break;
                default;
            }
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @param \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $action = $request->action;
        $id = $request->id;
        $data = $request->all();
        $u_type = $request->u_type;

        if($u_type == 'Member'){
            if($action == 'Add' || $action == 'Edit') {
                $rules  = [
                    'first_name' => 'required',
                    'last_name' => 'required',
                    'dob' => 'required',
                    'gender' => 'required',
                    'address' => 'required|max:255',
                    'email' => 'required',
                    'height' => 'required|between:0,999.99',
                    'weight' => 'required|between:0,999.99',
                    'package_id' => 'required',
                ];
            } else {
                $rules = [];
            }
        } else {
            if($action == 'Add' || $action == 'Edit') {
                $rules  = [
                    'first_name' => 'required',
                    'last_name' => 'required',
                    'dob' => 'required',
                    'gender' => 'required',
                    'address' => 'required|max:255',
                    'email' => 'required',
                    'height' => 'required|between:0,999.99',
                    'weight' => 'required|between:0,999.99',
                    'role' => 'required',
                ];
            } else {
                $rules = [];
            }
        }
        $validatedDate = Validator::make(
            $request->all(),
            $rules,
            [
                'first_name.required' => 'This field is required',
                'last_name.required' => 'This field is required',
                'dob.required' => 'This field is required',
                'gender.required' => 'This field is required',
                'address.required' => 'This field is required',
                'email.required' => 'This field is required',
                'height.required' => 'This field is required',
                'weight.required' => 'This field is required',
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
                        if($u_type === 'Member') {
                            $usermail['email'] = $data['email'];
                            $usermail['title'] = 'Welcome to Flex Fitness Gym Network';
                            // Mail::send('email.welcomeMail', $usermail, function($message)use($usermail) {
                            //     // dd($usermail);
                            //     $message->to($usermail['email'])
                            //             ->subject($usermail['title']);
                            // });
                            return redirect(route('user_index',['u_type' => 'Member']))->with('success_message', 'Record created succefully ');
                        } else {
                            return redirect(route('user_index',['u_type' => 'Employee']))->with('success_message', 'Record created succefully ');
                        }
                    } else {
                        return redirect()->back()->withInput()->withErrors($validatedDate->errors())
                            ->with('error_message','Please check the missing information');
                    }
                    break;
                case 'Edit':
                    $res = $this->update($data, $id);
                    if($res) {
                        return redirect()->back()->with('success_message', 'Record updated succefully ');
                    } else {
                        return redirect()->back()->with('success_message', 'Something went wrong, user details not updated');
                    }
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
     * @param  $data
     * @return \Illuminate\Http\Response
     */
    public function store($data)
    {
        $user = new User();

        $user->first_name = $data['first_name'];
        $user->last_name = $data['last_name'];
        $user->address = $data['address'];
        $user->bod = $data['dob'];
        $user->gender = $data['gender'];
        $user->role = $data['role'];

        if($data['role'] === 'Member'){
            $user->package_id = $data['package_id'];
        }

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
     * @param  $data
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($data, $id)
    {
        $user = User::where('uid', $id)->first();

        $user->first_name = $data['first_name'];
        $user->last_name = $data['last_name'];
        $user->address = $data['address'];
        $user->bod = $data['dob'];
        $user->gender = $data['gender'];
        $user->role = $data['role'];

        if($data['role'] === 'Member'){
            $user->package_id = $data['package_id'];
            $user->password = $data['password'];
        }

        $user->height = $data['height'];
        $user->weight = $data['weight'];
        $user->email = $data['email'];

        return $user->save();
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
