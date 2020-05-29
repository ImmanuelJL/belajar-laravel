@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Table User</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="form-group col-xs-12 col-lg-12">
                            <div class="alert alert-danger" role="alert">
                                {{ session('status') }}
                            </div>
                        </div>
                    @endif

                    @if(isset($editForm))
                        {!! Form::model('', ['url' => url('/user/'.$users->id), 'method' => 'put']) !!}
                    @else
                        {!! Form::model('', ['url' => url('/user'), 'method' => 'post']) !!}
                    @endif
                        {{ csrf_field() }}
                        
                        <div class="form-group col-xs-12 col-lg-12">
                            <label class="control-label">Nama</label>
                            {{ Form::text('name', isset($users->name) ? $users->name : null, ['class' => 'form-control', 'required']) }}
                        </div>
                        <div class="form-group col-xs-12 col-lg-12">
                            <label class="control-label">Email</label>
                            {{ Form::email('email', isset($users->email) ? $users->email : null, ['class' => 'form-control', 'required']) }}
                        </div>
                        <div class="form-group col-xs-12 col-lg-12">
                            <label class="control-label">Password</label>
                            <input type="password" class="form-control" name="password" autocomplete="new-password">
                        </div>
                        <div class="form-group col-xs-12 col-lg-12">
                            <label class="control-label">Password Confirmation</label>
                            <input type="password" class="form-control" name="password_confirmation" autocomplete="new-password">
                        </div>
                        <div class="form-group col-xs-12 col-lg-12">
                            <label class="control-label">Role</label>
                            {{ Form::select('role', ['admin'=>'admin', 'user'=>'user'], isset($users->role) ? $users->role : null, ['class' => 'form-control', 'placeholder'=>'Pilih', 'required']) }}
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
