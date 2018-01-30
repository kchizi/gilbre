<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;

class UsersController extends Controller
{
	public function __construct(){
		$this->middleware('auth');
	}
	
	public function index(){

    	$users=User::all();
    	return view('users.index',['users'=>$users]);
	}
	public function create(){
		$roles=Role::all();
		return view('users.create',['roles'=>$roles]);
	}
    public function edit(User $user){
		$roles=Role::all();
    	return view('users.edit',['user'=>$user,'roles']);
	}
	public function changepassword(User $user){
		return view('users.changepassword',['user'=>$user]);

	}
	public function store(Request $request){
		$this->validate($request,[
			'name' => 'required|max:255',
			'email' => 'required|email|max:255|unique:users'
		]);
		$user = new User();
		$user->name=$request['name'];
		$user->email=$request['email'];
		$user->password=bcrypt('abc123');
		$user->created_by=auth()->id();
		$user->save();
		
		foreach($request['role'] as $myrole){
			$role=Role::find($myrole);
			$user->roles()->attach($role);
		}
		
		return redirect()->route('users.index')->with('message','user create Successfully');
	}
	
    public function update(User $user,Request $request){

    	$this->validate($request,[
    		'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required|min:6|confirmed',
    		]);

    	$user->name=$request['name'];
		$user->email=$request['email'];
		$user->password=bcrypt($request['password']);
		$user->edited_by=auth()->id();
		$user->save();

		foreach($request['roles'] as $myrole){
			$role=Role::find($myrole);
			$user->roles()->attach($role);
		}

    	return redirect()->route('home')->with('message','user edited Successfully');

	}
	public function updatepassword(Request $request,User $user){
		$this->validate($request,[
			'password' => 'required|min:6|confirmed',
			'password_confirmation' => 'required|min:6'
		]);

		$user->password=bcrypt($request['password']);
		$user->save();
		return redirect()->route('logout');

	}
    public function delete(User $user){
    	foreach($user->roles as $role){
    		$role->delete();
    	}
    	$user->delete();

    	return redirect()->route('users.index')->with('message','user deleted Successfully');

	}
	
}
