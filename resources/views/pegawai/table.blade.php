@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Table Pegawai</div>

                <div class="card-body">
                    <div class="table-responsive">
                        <a class="btn btn-primary" href="javascript:;" data-toggle="modal" data-target="#formPegawai">
                            Tambah Data
                        </a>
                        <p></p>
                        <table class="table table-hover table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center">Nomor Induk Pegawai</th>
                                    <th class="text-center">Nama</th>
                                    <th class="text-center">Jabatan</th>
                                    <th class="text-center">Alamat</th>
                                    <th class="text-center">&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<div id="formPegawai" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Form Pegawai</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">                    
                <div class="form-group col-xs-12 col-lg-12">
                    <label class="control-label">Nomor Induk Pegawai</label>
                    {{ Form::text('nomor_induk_pegawai', null, ['class' => 'form-control']) }}
                </div>
                <div class="form-group col-xs-12 col-lg-12">
                    <label class="control-label">Nama</label>
                    {{ Form::text('nama', null, ['class' => 'form-control']) }}
                </div>
                <div class="form-group col-xs-12 col-lg-12">
                    <label class="control-label">Jabatan</label>
                    {{ Form::text('jabatan', null, ['class' => 'form-control']) }}
                </div>
                <div class="form-group col-xs-12 col-lg-12">
                    <label class="control-label">Alamat</label>
                    {{ Form::text('alamat', null, ['class' => 'form-control']) }}
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" onclick="submit()">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="{{ asset('js/jquery.min.js') }}"></script>
<script type="text/javascript">
    var idEdit = 0;

    $(document).ready(function(){        
        getIndex();
    });

    function getIndex(){
        $.ajax({
            type : 'get',
            url : 'http://localhost/belajar-laravel/public/pegawai/list',
            success : function(data){  
                $('tbody').html('');              
                $(data).each(function(x,y){
                    result = 
                    '<tr>'
                        + '<td>'+y.nomor_induk_pegawai+'</td>'
                        + '<td>'+y.nama+'</td>'
                        + '<td>'+y.jabatan+'</td>'
                        + '<td>'+y.alamat+'</td>'
                        + '<td>'
                            + '<a href="javascript:;" onclick="editPegawai('+y.id+')"><i class="fas fa-edit"></i></a>'
                            + '<a href="javascript:;" onclick="destroyPegawai(this.parentNode.parentNode, '+y.id+')"><i class="fas fa-trash-alt"></i></a>'
                        + '</td>'
                    + '</tr>';
                    $('tbody').append(result);
                });            
            },
        });
    }

    function submit(){
        var url;
        var type;
        var result;

        if( idEdit != 0 ){
            url = 'http://localhost/belajar-laravel/public/pegawai/'+idEdit;
            type = 'put';
        }else{
            url = 'http://localhost/belajar-laravel/public/pegawai';
            type = 'post';
        }

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type : type,
            url : url,
            data : {
                nomor_induk_pegawai : $('[name=nomor_induk_pegawai]').val(),
                nama : $('[name=nama]').val(),
                jabatan : $('[name=jabatan]').val(),
                alamat : $('[name=alamat]').val(),
            },
            success : function(data){   
                idEdit = 0;   
                $('[name=nomor_induk_pegawai]').val('');
                $('[name=nama]').val('');
                $('[name=jabatan]').val('');
                $('[name=alamat]').val('');
                $('#formPegawai').modal('hide');
                getIndex();
            },
        });
    }

    function editPegawai(id){        
        $.ajax({
            type : 'get',
            url : 'http://localhost/belajar-laravel/public/pegawai/'+id+'/edit',
            success : function(data){
                idEdit = data.id;                
                $('#formPegawai').modal('show');
                $('[name=nomor_induk_pegawai]').val(data.nomor_induk_pegawai);
                $('[name=nama]').val(data.nama);
                $('[name=jabatan]').val(data.jabatan);
                $('[name=alamat]').val(data.alamat);                             
            },
        });
    }

    function destroyPegawai(element, id){        
        $.ajax({
            type : 'get',
            url : 'http://localhost/belajar-laravel/public/pegawai/destroy/'+id,
            success : function(data){
                if( data == 'sukses' ){
                    element.remove();
                }                                
            },
        });
    }
</script>
@endsection
