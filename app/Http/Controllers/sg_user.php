<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User as model;
use Illuminate\Support\Facades\Hash;

class sg_user extends Controller
{
    public function index(){
    	$users = model::all();

    	return view('user.table',compact('users'));
    }

    public function create(){
    	return view('user.form');
    }

    public function store(Request $request){
    	if($request->password == '' || $request->password_confirmation == ''){
    		return \Redirect::back()->with('status','Error, Password Is Empty.');
    	}

    	if($request->password !== $request->password_confirmation){
    		return \Redirect::back()->with('status','Error, Password Confirmation Not Match.');
    	}

    	model::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

    	return redirect('user');
    }

    public function show(){
    	//
    }

    public function edit($id){
    	$editForm = true;
    	$users = model::find($id);

    	return view('user.form',compact('users','editForm'));
    }

    public function update(Request $request, $id){
    	$request = (object) $request->except('_method', '_token');

    	if($request->password !== '' && $request->password_confirmation !== '' && $request->password !== $request->password_confirmation){
    		return \Redirect::back()->with('status','Error, Password Confirmation Not Match.');
    	}

    	if(isset($request->password) && isset($request->password_confirmation) && $request->password !== '' && $request->password_confirmation !== ''){
            model::where('id',$id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $request->role,
            ]);
        }else{
            model::where('id',$id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'role' => $request->role,
            ]);
        }

    	return redirect('user');
    }

    public function destroy($id){
    	model::destroy($id);

    	return redirect('user');
    }
}
