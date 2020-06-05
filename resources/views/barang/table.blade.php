@extends('layouts.app')

@section('content')
<div>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <center><h1>Table Barang</h1></center>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="table-responsive">
                        <a class="btn btn-primary" href="{{ url('barang/create') }}">
                            Tambah Data
                        </a>
                        <p></p>
                        <table class="table table-hover table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center">Nama Barang</th>
                                    <th class="text-center">Jumlah Barang</th>
                                    <th class="text-center">Terakhir Ubah</th>
                                    <th class="text-center">&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($barangs as $barang)
                                    <tr>
                                        <td>{{ $barang->nama_barang }}</td>
                                        <td>{{ $barang->jumlah_barang }}</td>
                                        <td>{{ $barang->getUpdatedBy->name }}</td>
                                        <td>
                                            <a href="{{ URL::route('barang.edit',$barang->id) }}"><i class="fa fa-edit"></i></a>
                                            <a href="{{ url('barang/destroy/'.$barang->id) }}"><i class="fa fa-trash red-color"></i></a>
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
