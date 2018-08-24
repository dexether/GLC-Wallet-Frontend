@extends('layouts.master')
@section('title')
    {{ trans_choice('general.verify',1) }} {{ trans_choice('general.email',1) }}
@endsection
@section('content')
    <div class="panel panel-white">
        <div class="panel-heading">
            <h6 class="panel-title"> {{ trans_choice('general.verify',1) }} {{ trans_choice('general.email',1) }}</h6>

            <div class="heading-elements">

            </div>
        </div>

        <div class="panel-body">

            @if(empty(Sentinel::getUser()->email))
                <div class="alert alert-primary alert-bordered">
                    <button type="button" class="close" data-dismiss="alert"><span>×</span><span
                                class="sr-only">Close</span></button>
                    {{trans('general.verify_email_msg')}}
                </div>
                <div class="alert bg-danger alert-bordered">
                    <button type="button" class="close" data-dismiss="alert"><span>×</span><span
                                class="sr-only">Close</span></button>
                    {{trans('general.email_not_set')}}
                </div>
            @else
                @if(Sentinel::getUser()->email_verified==1)
                    <div class="alert bg-success alert-bordered">
                        <button type="button" class="close" data-dismiss="alert"><span>×</span><span
                                    class="sr-only">Close</span></button>
                        {{trans('general.email_verified')}}
                    </div>
                @else
                    <div class="alert alert-primary alert-bordered">
                        <button type="button" class="close" data-dismiss="alert"><span>×</span><span
                                    class="sr-only">Close</span></button>
                        {{trans('general.verify_email_msg')}}
                    </div>
                    @if(!isset($_COOKIE['otpresend']))
                    <button type="submit" class="btn btn-success btn-sm" id="requestOtp">{{trans_choice('general.request',1)}} {{trans_choice('general.otp',1)}}</button>
                    @endif

                    {!! Form::open(array('url' => 'user/verifyemail/checkotp','class'=>'',"enctype" => "multipart/form-data")) !!}
                    <div class="form-group" id="otpDiv">
                        {!!  Form::label('otp',trans('general.otp'),array('class'=>'control-label')) !!}
                        {!! Form::number('otp','',array('class'=>'form-control','required'=>'required','id'=>'otp')) !!}
                    </div>
                    <button type="submit" class="btn btn-primary">{{trans_choice('general.verify',1)}}</button>
                    {!! Form::close() !!}


                @endif
            @endif
        </div>
    </div>
@endsection
@section('footer-scripts')
    <script>
        $("#requestOtp").click(function (e) {
            $.ajax({
                type: 'GET',
                url: '{{url('user/verify_email/send_otp?id='.Sentinel::getUser()->id)}}',
                dataType: 'json',
                success: function (data) {
                    if (data.success === 1) {
                        swal({
                            title: '{{trans_choice('general.success',1)}}',
                            html: '{{trans_choice('general.sms_send_success',1)}}',
                            type: 'success',
                            showCancelButton: false,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: '{{trans_choice('general.ok',1)}}',
                        });
                        $('#requestOtp').hide();
                    } else {
                        swal({
                            title: '{{trans_choice('general.error',1)}}',
                            text: '{{trans_choice('general.error_occurred',1)}}',
                            type: 'warning',
                            showCancelButton: false,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: '{{trans_choice('general.ok',1)}}',
                            cancelButtonText: '{{trans_choice('general.cancel',1)}}'
                        })
                    }
                }
                ,
                error: function (e) {
                    swal({
                        title: '{{trans_choice('general.error',1)}}',
                        text: '{{trans_choice('general.error_occurred',1)}}',
                        type: 'warning',
                        showCancelButton: false,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: '{{trans_choice('general.ok',1)}}',
                        cancelButtonText: '{{trans_choice('general.cancel',1)}}'
                    })
                }
            });
        })
    </script>

@endsection