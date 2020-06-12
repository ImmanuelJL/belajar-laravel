<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\sg_transaksi as model;
use App\sg_barang;
use Auth;

class sg_transaksi extends Controller
{
    public function index(){
    	$data = model::with('getNamaBarang','getCreatedBy','getUpdatedBy')->orderBy('id','desc')->get();
    	$success['data'] =  $data;
        
        return response()->json(['success' => $success], 200);
    }

    public function store(Request $request){
    	$validatedData = $request->validate([
	        'id_barang' => 'required|max:255',
	        'jenis_transaksi' => 'required',
	        'jumlah_barang' => 'required',
	    ]);

	    $request['created_by'] = Auth::user()->id;

    	model::create($request->all());

    	$this->trx = new \App\Http\Controllers\sg_transaksi;
    	$this->trx->updateSgBarang($request);

    	return response()->json(['success' => true], 200);
    }

    public function edit($id){
    	$data = model::find($id);
    	$success['data'] =  $data;
        
        return response()->json(['success' => $success], 200);
    }

    public function update(Request $request, $id){
    	$validatedData = $request->validate([
	        'id_barang' => 'required|max:255',
	        'jenis_transaksi' => 'required',
	        'jumlah_barang' => 'required',
	    ]);

	    $request['updated_by'] = Auth::user()->id;

	    $this->trx = new \App\Http\Controllers\sg_transaksi;
    	$this->trx->updateSgBarang($request, $id);

    	$data = $request->except('_method', '_token');
    	model::where('id',$id)->update($data);

    	return response()->json(['success' => true], 200);
    }

    public function delete($id){
    	$value = model::where('id',$id);
    	$sg_barang = sg_barang::where('id',$value->value('id_barang'));

        if( $value->first()->jenis_transaksi == 'Masuk' ){
            $sg_barang->update(["jumlah_barang"=>(int) $sg_barang->value('jumlah_barang') - (int) $value->first()->jumlah_barang]);
        }elseif( $value->first()->jenis_transaksi == 'Keluar' ){
            $sg_barang->update(["jumlah_barang"=>(int) $sg_barang->value('jumlah_barang') + (int) $value->first()->jumlah_barang]);
        }
    	model::destroy($id);
        
        return response()->json(['success' => true], 200);
    }
}
