<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\sg_barang as model;
use Excel;
use Auth;

class sg_barang extends Controller
{
    public function index(){
    	$barangs = model::with('getUpdatedBy')->get();

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

    public function import(Request $request){
        Excel::load($request->file('import')->getRealPath(), function ($reader){
            foreach ($reader->toArray() as $key => $row) {
                $data['nama_barang'] = (isset($row['nama_barang']) && $row['nama_barang']!='') ? $row['nama_barang'] : null;
                $data['jumlah_barang'] = (isset($row['jumlah_barang']) && $row['jumlah_barang']!='') ? $row['jumlah_barang'] : null;
                $data['keterangan'] = (isset($row['keterangan']) && $row['keterangan']!='') ? $row['keterangan'] : null;
                $data['updated_by'] = Auth::user()->id;
                model::create($data);
            }
        });

        return redirect('barang');
    }
}
