@extends('layouts.master')
@section('title')
    Send   {{$btc->name}}
@endsection
@section('content')
<section>
      <div class="pageContent wallets">
        <div class="container">
    <div class="row">
        <div class="col-md-4">
            <div class="panel panel-white2">
                <div class="panel-body2 ">
                    @include('left_menu.client_balance')
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="panel panel-white with_drw">
                <div class="panel-heading">
                    <h6 class="panel-title"> Send  {{$btc->name}}</h6>

                    <div class="heading-elements">

                    </div>
                </div>
                {!! Form::open(array('url' => url('wallets/send/btc'), 'method' => 'post', 'id' => 'send-form',"enctype"=>"multipart/form-data")) !!}
                
                <div class="panel-body ">
                    <span id="otpSuccess"></span>
                    <span id="otpError"></span>
                    
        @if(session('success'))<br><div class="alert alert-success" id="success">{{ session('success') }}</div><br>@endif
                  @if(session('error'))<br><div class="alert alert-danger" id="error">{{ session('error') }}</div><br>@endif
                    <div class="form-group">
                        {!! Form::label('receiver_address',trans_choice('general.address',1),array('class'=>'')) !!}
                        {!! Form::text('receiver_address',null, array('class' => 'form-control cust_fld', 'required'=>"required",'id'=>'receiver_address')) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('amount',trans_choice('general.amount',1),array('class'=>'')) !!}
                        {!! Form::text('amount',null, array('class' => 'form-control cust_fld', 'required'=>"required",'id'=>'amount')) !!}
                    </div>
                     <div class="form-group">
                        {!! Form::label('otp','OTP',array('class'=>'')) !!}
                        {!! Form::text('otp',null, array('class' => 'form-control cust_fld', 'required'=>"required",'id'=>'otp')) !!}
                    <a id="sendOTP">Send OTP</a>
                    </div>
                    
                    <div class="act_btns withdrw_btc">        
                        <button type="submit" class="btn btn-default  btn-xs send_rec pull-left"
                                id="submit_form"><i class="fa fa-paper-plane" aria-hidden="true"></i>Send</button>
                         </div>
                </div>
                
                {!! Form::close() !!}
            </div>
            <!-- /.box -->
        </div>
    </div>
</div>
</div>
</section>
@endsection
@section('footer-scripts')
    <script>

    $("#sendOTP").click(function(){
     $.ajax({
            type:"GET",
            url:"{{url('wallets/send/otp')}}",
                 success:function(res){
            if(res == 'success'){
              $("#otpSuccess").html('<div class="alert alert-success" id="">OTP Send Successfully..</div>');
              $("#success").html('');
              $("#error").html('');
            } else if(res == 'error') {
                $("#otpError").html('<div class="alert alert-danger" id="">Please update your mobile no.</div>');
                 $("#success").html('');
              $("#error").html('');
               
           }
         }
       });
});
        $("#withdraw-form").validate({
            rules: {
                field: {
                    required: true,
                    step: 10
                }
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
        $("#amount").blur(function (e) {
           //update fees
            var amount=$("#amount").val();
            var withdrawal_fixed_fee=$("#withdrawal_fixed_fee").val();
            var withdrawal_percentage_fee=$("#withdrawal_percentage_fee").val();
            if($("#fee_method").val()==="fixed"){
                $("#fee").val(withdrawal_fixed_fee);
                $("#total").val(amount-withdrawal_fixed_fee);
            }
            if($("#fee_method").val()==="percentage"){
                $("#fee").val((withdrawal_percentage_fee*amount/100));
                $("#total").val(amount-(withdrawal_percentage_fee*amount/100));
            }
            if($("#fee_method").val()==="both"){
                $("#fee").val((withdrawal_percentage_fee*amount/100)+withdrawal_fixed_fee);
                $("#total").val(amount-(withdrawal_percentage_fee*amount/100)-withdrawal_fixed_fee);
            }
        })
    </script>
@endsection