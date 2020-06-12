<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\User as model;
use Auth;

class sg_user extends Controller
{
    public function index(){
    	$data = model::all();
    	$success['data'] =  $data;
        
        return response()->json(['success' => $success], 200);
    }

    public function store(Request $request){
    	$validatedData = $request->validate([
	        'name' => 'required|max:255',
	        'email' => 'email',
		    'password' => 'required|confirmed|min:6',
		    'role' => 'required',
	    ]);

    	model::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

    	return response()->json(['success' => true], 200);
    }

    public function edit($id){
    	$data = model::find($id);
    	$success['data'] =  $data;
        
        return response()->json(['success' => $success], 200);
    }

    public function update(Request $request, $id){

    	if(isset($request->password) && isset($request->password_confirmation) && $request->password !== '' && $request->password_confirmation !== ''){
    		$validatedData = $request->validate([
		        'name' => 'required|max:255',
		        'email' => 'email',
			    'password' => 'required|confirmed|min:6',
			    'role' => 'required',
		    ]);
    	}else{
    		$validatedData = $request->validate([
		        'name' => 'required|max:255',
		        'email' => 'email',
			    'role' => 'required',
		    ]);
    	}

    	$data = $request->except('_method', '_token', 'password_confirmation');

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

    	return response()->json(['success' => true], 200);
    }

    public function delete($id){
    	model::destroy($id);
        
        return response()->json(['success' => true], 200);
    }
}
