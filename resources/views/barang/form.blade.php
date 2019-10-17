@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Table Barang</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if(isset($editForm))
                        {!! Form::model('', ['url' => url('/barang/'.$barangs->id), 'method' => 'put']) !!}
                    @else
                        {!! Form::model('', ['url' => url('/barang'), 'method' => 'post']) !!}
                    @endif
                        {{ csrf_field() }}
                        
                        <div class="form-group col-xs-12 col-lg-12">
                            <label class="control-label">Nama Barang</label>
                            {{ Form::text('nama_barang', isset($barangs->nama_barang) ? $barangs->nama_barang : null, ['class' => 'form-control']) }}
                        </div>
                        <div class="form-group col-xs-12 col-lg-12">
                            <label class="control-label">Jumlah Barang</label>
                            {{ Form::number('jumlah_barang', isset($barangs->jumlah_barang) ? $barangs->jumlah_barang : null, ['class' => 'form-control']) }}
                        </div>
                        <div class="form-group col-xs-12 col-lg-12">
                            <label class="control-label">Keterangan</label>
                            {{ Form::textarea('keterangan', isset($barangs->keterangan) ? $barangs->keterangan : null, ['class' => 'form-control']) }}
                        </div>

                        <div class="form-group col-xs-12 col-lg-12">
                            <button type="submit" class="btn btn-success">
                                Simpan
                            </button>
                        </div>
                        {{ Form::hidden('updated_by', Auth::user()->id, ['class' => 'form-control']) }}
                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
