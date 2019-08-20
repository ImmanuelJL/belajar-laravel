<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class sg_pegawai extends Model
{
    protected $table = 'sg_pegawai';

    protected $fillable = [
    	'nomor_induk_pegawai',
    	'nama',
    	'jabatan',
    	'alamat'
    ];
}
