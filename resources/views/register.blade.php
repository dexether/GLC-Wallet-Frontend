@extends('layouts.auth')
@section('title')
    {{ trans('general.register') }}
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-5 col-lg-offset-3">
            <div class="panel  registration-form">
                <div class="panel-body">
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
                        <div class="icon-object border-success text-success"><i class="icon-plus3"></i></div>
                    </div>
                    {!! Form::open(array('url' => url('register'), 'method' => 'post', 'name' => 'form','class'=>'register-form')) !!}
                    <div class="text-center">
                        <h5 class="content-group-lg">{{ trans('general.sign_up') }}
                            <small class="display-block">{{ trans('general.all_fields_required') }}</small>
                        </h5>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group has-feedback">
                                {!! Form::text('first_name', null, array('class' => 'form-control', 'placeholder'=>trans_choice('general.first_name',1),'required'=>'required','id'=>'first_name')) !!}
                                <div class="form-control-feedback">
                                    <i class="icon-user-check text-muted"></i>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group has-feedback">
                                {!! Form::text('last_name', null, array('class' => 'form-control', 'placeholder'=>trans_choice('general.last_name',1),'required'=>'required','id'=>'last_name')) !!}
                                <div class="form-control-feedback">
                                    <i class="icon-user-check text-muted"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group has-feedback has-feedback">
                        {!! Form::email('email', null, array('class' => 'form-control', 'placeholder'=>trans_choice('general.email',1),'required'=>'required','id'=>'email')) !!}
                        <div class="form-control-feedback">
                            <i class="icon-envelop text-muted"></i>
                        </div>
                    </div>
                        <div class="row">
                            <div class="col-md-4">
                    <div class="form-group has-feedback has-feedback">

                        {!! Form::select('code',array(''=>'Country Code','91'=>'IN (+91)','971' => 'UAE (+971) ','1'=>'USA (+1)',),old('code'),array('class' => 'select form-control','required'=>'required','id'=>'code')) !!}

                        <div class="form-control-feedback">

                        </div>
                    </div>
                            </div>
                            <div class="col-md-8">
                        <div class="form-group has-feedback has-feedback">

                        {!! Form::text('phone', null, array('class' => 'form-control', 'placeholder'=>trans_choice('general.phone',1),'required'=>'required','id'=>'phone')) !!}
                        <div class="form-control-feedback">
                            <i class="icon-phone text-muted"></i>
                        </div>
                    </div>
                    </div>

                        </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group has-feedback">
                                {!! Form::password('password', array('class' => 'form-control', 'placeholder'=>trans('general.password'),'required'=>'required','id'=>'password')) !!}
                                <div class="form-control-feedback">
                                    <i class="icon-lock2 text-muted"></i>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group has-feedback">
                                {!! Form::password('repeat_password', array('class' => 'form-control', 'placeholder'=>trans('general.repeat_password'),'required'=>'required','id'=>'repeat_password')) !!}
                                <div class="form-control-feedback">
                                    <i class="icon-lock2 text-muted"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="newsletter" class="styled" checked="checked"
                                       id="newsletter">
                                {{ trans('general.subscribe_to_newsletter') }}
                            </label>
                        </div>

                        <div class="checkbox">
                            <label class="checkbox-inline">
                                <input type="checkbox" name="terms" class="styled" checked="checked" id="terms"
                                       required>
                                {{ trans('general.accept_terms') }}
                            </label>
                        </div>
                    </div>

                    <div class="text-right">
                        <a href="{{url('login')}}" class="btn btn-link"><i
                                    class="icon-arrow-left13 position-left"></i> {{ trans('general.back') }}
                            {{ trans('general.to') }} {{ trans('general.login') }}
                        </a>
                        <button type="submit" class="btn bg-teal-400 "> {{ trans('general.sign_up') }}
                        </button>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

@endsection
@section('footer-scripts')
    <script>
        $.validator.addMethod('mypassword', function (value, element) {
                return this.optional(element) || (value.match(/[a-zA-Z]/) && value.match(/[0-9]/));
            },
            'Password must contain at least one numeric and one alphabetic character.');

        $.validator.addMethod('phone', function (value, element) {
                return this.optional(element) || (value.match(/[0-9]/));
            },
            'Invalid mobile number, please enter with country code.');



        $(".register-form").validate({
            rules: {
                field: {
                    required: true,
                    step: 10
                },
                code: {
                    required: true,
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
                },

            }, highlight: function (element) {
                $(element).closest('.form-group').addClass('has-error');
            },
            unhighlight: function (element) {
                $(element).closest('.form-group').removeClass('has-error');
            },
            errorElement: 'span',
            errorClass: 'help-block',
            errorPlacement: function (error, element) {
                if (element.parent('.input-group').length) {
                    error.insertAfter(element.parent());
                } else {
                    error.insertAfter(element);
                }
            }
        });




    </script>
@endsection