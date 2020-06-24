<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class sg_barang extends Model
{
    protected $table = 'sg_barang';

    protected $fillable = [
    	'nama_barang',
    	'jumlah_barang',
    	'keterangan',
    	'updated_by'
    ];

    public function getUpdatedBy(){
    	return $this->hasOne(User::class, 'id', 'updated_by');
    }

    public function getIdAttribute(){
        if( \Request::segment(1) === 'barang' ){
            $hashids = new \Hashids\Hashids( env('MY_SECRET_SALT_KEY','MySecretSalt') );

            return $hashids->encode($this->attributes['id']);
        }

        return $this->attributes['id'];
    }
}
