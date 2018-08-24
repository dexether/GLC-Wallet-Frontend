@extends('layouts.auth')
@section('title')
    {{ trans('general.reset') }}
@endsection
@section('content')
    <div class="panel panel-body login-form">
        @if(Session::has('flash_notification.message'))
            <script>toastr.{{ Session::get('flash_notification.level') }}('{{ Session::get("flash_notification.message") }}', 'Response Status')</script>
        @endif
        @if (isset($msg))
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                {{ $msg }}
            </div>
        @endif
        @if (isset($error))
            <div class="alert alert-error">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                {{ $error }}
            </div>
        @endif
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="text-center">
            <div class="icon-object border-warning text-warning"><i class="icon-spinner11"></i></div>
        </div>
        {!! Form::open(array('url' => url('reset'), 'method' => 'post', 'name' => 'form','class'=>'f-login-form')) !!}
        <div class="text-center">
            <h5 class="content-group">{{ trans('general.reset') }}
                <small class="display-block">{{ trans('general.forgot_password_msg') }}</small>
            </h5>
        </div>
        <div class="form-group has-feedback has-feedback">
            {!! Form::email('email', null, array('class' => 'form-control', 'placeholder'=>trans_choice('general.email',1),'required'=>'required')) !!}
            <div class="form-control-feedback">
                <i class="icon-envelop text-muted"></i>
            </div>
        </div>

        <div class="form-group">
            <button type="submit" class="btn bg-pink-400 btn-block">{{ trans('general.reset') }} <i
                        class="icon-arrow-right14 position-right"></i></button>
        </div>
        {!! Form::close() !!}
    </div>
    <script>
        $(document).ready(function () {

        });
    </script>
@endsection
