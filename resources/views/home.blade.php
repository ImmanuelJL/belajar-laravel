@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="content">
                        <div class="title m-b-md">
                            Selamat Datang, {{ Auth::user()->name }}
                        </div>

                        <div class="links">
                            <a href="{{ url('barang') }}">Table Barang</a>
                        </div>

                        <div class="links">
                            <a href="{{ url('pegawai') }}">Table Pegawai</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
