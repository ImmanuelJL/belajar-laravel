<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\sg_transaksi as model;
use App\sg_barang;

class sg_transaksi extends Controller
{
    public function index(){
    	$transaksis = model::with('getNamaBarang','getCreatedBy','getUpdatedBy')->orderBy('id','desc')->get();

    	return view('transaksi.table',compact('transaksis'));
    }

    public function create(){
    	$id_barang = sg_barang::pluck('nama_barang','id');

    	return view('transaksi.form',compact('id_barang'));
    }

    public function store(Request $request){
    	model::create($request->all());

    	$this->updateSgBarang($request);	

    	return redirect('transaksi');
    }

    public function show(){
    	//
    }

    public function edit($id){
    	$editForm = true;
    	$transaksis = model::with('getNamaBarang')->find($id);
    	$id_barang = sg_barang::pluck('nama_barang','id');

    	return view('transaksi.form',compact('transaksis','editForm','id_barang'));
    }

    public function update(Request $request, $id){
    	// $data = $request->except('_method', '_token');
    	// model::where('id',$id)->update($data);

    	// $this->updateSgBarang($request);

    	// return redirect('transaksi');
    }

    public function destroy($id){
    	$value = model::where('id',$id);
    	$sg_barang = sg_barang::where('id',$value->value('id_barang'));

    	$sg_barang->update(["jumlah_barang"=>(int) $sg_barang->value('jumlah_barang') - (int) $value->value('jumlah_barang')]);    	
    	model::destroy($id);

    	return redirect('transaksi');
    }

    public function updateSgBarang($request){
    	$sg_barang = sg_barang::where('id',$request->id_barang);
    	$value = $sg_barang->value('jumlah_barang');
    	if( $request->jenis_transaksi == 'Masuk' ){
    		$sg_barang->update(["jumlah_barang"=>(int) $value + (int) $request->jumlah_barang]);
    	}elseif( $request->jenis_transaksi == 'Keluar' ){
    		$sg_barang->update(["jumlah_barang"=>(int) $value - (int) $request->jumlah_barang]);
    	}
    }
}
