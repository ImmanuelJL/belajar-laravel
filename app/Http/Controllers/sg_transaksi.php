<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\sg_transaksi as model;
use App\sg_barang;
use Excel;
use DB;

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
    	$this->updateSgBarang($request, $id);

        $data = $request->except('_method', '_token');
    	model::where('id',$id)->update($data);    	

    	return redirect('transaksi');
    }

    public function destroy($id){
    	$value = model::where('id',$id);
    	$sg_barang = sg_barang::where('id',$value->value('id_barang'));

        if( $value->first()->jenis_transaksi == 'Masuk' ){
            $sg_barang->update(["jumlah_barang"=>(int) $sg_barang->value('jumlah_barang') - (int) $value->first()->jumlah_barang]);
        }elseif( $value->first()->jenis_transaksi == 'Keluar' ){
            $sg_barang->update(["jumlah_barang"=>(int) $sg_barang->value('jumlah_barang') + (int) $value->first()->jumlah_barang]);
        }
    	model::destroy($id);

    	return redirect('transaksi');
    }

    public function updateSgBarang($request, $idTrx=''){
    	$sg_barang = sg_barang::where('id',$request->id_barang);
    	$value = $sg_barang->value('jumlah_barang');

        if( $idTrx != '' ){
            $trx = model::where('id',$idTrx)->first();            
            if( $trx->jenis_transaksi == 'Masuk' ){
                $sg_barang->update(["jumlah_barang"=>(int) $value - (int) $trx->jumlah_barang]);
            }elseif( $trx->jenis_transaksi == 'Keluar' ){
                $sg_barang->update(["jumlah_barang"=>(int) $value + (int) $trx->jumlah_barang]);
            }
            $value = sg_barang::where('id',$request->id_barang)->value('jumlah_barang');
        }

    	if( $request->jenis_transaksi == 'Masuk' ){
    		$sg_barang->update(["jumlah_barang"=>(int) $value + (int) $request->jumlah_barang]);
    	}elseif( $request->jenis_transaksi == 'Keluar' ){
    		$sg_barang->update(["jumlah_barang"=>(int) $value - (int) $request->jumlah_barang]);
    	}
    }

    public function export(){
        $data = DB::table('sg_transaksi')->select('sg_barang.nama_barang','sg_transaksi.jenis_transaksi','sg_transaksi.jumlah_barang','a.name as created_by','b.name as updated_by','sg_transaksi.updated_at')->join('sg_barang','sg_barang.id','=','sg_transaksi.id_barang')->join('users as a','a.id','=','sg_transaksi.created_by')->leftJoin('users as b','b.id','=','sg_transaksi.updated_by')->get()->toArray();
        $data_array[] = array('Nama Barang', 'Jenis Transaksi', 'Jumlah Transaksi', 'Dibuat Oleh', 'Terakhir Ubah', 'Tanggal');

        foreach($data as $trx)
        {
            $data_array[] = array(
                'Nama Barang'  => $trx->nama_barang,
                'Jenis Transaksi'   => $trx->jenis_transaksi,
                'Jumlah Transaksi'    => $trx->jumlah_barang,
                'Dibuat Oleh'  => $trx->created_by,
                'Terakhir Ubah'   => $trx->updated_by,
                'Tanggal'   => date('d M Y',strtotime($trx->updated_at))
            );
        }

        Excel::create('export-to-excel', function($excel) use ($data_array) {
            $excel->setTitle('Customer Data');
            $excel->sheet('Customer Data', function($sheet) use ($data_array){
                $sheet->fromArray($data_array, null, 'A1', false, false);
            });
        })->export('csv');
    }
}
