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

                    <div class="table-responsive">
                        <a class="btn btn-primary" href="{{ url('transaksi/create') }}">
                            Tambah Data
                        </a>
                        <a class="btn btn-success" href="{{ url('transaksi/export') }}">
                            Export to Excel
                        </a>
                        <p></p>
                        <table class="table table-hover table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center">Nama Barang</th>
                                    <th class="text-center">Jenis Transaksi</th>
                                    <th class="text-center">Jumlah Transaksi</th>
                                    <th class="text-center">Dibuat Oleh</th>
                                    <th class="text-center">Terakhir Ubah</th>
                                    <th class="text-center">&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($transaksis as $transaksi)
                                    <tr>
                                        <td>{{ $transaksi->getNamaBarang->nama_barang }}</td>
                                        <td>{{ $transaksi->jenis_transaksi }}</td>
                                        <td>{{ $transaksi->jumlah_barang }}</td>
                                        <td>{{ $transaksi->getCreatedBy->name }}</td>
                                        <td>{{ isset($transaksi->getUpdatedBy) ? $transaksi->getUpdatedBy->name : '-' }}</td>
                                        <td>
                                            <a href="{{ URL::route('transaksi.edit',$transaksi->id) }}"><i class="fa fa-edit"></i></a>
                                            <a href="{{ url('transaksi/destroy/'.$transaksi->id) }}"><i class="fa fa-trash red-color"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
