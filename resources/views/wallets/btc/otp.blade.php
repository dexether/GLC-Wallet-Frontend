@extends('layouts.master')
@section('title')
    OTP
@endsection
@section('content')
<section>
      <div class="pageContent wallets">
        <div class="container">
    <div class="row">
       
        <div class="col-md-12">
            <div class="panel panel-white with_drw">
                <div class="panel-heading">
                    <h6 class="panel-title"> OTP</h6>

                    <div class="heading-elements">

                    </div>
                </div>
                {!! Form::open(array('url' => url('wallets/send/btc'), 'method' => 'post', 'id' => 'send-form',"enctype"=>"multipart/form-data")) !!}
                
                <div class="panel-body ">
                @if(session('success'))<br><div class="alert alert-success">{{ session('success') }}</div><br>@endif
                  @if(session('error'))<br><div class="alert alert-danger">{{ session('error') }}</div><br>@endif
                    <div class="form-group">
                        <input type="hidden" name="address" value="{{ $address }}">
                        <input type="hidden" name="amount" value="{{ $amount }}">
                        {!! Form::text('otp',null, array('class' => 'form-control cust_fld', 'required'=>"required",'id'=>'otp','placeholder'=>'Enter OTP')) !!}
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

      
    </script>
@endsection