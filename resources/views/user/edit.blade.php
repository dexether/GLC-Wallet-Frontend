@extends('layouts.master')
@section('title')
    {{ trans_choice('general.edit',1) }} {{ trans_choice('general.user',1) }}
@endsection
@section('content')
    <div class="panel panel-white">
        <div class="panel-heading">
            <h6 class="panel-title">{{ trans_choice('general.edit',1) }} {{ trans_choice('general.user',1) }}</h6>

            <div class="heading-elements">

            </div>
        </div>
        {!! Form::open(array('url' => 'user/'.$user->id.'/update','class'=>'',"enctype" => "multipart/form-data")) !!}
        <div class="panel-body">
            {!! Form::hidden('previous_role',$selected,array('class'=>'form-control','required'=>'required')) !!}

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
                        {!! Form::text('dob',$user->dob,array('class'=>'form-control date-picker','id'=>'dob')) !!}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group" id="">
                        {!!  Form::label('country_id',trans('general.country'),array('class'=>'control-label')) !!}
                        {!! Form::select('country_id',$countries,$user->country_id,array('class'=>'form-control select2','required'=>'required','id'=>'country')) !!}
                    </div>
                </div>
                <?php   $street=''; $street_2 = ''; $city=''; $state=''; $postcode = ''; $country=''; ?>

                <?php
                if($user->address){
                    $address = explode("|", $user->address);

                    $street = $address[0];
                    $street_2 = $address[1];
                    $city = $address[2];
                    $state = $address[3];
                    $postcode = $address[4];
                }


                ?>
                <div class="col-md-6">
                    <div class="form-group" id="">
                        {!!  Form::label('city',trans('general.city'),array('class'=>'control-label')) !!}
                        {!! Form::text('city',$city,array('class'=>'form-control','id'=>'city')) !!}
                    </div>
                </div>
            </div>




            <div class="row">
                <div class="col-md-6">
                    <div class="form-group" id="">
                        {!!  Form::label('address',trans('general.address'),array('class'=>'control-label')) !!}
                        {!! Form::text('address',$street,array('class'=>'form-control','id'=>'address','rows'=>'2')) !!}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group" id="">
                        {!!  Form::label('phone',trans('general.phone'),array('class'=>'control-label')) !!}
                        {!! Form::number('phone',$user->phone,array('class'=>'form-control','id'=>'phone')) !!}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group" id="">
                        {!!  Form::label(trans_choice('general.email',1),null,array('class'=>'control-label')) !!}
                        {!! Form::email('email',$user->email,array('class'=>'form-control','required'=>'required')) !!}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group" id="">
                        {!!  Form::label(trans('general.password'),null,array('class'=>'control-label')) !!}
                        {!! Form::password('password',array('class'=>'form-control')) !!}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group" id="">
                        {!!  Form::label(trans('general.repeat_password'),null,array('class'=>'control-label')) !!}
                        {!! Form::password('rpassword',array('class'=>'form-control')) !!}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        {!!  Form::label('role',trans_choice('general.role',1),array('class'=>' control-label')) !!}
                        {!! Form::select('role',$role,$selected,array('class'=>'form-control')) !!}
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        {!!  Form::label('email_verified',trans_choice('general.email_verified',1),array('class'=>' control-label')) !!}
                        {!! Form::select('email_verified',array('1'=>trans_choice('general.yes',1),'0'=>trans_choice('general.no',1)),$user->email_verified,array('class'=>'form-control')) !!}
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        {!!  Form::label('phone_verified',trans_choice('general.phone_verified',1),array('class'=>' control-label')) !!}
                        {!! Form::select('phone_verified',array('1'=>trans_choice('general.yes',1),'0'=>trans_choice('general.no',1)),$user->phone_verified,array('class'=>'form-control')) !!}
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        {!!  Form::label('documents_verified',trans_choice('general.documents_verified',1),array('class'=>' control-label')) !!}
                        @php
                            if($user->id_picture!='' && $user->proof_of_residence_picture!='')
                               $disabled=  "";
                                else
                                 $disabled=  "disabled =>true";


                        @endphp
                        <br>

                        @if(Sentinel::getUser()->proof_of_residence_picture)
                                                             <a  target="_blank" href="{{URL::asset('uploads/'.Sentinel::getUser()->proof_of_residence_picture)}}">proof_of_residence_picture :: {{Sentinel::getUser()->proof_of_residence_picture}}</a>
                        @endif
                        <br>
                                                              @if(Sentinel::getUser()->id_picture)
                                                               <a target="_blank" href="{{URL::asset('uploads/'.Sentinel::getUser()->id_picture)}}">id_picture {{Sentinel::getUser()->id_picture}}</a>

                                                               @endif

                        {!! Form::select('documents_verified',array('1'=>trans_choice('general.yes',1),'0'=>trans_choice('general.no',1)),$user->documents_verified,array('class'=>'form-control',$disabled )) !!}
                    </div>
                    <span >@if($user->id_picture=='' || $user->proof_of_residence_picture=='') No documents uploaded by user @elseif($user->id_picture!='' || $user->proof_of_residence_picture!='') documents uploaded by user @endif</span>
                </div>
            </div>

        </div>
        <!-- /.panel-body -->
        <div class="panel-footer">
            <div class="heading-elements">
                <button type="submit" class="btn btn-primary pull-right">{{trans_choice('general.save',1)}}</button>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
@endsection
@section('footer-scripts')
    <script src="{{ asset('assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>

@endsection