<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Database\Eloquent\Model;
use App\Models\Course;

use App\Models\User;

use Auth;
use Config;
use DB;
use Validator;
use Input;
use Session;
use Image;
use Lang;
use App\Models\Donation;
use App\Models\Media;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index(Request $request)
    {
        $input              = $request->all();
        $getRecords         =   new User();
        $search             =   (object) null;
        $arr['search']      =   $search;
        $showrecord         =   trans('admin.ADMIN_PAGE_LIMIT_NO');
        $search_text        =   '';
        $getRecords         =   $getRecords->where('role_id',  "1");
        if (isset($input['search_text']) && $input['search_text'] != '') {
            $search_text    =  $input['search_text'];
            $getRecords     =  $getRecords->where(function ($query) use ($search_text) {
                $query->where('firstname', 'LIKE', "%$search_text%")->orWhere('lastname', 'LIKE', "%$search_text%")->orWhere('email', 'LIKE', "%$search_text%");
            });            
            $search->search_text  =   $search_text;
        }

        if (isset($input['status']) && $input['status'] != '') {
            $status          =   $input['status'];
            $getRecords      =   $getRecords->where('status',$status);
            $search->status  =   $status;
        }

        if (isset($input['showrecord']) && $input['showrecord'] != '') {
            $showrecord = $input['showrecord'];
            $search->showrecord = $showrecord;
            Session::put('showrecord', $showrecord);
        }
        $filters = $request->all();
        unset($filters['_token']);
        $arr['filters'] = $filters;
        $users = $getRecords->orderBy('id','desc')->paginate($showrecord);
        return view('admin.users.index', compact('users', 'filters', 'search', 'search_text'))->with($arr)->with('i', ($request->input('page', 1) - 1) * $showrecord);
    }

    public function create()
    {
        $action = 'add';
        return View::make("admin.users.add", compact('action'));
    }

    public function store(Request $request)
    {
        $rules = [
            'firstname'      => 'required',
            'lastname'       => 'required',
            'email'          => 'required|string|email|max:255|unique:' . User::class,
            'password'       => 'required|string|min:6',
        ];
        $messages = [
            'password.regex'  => 'Your password must be more than 8 characters long, should contain at-least 1 Uppercase, 1 Lowercase, 1 Numeric and 1 special character.',
        ];
        $request->validate($rules, $messages);

        $data   =  $request->all();       
        $data['password']   = Hash::make($request->password);   
        $user    = User::create($data);
        return redirect()->route("admin.users.edit",$user->id)->with('alert-success', 'User has been created successfully.');
    }

    public function edit($id)
    {
        $action = 'edit';
        $user = User::find($id);
        $user->password = '';
        if (empty($user)) {
            return redirect()->route('admin.users.index')->with('alert-error', 'User not found');
        }
        $courses = Course::all(); // Retrieve all courses    
        return view('admin.users.edit', compact('user', 'action' ,'courses'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'firstname' => 'required',
            'email'     => 'required|email|unique:users,email,' . $id,            
        ]);
        $data   =  $request->all();   
        $user = User::find($id);       
        if (isset($request->password)) {
            $data['password'] = Hash::make($request->password);
        }
        $user= User::find($id);
        $user->update($data);
        return redirect()->route('admin.users.index')->with('alert-success', 'User has been updated successfully');
    }
  
}
