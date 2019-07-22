<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\sg_barang as model;

class sg_barang extends Controller
{
    public function index(){
    	$barangs = model::all();

    	return view('barang.table',compact('barangs'));
    }

    public function create(){
    	return view('barang.form');
    }

    public function store(Request $request){
    	model::create($request->all());

    	return redirect('barang');
    }

    public function show(){
    	//
    }

    public function edit($id){
    	$editForm = true;
    	$barangs = model::find($id);

    	return view('barang.form',compact('barangs','editForm'));
    }

    public function update(Request $request, $id){
    	$data = $request->except('_method', '_token');
    	model::where('id',$id)->update($data);

    	return redirect('barang');
    }

    public function destroy($id){
    	model::destroy($id);

    	return redirect('barang');
    }
}
