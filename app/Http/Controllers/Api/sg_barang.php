<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\sg_barang as model;
use Auth;

class sg_barang extends Controller
{
    public function __construct(){
        $this->Hashids = new \Hashids\Hashids( env('MY_SECRET_SALT_KEY','MySecretSalt') );
    }

    public function index(){
    	$data = model::with('getUpdatedBy')->get();
    	$success['data'] =  $data;
        
        return response()->json(['success' => $success], 200);
    }

    public function store(Request $request){
    	$validatedData = $request->validate([
	        'nama_barang' => 'required|max:255',
	        'jumlah_barang' => 'required',
	    ]);

	    $request['updated_by'] = Auth::user()->id;

    	model::create($request->all());

    	return response()->json(['success' => true], 200);
    }

    public function edit($id){
        $id = $this->Hashids->decode($id)[0];

    	$data = model::find($id);
    	$success['data'] =  $data;
        
        return response()->json(['success' => $success], 200);
    }

    public function update(Request $request, $id){
        $id = $this->Hashids->decode($id)[0];

    	$validatedData = $request->validate([
	        'nama_barang' => 'required|max:255',
	        'jumlah_barang' => 'required',
	    ]);

	    $request['updated_by'] = Auth::user()->id;

    	$data = $request->except('_method', '_token');
    	model::where('id',$id)->update($data);

    	return response()->json(['success' => true], 200);
    }

    public function delete($id){
        $id = $this->Hashids->decode($id)[0];
        
    	model::destroy($id);
        
        return response()->json(['success' => true], 200);
    }
}
