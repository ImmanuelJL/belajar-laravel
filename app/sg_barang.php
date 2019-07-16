<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class sg_barang extends Model
{
    protected $table = 'sg_barang';

    protected $fillable = [
    	'nama_barang',
    	'jumlah_barang',
    	'keterangan'
    ];
}
