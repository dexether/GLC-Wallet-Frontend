@extends('layouts.master')
@section('title')
    {{trans_choice('general.edit',1)}} {{trans_choice('general.method',1)}}
@endsection
@section('content')
    <div class="panel panel-white">
        <div class="panel-heading">
            <h6 class="panel-title">{{trans_choice('general.edit',1)}} {{trans_choice('general.method',1)}}</h6>
            <div class="heading-elements">

            </div>
        </div>
        {!! Form::open(array('url' => url('payment_gateway/'.$payment_gateway->id.'/update'), 'method' => 'post', 'name' => 'form',"enctype"=>"multipart/form-data")) !!}
        <div class="panel-body">
            @if($payment_gateway->name=="Paypal")
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-12">
                            {!! Form::label('paypal_email',trans_choice('general.paypal',1)." ".trans_choice('general.email',1),array('class'=>'')) !!}
                            {!! Form::email('paypal_email',$payment_gateway->paypal_email, array('class' => 'form-control', 'placeholder'=>'','required'=>'required')) !!}
                        </div>
                    </div>
                </div>
            @elseif($payment_gateway->name=="Paynow")
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            {!! Form::label('paynow_key',trans_choice('general.paynow_key',1),array('class'=>'')) !!}
                            {!! Form::text('paynow_key',$payment_gateway->paynow_key, array('class' => 'form-control', 'placeholder'=>'','required'=>'required')) !!}
                        </div>
                        <div class="col-md-6">
                            {!! Form::label('paynow_id',trans_choice('general.paynow_id',1),array('class'=>'')) !!}
                            {!! Form::text('paynow_id',$payment_gateway->paynow_id, array('class' => 'form-control', 'placeholder'=>'','required'=>'required')) !!}
                        </div>
                    </div>
                </div>
            @elseif($payment_gateway->name=="Stripe")
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            {!! Form::label('stripe_secret_key',trans_choice('general.stripe_secret_key',1),array('class'=>'')) !!}
                            {!! Form::text('stripe_secret_key',$payment_gateway->stripe_secret_key, array('class' => 'form-control', 'placeholder'=>'','required'=>'required')) !!}
                        </div>
                        <div class="col-md-6">
                            {!! Form::label('stripe_publishable_key',trans_choice('general.stripe_publishable_key',1),array('class'=>'')) !!}
                            {!! Form::text('stripe_publishable_key',$payment_gateway->stripe_publishable_key, array('class' => 'form-control', 'placeholder'=>'','required'=>'required')) !!}
                        </div>
                    </div>
                </div>
            @elseif($payment_gateway->name=="2checkout")
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            {!! Form::label('stripe_secret_key',trans_choice('general.2checkout_secret_key',1),array('class'=>'')) !!}
                            {!! Form::text('stripe_secret_key',$payment_gateway->stripe_secret_key, array('class' => 'form-control', 'placeholder'=>'','required'=>'required','name'=>'secret_key')) !!}
                        </div>
                        <div class="col-md-6">
                            {!! Form::label('stripe_publishable_key',trans_choice('general.2checkout_publishable_key',1),array('class'=>'')) !!}
                            {!! Form::text('stripe_publishable_key',$payment_gateway->stripe_publishable_key, array('class' => 'form-control', 'placeholder'=>'','required'=>'required','name'=>'publishable_key')) !!}
                        </div>
                        <div class="col-md-6">
                            {!! Form::label('stripe_Account_Number',trans_choice('general.2checkout_supplier_id',1),array('class'=>'')) !!}
                            {!! Form::text('stripe_Account_Number',$payment_gateway->supplier_id, array('class' => 'form-control', 'placeholder'=>'','required'=>'required','name'=>'supplier_id')) !!}
                        </div>
                    </div>
                </div>
            @else
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-12">
                            {!! Form::label('name',trans_choice('general.name',1)." *",array('class'=>'')) !!}
                            {!! Form::text('name',$payment_gateway->name, array('class' => 'form-control', 'placeholder'=>trans_choice('general.name',1),'required'=>'required')) !!}
                        </div>
                    </div>
                </div>
            @endif
            <div class="form-group">
                {!! Form::label('logo',trans_choice('general.logo',1),array('class'=>'')) !!}
                @if(!empty($payment_gateway->logo))
                    <p>Current logo: <img src="{{asset('uploads/'.$payment_gateway->logo)}}" width="33"></p>
                @endif
                {!! Form::file('logo',array('class'=>'form-control','id'=>'logo')) !!}
            </div>
           {{-- <div class="form-group">
                {!! Form::label('active',trans_choice('general.active',1),array('class'=>'')) !!}
                {!! Form::select('active',array('1'=>trans_choice('general.yes',1),'0'=>trans_choice('general.no',1)),$payment_gateway->active, array('class' => 'form-control',)) !!}
            </div>--}}
            <div class="form-group">
                {!! Form::label('notes',trans_choice('general.description',1)." *",array('class'=>'')) !!}
                {!! Form::textarea('notes',$payment_gateway->notes, array('class' => 'form-control', 'required'=>"required",'rows'=>'3')) !!}
            </div>

                <div class="form-group">
                    <label for="notes" class="">Type *</label>
                    <input name="type" type="radio" value="sandbox" required @if($payment_gateway->type == 'sandbox')checked @endif ><label for="notes" class="">sandbox</label>
                    <input name="type" type="radio" value="production" required @if($payment_gateway->type == 'production')checked @endif ><label for="notes" class="">production</label>
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
    <!-- /.box -->
@endsection

