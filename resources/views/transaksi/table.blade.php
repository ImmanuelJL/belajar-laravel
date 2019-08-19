@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Table Transaksi</div>

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
                                            <a href="{{ URL::route('transaksi.edit',$transaksi->id) }}"><i class="fas fa-edit"></i></a>
                                            <a href="{{ url('transaksi/destroy/'.$transaksi->id) }}"><i class="fas fa-trash-alt"></i></a>
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
