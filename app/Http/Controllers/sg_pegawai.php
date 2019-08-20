<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\sg_pegawai as model;

class sg_pegawai extends Controller
{
    public function index(){    	
    	return view('pegawai.table');
    }

    public function list(){    	
    	return model::all();
    }

    public function create(){
    	//
    }

    public function store(Request $request){
    	$result = model::create($request->all());

    	return $result;
    }

    public function show(){
    	//
    }

    public function edit($id){
    	$result = model::find($id);

    	return $result;
    }

    public function update(Request $request, $id){
    	$data = $request->except('_method', '_token');
    	model::where('id',$id)->update($data);

    	return 'sukses';
    }

    public function destroy($id){
    	model::destroy($id);

    	return 'sukses';
    }
}
