@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">@lang('auth.label_welcome_header')</div>

                <div class="card-body">
                    <div class="content">
                        <div class="title m-b-md">
                            @lang('auth.label_welcome_content')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
