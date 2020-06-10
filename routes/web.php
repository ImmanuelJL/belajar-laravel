<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    // return view('welcome');
    return \Redirect('/login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/barang/destroy/{id}', 'sg_barang@destroy');
Route::resource('/barang', 'sg_barang');
Route::get('/transaksi/export', 'sg_transaksi@export');
Route::get('/transaksi/destroy/{id}', 'sg_transaksi@destroy');
Route::resource('/transaksi', 'sg_transaksi');

Route::get('/restricted-page', function () {
    return view('restricted-page');
});

Route::group(['prefix' => '', 'middleware' => ['role']], function() {
    Route::resource('/user', 'sg_user');
	Route::get('/user/destroy/{id}', 'sg_user@destroy');
});
