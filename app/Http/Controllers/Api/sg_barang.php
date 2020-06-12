<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\sg_barang as model;

class sg_barang extends Controller
{
    public function index(){
    	$barangs = model::with('getUpdatedBy')->get();
    	$success['barangs'] =  $barangs;
        
        return response()->json(['success' => $success], 200);
    }
}
