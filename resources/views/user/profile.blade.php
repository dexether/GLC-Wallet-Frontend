@extends('layouts.master')
@section('title')
    {{ trans_choice('general.edit',1) }} {{ trans_choice('general.profile',1) }}
@endsection
@section('content')
<meta name="csrf_token"  content="{{ csrf_token() }}" />
<style>
.hide-section{
     display: none;
  }
</style>
<section>
      <div class="pageContent prf_usr">
        <div class="container">
            <div class="pageTitle"><h1>{{ trans_choice('general.edit',1) }} {{ trans_choice('general.profile',1) }}</h1></div>
    <div class="panel panel-default">
        {!! Form::open(array('url' => 'user/profile','class'=>'',"enctype" => "multipart/form-data")) !!}
        <div class="panel-body">
        <div class="alert alert-danger hide-section"   ><ul id="profile_errors"></ul></div>
            <div class="alert alert-success hide-section" ><ul id="profile_success"></ul></div>
            <div class="edt_prf cust_filds">
                <div class="row">
                 {!! Form::open(array('route' => 'uploadprofile', 'method' => 'POST', 'files' => true, 'id' => 'profile-form')) !!}
                    <div class="col-sm-3">
                        <div class="edt_img">
                             @if(Sentinel::getUser()->profile_pic=='')
                              <img src="{{ asset('assets/themes/limitless/images/user-image.jpg') }}" alt="..." class="img-preview">
                              @else
                               <img src="{{ asset('assets/profile/'.Sentinel::getUser()->profile_pic) }}" alt="..." class="img-preview">
                              @endif
                            <h2>{{Sentinel::getUser()->first_name}} {{Sentinel::getUser()->last_name}}</h2>                                
                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                <span class="btn btn-default btn-file"><span>Choose Profile</span><input type="file" name="profile_pic" accept="image/x-png,image/gif,image/jpeg,image/jpg"  onchange="readURL(this,0)"  /></span>
                                <span class="fileinput-filename"></span>
                            </div> 
                            <div class="fileinput fileinput-new" data-provides="fileinput">
                               
                                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" preserveAspectRatio="xMidYMid" width="17" height="16" viewBox="0 0 17 16">
                                                          <defs>
                                                            <style>
                                                              .cls-1 {
                                                                fill: #92a8c0;
                                                                fill-rule: evenodd;
                                                              }
                                                            </style>
                                                          </defs>
                                                          <path d="M13.843,16.000 L3.157,16.000 C1.418,16.000 -0.000,14.564 -0.000,12.794 L-0.000,8.222 C-0.000,7.947 0.216,7.727 0.487,7.727 C0.758,7.727 0.974,7.947 0.974,8.222 L0.974,12.794 C0.974,14.014 1.952,15.011 3.157,15.011 L13.843,15.011 C15.044,15.011 16.026,14.018 16.026,12.794 L16.026,8.295 C16.026,8.020 16.242,7.800 16.513,7.800 C16.784,7.800 17.000,8.024 17.000,8.295 L17.000,12.794 C17.000,14.560 15.586,16.000 13.843,16.000 ZM11.595,4.136 C11.473,4.136 11.346,4.085 11.253,3.990 L8.987,1.689 L8.987,11.724 C8.987,11.999 8.770,12.219 8.500,12.219 C8.229,12.219 8.013,11.999 8.013,11.724 L8.013,1.689 L5.747,3.990 C5.560,4.180 5.249,4.180 5.062,3.990 C4.870,3.796 4.870,3.484 5.062,3.290 L8.157,0.146 C8.247,0.051 8.370,-0.000 8.500,-0.000 C8.626,-0.000 8.752,0.055 8.843,0.146 L11.938,3.290 C12.129,3.484 12.129,3.796 11.938,3.990 C11.844,4.089 11.722,4.136 11.595,4.136 Z" class="cls-1"/>
                                                        </svg>
                                                        <a id="uploadprofile" > Upload</span></a></span>
                            </div>
                        </div>
                    </div>  
                {!! Form::close() !!}
                    <div class="col-sm-9">
                        <div class="edt_data">
                            {!! Form::open(array('url' => 'user/profile','class'=>'',"enctype" => "multipart/form-data")) !!}
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group" id="">
                        {!!  Form::label('first_name',trans('general.first_name'),array('class'=>'control-label')) !!}
                        {!! Form::text('first_name',$user->first_name,array('class'=>'form-control cust_fld','required'=>'required','id'=>'first_name', 'placeholder'=>'First name')) !!}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group" id="">
                        {!!  Form::label('last_name',trans('general.last_name'),array('class'=>'control-label')) !!}
                        {!! Form::text('last_name',$user->last_name,array('class'=>'form-control cust_fld','required'=>'required','id'=>'last_name')) !!}
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group" id="">
                        {!!  Form::label('gender',trans('general.gender'),array('class'=>'control-label')) !!}
                        <div class="customSelect"> 
                        {!! Form::select('gender', array('male' =>trans('general.male'), 'female' => trans('general.female')),$user->gender,array('class'=>'form-control cust_fld')) !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group" id="datetimepicker2">
                        {!!  Form::label('dob',trans('general.dob'),array('class'=>'control-label')) !!}
                        {!! Form::text('dob',$user->dob,array('class'=>'form-control cust_fld  date-picker','required'=>'required','id'=>'dob')) !!}
                    </div>
                </div>
            </div>
                            <?php   $street=''; $street_2 = ''; $city=''; $state=''; $postcode = ''; $country=''; ?>
                            @if(Sentinel::getUser()->address)
                                <?php

                                $address = explode("|", Sentinel::getUser()->address);
                                $street = $address[0];
                                $street_2 = $address[1];
                                $city = $address[2];
                                $state = $address[3];
                                $postcode = $address[4];

                                ?>
                            @endif

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group" id="" >                       
                        {!!  Form::label('country_id',trans('general.country'),array('class'=>'control-label')) !!}
                        <div class="customSelect"> 
                        {!! Form::select('country_id',$countries,$user->country_id,array('class'=>'  form-control select cust_fld','required'=>'required','id'=>'country')) !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group" id="">
                        {!!  Form::label('city',trans('general.city'),array('class'=>'control-label')) !!}
                        {!! Form::text('city',$city,array('class'=>'form-control cust_fld','required'=>'required','id'=>'city')) !!}
                    </div>
                </div>
            </div>

            <div class="row">
                 <div class="col-sm-6">
                    <div class="form-group">
                        <input type="text" class="form-control cust_fld" placeholder="Street Address 1" name="street" value="{{$street}}">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <input type="text" class="form-control cust_fld" placeholder="Street Address 2" name="street_2" value="{{$street_2}}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <input type="text" class="form-control cust_fld" placeholder="State" name="state" value="{{$state}}">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <input type="text" class="form-control cust_fld" placeholder="Postcode" name="postcode" value="{{$postcode}}">
                    </div>
                </div>
            </div>
            <div class="row">

              

              @php
              $code ="";
              $number ="";
              
                  if(substr($user->phone, 0,3) == '971'){
                      $code = 971;
                      $number =substr($user->phone, 3);
                    }
                  elseif(substr($user->phone, 0,2) == '91'){
                    $code = 91;
                    $number =substr($user->phone, 2);
                  }
                  elseif(substr($user->phone, 0,1) == '1')
                    {$code = 1;
                    $number =substr($user->phone, 1);
                  }
              @endphp

                <div class="col-md-2">
                    <div class="form-group" id="">
                       {!!  Form::label('phone','code',array('class'=>'control-label')) !!}
                         {!! Form::select('code',array(''=>'Country Code','91'=>'IN (+91)','971' => 'UAE (+971) ','1'=>'USA (+1)',),$code,array('class' => ' cust_fld select form-control','required'=>'required','id'=>'code')) !!}
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group" id="">
                        {!!  Form::label('phone',trans('general.phone'),array('class'=>'control-label')) !!}
                        {!! Form::text('phone',$number,array('class'=>'form-control cust_fld','required'=>'required','id'=>'phone')) !!}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group" id="">
                        {!!  Form::label(trans_choice('general.email',1),null,array('class'=>'control-label')) !!}
                        {!! Form::email('email',$user->email,array('class'=>'form-control cust_fld','required'=>'required')) !!}
                    </div>
                </div>
            </div>
            <!-- <div class="row">
                <div class="col-md-6">
                    <div class="form-group" id="">
                        {!!  Form::label(trans('general.password'),null,array('class'=>'control-label')) !!}
                        {!! Form::password('password',array('class'=>'form-control cust_fld')) !!}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group" id="">
                        {!!  Form::label(trans('general.repeat_password'),null,array('class'=>'control-label')) !!}
                        {!! Form::password('rpassword',array('class'=>'form-control cust_fld')) !!}
                    </div>
                </div>
            </div> -->
                    <div class="act_btns withdrw_btc">
                         <button type="submit" class="btn btn-default  btn-xs send_rec pull-left"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" preserveAspectRatio="xMidYMid" width="13" height="13" viewBox="0 0 13 13">
  <defs>
    <style>
      .cls-1 {
        fill: #92a8c0;
        fill-rule: evenodd;
      }
    </style>
  </defs>
  <path d="M12.658,12.664 C12.453,12.866 12.145,13.000 11.820,13.000 L10.212,13.000 L2.788,13.000 L1.180,13.000 C0.855,13.000 0.564,12.866 0.342,12.664 C0.137,12.463 -0.000,12.161 -0.000,11.842 L-0.000,1.157 C-0.000,0.839 0.137,0.553 0.342,0.335 C0.564,0.134 0.855,-0.000 1.180,-0.000 L2.788,-0.000 L9.801,-0.000 L10.212,-0.000 C10.314,-0.000 10.400,0.033 10.468,0.101 L12.897,2.482 C12.966,2.550 13.000,2.633 13.000,2.734 L13.000,11.859 C13.000,12.178 12.863,12.463 12.658,12.664 ZM3.130,12.312 L9.853,12.312 L9.853,9.192 C9.853,9.142 9.835,9.108 9.801,9.075 C9.767,9.041 9.733,9.024 9.682,9.024 L3.301,9.024 C3.250,9.024 3.216,9.041 3.181,9.075 C3.147,9.108 3.130,9.142 3.130,9.192 L3.130,12.312 ZM9.870,0.755 C9.870,0.738 9.870,0.721 9.853,0.721 C9.835,0.721 9.835,0.704 9.818,0.704 L3.147,0.704 L3.147,4.663 C3.147,4.747 3.181,4.814 3.233,4.864 C3.284,4.915 3.353,4.948 3.438,4.948 L9.579,4.948 C9.664,4.948 9.733,4.915 9.784,4.864 C9.835,4.814 9.870,4.747 9.870,4.663 L9.870,0.755 ZM12.264,2.868 L10.554,1.191 L10.554,4.663 C10.554,4.932 10.434,5.183 10.263,5.351 C10.075,5.535 9.835,5.636 9.562,5.636 L3.438,5.636 C3.164,5.636 2.908,5.519 2.737,5.351 C2.549,5.166 2.446,4.932 2.446,4.663 L2.446,0.704 L1.197,0.704 C1.078,0.704 0.958,0.755 0.872,0.839 C0.787,0.922 0.735,1.040 0.735,1.157 L0.735,11.859 C0.735,11.977 0.787,12.094 0.872,12.178 C0.958,12.262 1.078,12.312 1.197,12.312 L2.429,12.312 L2.429,9.192 C2.429,8.957 2.532,8.739 2.685,8.588 C2.839,8.437 3.062,8.337 3.301,8.337 L9.682,8.337 C9.921,8.337 10.143,8.437 10.297,8.588 C10.451,8.739 10.554,8.957 10.554,9.192 L10.554,12.312 L11.803,12.312 C11.922,12.312 12.042,12.262 12.128,12.178 C12.213,12.094 12.264,11.977 12.264,11.859 L12.264,2.868 ZM9.100,4.412 L7.389,4.412 C7.304,4.412 7.235,4.344 7.235,4.261 L7.235,2.583 C7.235,2.499 7.304,2.432 7.389,2.432 L9.100,2.432 C9.185,2.432 9.254,2.499 9.254,2.583 L9.254,4.261 C9.254,4.344 9.185,4.412 9.100,4.412 ZM4.481,9.628 L8.501,9.628 C8.689,9.628 8.860,9.779 8.860,9.981 C8.860,10.165 8.706,10.333 8.501,10.333 L4.481,10.333 C4.293,10.333 4.122,10.182 4.122,9.981 C4.122,9.796 4.276,9.628 4.481,9.628 ZM4.481,11.004 L8.501,11.004 C8.689,11.004 8.860,11.155 8.860,11.356 C8.860,11.541 8.706,11.708 8.501,11.708 L4.481,11.708 C4.293,11.708 4.122,11.557 4.122,11.356 C4.122,11.172 4.276,11.004 4.481,11.004 Z" class="cls-1"/>
</svg> {{trans_choice('general.save',1)}}</button>
                        </div>
                    </div>                        
            </div>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
</div>
</div>
</section>
@endsection
@section('footer-scripts')
    <script src="{{ asset('assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>
    <script type="application/javascript" >
      function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('.img-preview').attr('src', e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
        }
      }
    </script>
     <script>
      $('#uploadprofile').click( function(e){
        $( ".alert-danger").hide();
        $( ".alert-success").hide();
        var formData = new FormData($("#profile-form")[0]);
         formData.append('images', $('input[type=file]')[0].files[0]);
         console.log(formData);
         if($('input[type=file]')[0].files[0])
         {
          $.ajax({
              async:false,
              type:'post',
              processData: false,
              contentType: false,
              headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
              url:"{{route('uploadprofile')}}",
              data: formData,
              success: function (responseData) {
                   $("#profile_success").html('');
                   $("#profile_success").append('<li>Profile updated successfully.</li><br>' );
                   $( ".alert-success").show();
              },
              error: function (responseData) {
                  $("#profile_errors").html('');
                  var errors = $.parseJSON(responseData.responseText);
                  var i=1;
                  $.each( errors, function( key, value ) {
                      $("#profile_errors").append('<li>'+ i++ +'.'+ value+'</li><br>' );
                      $( ".alert-danger").show();
                  });
                  var scroll_error = $(".alert.alert-danger").offset().top;
                  $(window).scrollTop(scroll_error-100);
              }
          });
        }
        else{
           $("#profile_errors").html('');
           $("#profile_errors").append('<li>Oops! Profile picture not selected.</li><br>' );
           $( ".alert-danger").show();
        }
    });
   </script>
@endsection