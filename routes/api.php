<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('login', 'Api\AuthController@login');

Route::group(['middleware' => 'auth:api'], function(){
    Route::post('barang', 'Api\sg_barang@index');
    Route::put('barang/store', 'Api\sg_barang@store');
    Route::post('barang/edit/{id}', 'Api\sg_barang@edit');
    Route::post('barang/update/{id}', 'Api\sg_barang@update');
    Route::delete('barang/delete/{id}', 'Api\sg_barang@delete');

    Route::post('transaksi', 'Api\sg_transaksi@index');
    Route::put('transaksi/store', 'Api\sg_transaksi@store');
    Route::post('transaksi/edit/{id}', 'Api\sg_transaksi@edit');
    Route::post('transaksi/update/{id}', 'Api\sg_transaksi@update');
    Route::delete('transaksi/delete/{id}', 'Api\sg_transaksi@delete');

    Route::group(['prefix' => '', 'middleware' => ['role']], function() {
	    Route::post('user', 'Api\sg_user@index');
	    Route::put('user/store', 'Api\sg_user@store');
	    Route::post('user/edit/{id}', 'Api\sg_user@edit');
	    Route::post('user/update/{id}', 'Api\sg_user@update');
	    Route::delete('user/delete/{id}', 'Api\sg_user@delete');
	});
});
