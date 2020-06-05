@extends('layouts.app')

@section('content')
<div>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <center><h1>Table Transaksi</h1></center>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if(isset($editForm))
                        {!! Form::model('', ['url' => url('/transaksi/'.$transaksis->id), 'method' => 'put']) !!}
                        {{ Form::hidden('updated_by', Auth::user()->id, ['class' => 'form-control']) }}
                    @else
                        {!! Form::model('', ['url' => url('/transaksi'), 'method' => 'post']) !!}
                        {{ Form::hidden('created_by', Auth::user()->id, ['class' => 'form-control']) }}
                    @endif
                        {{ csrf_field() }}
                        
                        <div class="form-group col-xs-12 col-lg-12">
                            <label class="control-label">Nama Barang</label>
                            {{ Form::select('id_barang', $id_barang, isset($transaksis->id_barang) ? $transaksis->id_barang : null, ['class' => 'form-control', 'placeholder'=>'Pilih']) }}
                        </div>
                        <div class="form-group col-xs-12 col-lg-12">
                            <label class="control-label">Jenis Transaksi</label>
                            {{ Form::select('jenis_transaksi', ['Masuk'=>'Masuk','Keluar'=>'Keluar'], isset($transaksis->jenis_transaksi) ? $transaksis->jenis_transaksi : null, ['class' => 'form-control', 'placeholder'=>'Pilih']) }}
                        </div>
                        <div class="form-group col-xs-12 col-lg-12">
                            <label class="control-label">Jumlah Transaksi</label>
                            {{ Form::number('jumlah_barang', isset($transaksis->jumlah_barang) ? $transaksis->jumlah_barang : null, ['class' => 'form-control']) }}
                        </div>

                        <div class="form-group col-xs-12 col-lg-12">
                            <button type="submit" class="btn btn-success">
                                Simpan
                            </button>
                        </div>
                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
