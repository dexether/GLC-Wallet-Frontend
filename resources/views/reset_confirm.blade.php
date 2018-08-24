@extends('layouts.auth')
@section('title')
    {{ trans('login.reset') }}
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
        {!! Form::open(array('url' => url('reset/'.$id.'/'.$code), 'method' => 'post', 'name' => 'form','class'=>'reset-form')) !!}
        <div class="text-center">
            <h5 class="content-group">{{ trans('general.reset') }}
                <small class="display-block">{{ trans('general.reset_new_password') }}</small>
            </h5>
        </div>
        <div class="form-group has-feedback">
            {!! Form::password('password', array('class' => 'form-control', 'placeholder'=>trans('general.password'),'required'=>'required','id'=>'password')) !!}
            <div class="form-control-feedback">
                <i class="icon-lock2 text-muted"></i>
            </div>
        </div>
        <div class="form-group has-feedback">
            {!! Form::password('repeat_password', array('class' => 'form-control', 'placeholder'=>trans('general.repeat_password'),'required'=>'required','id'=>'repeat_password')) !!}
            <div class="form-control-feedback">
                <i class="icon-lock2 text-muted"></i>
            </div>
        </div>
        <div class="form-group">
            <button type="submit" class="btn bg-pink-400 btn-block">{{ trans('general.reset') }} <i
                        class="icon-arrow-right14 position-right"></i></button>
        </div>
        {!! Form::close() !!}
    </div>
    <!-- /.login-panel-body -->
@endsection
@section('footer-scripts')
    <script>
        $.validator.addMethod('mypassword', function(value, element) {
                return this.optional(element) || (value.match(/[a-zA-Z]/) && value.match(/[0-9]/));
            },
            'Password must contain at least one numeric and one alphabetic character.');
        $( ".reset-form" ).validate({
            rules: {
                field: {
                    required: true,
                    step: 10
                },
                password: {
                    required: true,
                    minlength: 6,
                    mypassword: true
                },
                repeat_password: {
                    required: true,
                    minlength: 6,
                    equalTo: "#password"
                }
            },  highlight: function(element) {
                $(element).closest('.form-group').addClass('has-error');
            },
            unhighlight: function(element) {
                $(element).closest('.form-group').removeClass('has-error');
            },
            errorElement: 'span',
            errorClass: 'help-block',
            errorPlacement: function(error, element) {
                if(element.parent('.input-group').length) {
                    error.insertAfter(element.parent());
                } else {
                    error.insertAfter(element);
                }
            }
        });
    </script>
@endsection