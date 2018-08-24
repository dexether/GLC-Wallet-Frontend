@extends('layouts.master')
@section('title')
    {{ trans_choice('general.verify',1) }} {{ trans_choice('general.document',2) }}
@endsection
@section('content')
    <div class="panel panel-white">
        <div class="panel-heading">
            <h6 class="panel-title"> {{ trans_choice('general.verify',1) }} {{ trans_choice('general.document',2) }}</h6>

            <div class="heading-elements">

            </div>
        </div>

        <div class="panel-body">

            @if(Sentinel::getUser()->documents_verified==1)
                <div class="alert bg-success alert-bordered">
                    <button type="button" class="close" data-dismiss="alert"><span>×</span><span
                                class="sr-only">Close</span></button>
                    {{trans('general.documents_verified')}}
                </div>
            @elseif(Sentinel::getUser()->proof_of_residence_picture == "")
                <div class="alert alert-primary alert-bordered">
                    <button type="button" class="close" data-dismiss="alert"><span>×</span><span
                                class="sr-only">Close</span></button>
                    {{trans('general.verify_documents_dob_mag')}}
                </div>
            @else
                <div class="alert alert-primary alert-bordered">
                    <button type="button" class="close" data-dismiss="alert"><span>×</span><span
                                class="sr-only">Close</span></button>
                    {{trans('general.verify_documents_msg')}}
                </div>
            @endif

            {!! Form::open(array('url' => 'user/verify_documents/check_documents','class'=>'verify-documents',"enctype" => "multipart/form-data")) !!}
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group" id="">
                        {!!  Form::label('first_name',trans('general.first_name'),array('class'=>'control-label')) !!}
                        {!! Form::text('first_name',$user->first_name,array('class'=>'form-control','required'=>'required','id'=>'first_name')) !!}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group" id="">
                        {!!  Form::label('last_name',trans('general.last_name'),array('class'=>'control-label')) !!}
                        {!! Form::text('last_name',$user->last_name,array('class'=>'form-control','required'=>'required','id'=>'last_name')) !!}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group" id="">
                        {!!  Form::label('gender',trans('general.gender'),array('class'=>'control-label')) !!}
                        {!! Form::select('gender', array('male' =>trans('general.male'), 'female' => trans('general.female')),$user->gender,array('class'=>'form-control')) !!}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group" id="">
                        {!!  Form::label('dob',trans('general.dob'),array('class'=>'control-label')) !!}
                        {!! Form::text('dob',$user->dob,array('class'=>'form-control date-picker','required'=>'required','id'=>'dob')) !!}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group" id="">
                        {!!  Form::label('country_id',trans('general.country'),array('class'=>'control-label')) !!}
                        {!! Form::select('country_id',$countries,$user->country_id,array('class'=>'form-control select2','required'=>'required','id'=>'country')) !!}
                    </div>
                </div>
            </div>

                <?php   $street=''; $street_2 = ''; $city=''; $state=''; $postcode = ''; $country=''; ?>
                @if(Sentinel::getUser()->address)
                  @php
                    $address = explode("|", Sentinel::getUser()->address);
                    $street = $address[0];
                    $street_2 = $address[1];
                    $city = $address[2];
                    $state = $address[3];
                    $postcode = $address[4];
                  @endphp
                @endif

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group" id="">
                        {!!  Form::label('city',trans('general.city'),array('class'=>'control-label')) !!}
                        {!! Form::text('city',$city,array('class'=>'form-control','required'=>'required','id'=>'city')) !!}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group" id="">
                        {!!  Form::label('address',trans('general.address'),array('class'=>'control-label')) !!}
                        {!! Form::text('address',$street,array('class'=>'form-control','required'=>'required','id'=>'address','rows'=>'2')) !!}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group" id="">
                        {!!  Form::label('zip',trans('general.zip'),array('class'=>'control-label')) !!}
                        {!! Form::text('zip',$postcode,array('class'=>'form-control','id'=>'zip')) !!}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group" id="">
                        {!!  Form::label('id_type',trans_choice('general.id',1)." ".trans_choice('general.type',1),array('class'=>'control-label')) !!}
                        {!! Form::select('id_type', array('id_card' =>trans('general.id_card'), 'passport' => trans('general.passport'), 'driver_license' => trans('general.driver_license')),$user->id_type,array('class'=>'form-control','required'=>'required','id'=>'id_type')) !!}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group" id="">
                        {!!  Form::label('id_number',trans('general.id_number'),array('class'=>'control-label')) !!}
                        {!! Form::text('id_number',$user->id_number,array('class'=>'form-control','required'=>'required','id'=>'id_number')) !!}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group" id="">

                        {!!  Form::label('id_picture',trans_choice('general.id',1)." ".trans_choice('general.picture',1),array('class'=>'control-label')) !!}
                        @if(!empty($user->id_picture))
                            <p>Current picture: <a href="{{asset('uploads/'.$user->id_picture)}}"
                                                   target="_blank">{{$user->id_picture}}</a></p>
                            {!! Form::file('id_picture',array('class'=>'form-control','id'=>'id_picture')) !!}
                        @else
                            {!! Form::file('id_picture',array('class'=>'form-control','required'=>'required','id'=>'id_picture')) !!}
                        @endif

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group" id="">
                        {!!  Form::label('proof_of_residence_type',trans_choice('general.proof_of_residence_type',1),array('class'=>'control-label')) !!}
                        {!! Form::select('proof_of_residence_type', array('bank_statement' =>trans('general.bank_statement'), 'utility_bill' => trans('general.utility_bill')),$user->proof_of_residence_type,array('class'=>'form-control','required'=>'required','id'=>'proof_of_residence_type')) !!}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group" id="">
                        {!!  Form::label('proof_of_residence_picture',trans_choice('general.proof_of_residence_picture',1),array('class'=>'control-label')) !!}
                        @if(!empty($user->proof_of_residence_picture))
                            <p>Current picture: <a href="{{asset('uploads/'.$user->proof_of_residence_picture)}}"
                                                   target="_blank">{{$user->proof_of_residence_picture}}</a></p>
                            {!! Form::file('proof_of_residence_picture',array('class'=>'form-control','id'=>'proof_of_residence_picture')) !!}
                        @else
                            {!! Form::file('proof_of_residence_picture',array('class'=>'form-control','required'=>'required','id'=>'proof_of_residence_picture')) !!}
                        @endif

                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary pull-right">{{trans_choice('general.verify',1)}}</button>
            {!! Form::close() !!}


        </div>
    </div>
@endsection
@section('footer-scripts')
    <script>

    </script>

@endsection