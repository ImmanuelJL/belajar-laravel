<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class sg_transaksi extends Model
{
    protected $table = 'sg_transaksi';

    protected $fillable = [
    	'id_barang',
    	'jenis_transaksi',
    	'jumlah_barang',
    	'created_by',
    	'updated_by'
    ];

    public function getNamaBarang(){
    	return $this->hasOne(sg_barang::class, 'id', 'id_barang');
    }

    public function getCreatedBy(){
    	return $this->hasOne(User::class, 'id', 'created_by');
    }

    public function getUpdatedBy(){
    	return $this->hasOne(User::class, 'id', 'updated_by');
    }
}
