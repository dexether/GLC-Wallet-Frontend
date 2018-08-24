@extends('layouts.master')
@section('title')
    {{trans_choice('general.edit',1)}} {{trans_choice('general.currency',1)}}
@endsection
@section('content')
    <div class="panel panel-white">
        <div class="panel-heading">
            <h6 class="panel-title">{{trans_choice('general.edit',1)}} {{trans_choice('general.currency',1)}}</h6>

            <div class="heading-elements">

            </div>
        </div>
        {!! Form::open(array('url' => url('trade_currency/'.$trade_currency->id.'/update'), 'method' => 'post', 'name' => 'form',"enctype"=>"multipart/form-data")) !!}
        <div class="panel-body">

            <div class="form-group">
                <div class="row">
                    <div class="col-md-4">
                        {!! Form::label('name',trans_choice('general.name',1)." *",array('class'=>'')) !!}
                        {!! Form::text('name',$trade_currency->name, array('class' => 'form-control', 'placeholder'=>trans_choice('general.name',1),'required'=>'required')) !!}

                    </div>
                    <div class="col-md-4">
                        {!! Form::label('xml_code',trans_choice('general.xml_code',1)." *",array('class'=>'')) !!}
                        {!! Form::text('xml_code',$trade_currency->xml_code, array('class' => 'form-control', 'placeholder'=>trans_choice('general.xml_code',1),'required'=>'required')) !!}
                    </div>
                    <div class="col-md-4">
                        {!! Form::label('logo',trans_choice('general.logo',1),array('class'=>'')) !!}
                        @if(!empty($trade_currency->logo))
                            <p>Current logo: <img src="{{asset('uploads/'.$trade_currency->logo)}}" width="33"></p>
                        @endif
                        {!! Form::file('logo',array('class'=>'form-control','id'=>'logo')) !!}
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-12">
                        {!! Form::label('decimals',trans_choice('general.decimal',2),array('class'=>'')) !!}
                        {!! Form::text('decimals',$trade_currency->decimals, array('class' => 'form-control',)) !!}
                    </div>

                </div>
            </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                            {!! Form::label('fee_method',trans_choice('general.fee_method',1),array('class'=>'')) !!}
                            {!! Form::select('fee_method',array('fixed'=>trans_choice('general.fixed',1),'percentage'=>trans_choice('general.percentage',1),'both'=>trans_choice('general.both',1)),$trade_currency->fee_method, array('class' => 'form-control',)) !!}
                        </div>
                        <div class="col-md-4">
                            {!! Form::label('deposit_fixed_fee',trans_choice('general.deposit_fixed_fee',1),array('class'=>'')) !!}
                            {!! Form::number('deposit_fixed_fee',$trade_currency->deposit_fixed_fee, array('class' => 'form-control', 'placeholder'=>trans_choice('general.email',1))) !!}
                        </div>
                        <div class="col-md-4">
                            {!! Form::label('deposit_percentage_fee',trans_choice('general.deposit_percentage_fee',1),array('class'=>'')) !!}
                            {!! Form::number('deposit_percentage_fee',$trade_currency->deposit_percentage_fee, array('class' => 'form-control', 'placeholder'=>"")) !!}
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                            {!! Form::label('withdrawal_fixed_fee',trans_choice('general.withdrawal_fixed_fee',1),array('class'=>'')) !!}
                            {!! Form::number('withdrawal_fixed_fee',$trade_currency->withdrawal_fixed_fee, array('class' => 'form-control', 'placeholder'=>"")) !!}
                        </div>
                        <div class="col-md-4">
                            {!! Form::label('withdrawal_percentage_fee',trans_choice('general.withdrawal_percentage_fee',1),array('class'=>'')) !!}
                            {!! Form::number('withdrawal_percentage_fee',$trade_currency->withdrawal_percentage_fee, array('class' => 'form-control', 'placeholder'=>"")) !!}
                        </div>
                        <div class="col-md-4">
                            {!! Form::label('minimum_amount',trans_choice('general.minimum_amount',1),array('class'=>'')) !!}
                            {!! Form::number('minimum_amount',$trade_currency->minimum_amount, array('class' => 'form-control', 'placeholder'=>"")) !!}
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                            {!! Form::label('maximum_amount',trans_choice('general.maximum_amount',1),array('class'=>'')) !!}
                            {!! Form::number('maximum_amount',$trade_currency->maximum_amount, array('class' => 'form-control', 'placeholder'=>"")) !!}
                        </div>
                        <div class="col-md-4">
                            {!! Form::label('commission_fixed_fee',trans_choice('general.commission_fixed_fee',1),array('class'=>'')) !!}
                            {!! Form::number('commission_fixed_fee',$trade_currency->commission_fixed_fee, array('class' => 'form-control', 'placeholder'=>"")) !!}
                        </div>
                        <div class="col-md-4">
                            {!! Form::label('commission_percentage_fee',trans_choice('general.commission_percentage_fee',1),array('class'=>'')) !!}
                            {!! Form::number('commission_percentage_fee',$trade_currency->commission_percentage_fee, array('class' => 'form-control', 'placeholder'=>"")) !!}
                        </div>
                    </div>
                </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-6">
                        {!! Form::label('trade_fixed_fee',trans_choice('general.trade_fixed_fee',1),array('class'=>'')) !!}
                        {!! Form::number('trade_fixed_fee',$trade_currency->trade_fixed_fee, array('class' => 'form-control', 'placeholder'=>"")) !!}
                    </div>
                    <div class="col-md-6">
                        {!! Form::label('trade_percentage_fee',trans_choice('general.trade_percentage_fee',1),array('class'=>'')) !!}
                        {!! Form::number('trade_percentage_fee',$trade_currency->trade_percentage_fee, array('class' => 'form-control', 'placeholder'=>"")) !!}
                    </div>
                </div>
            </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                            {!! Form::label('allow_commission',trans_choice('general.allow_commission',1),array('class'=>'')) !!}
                            {!! Form::select('allow_commission',array('1'=>trans_choice('general.yes',1),'0'=>trans_choice('general.no',1)),$trade_currency->allow_commission, array('class' => 'form-control',)) !!}
                        </div>
                        <div class="col-md-4">
                            {!! Form::label('allow_receiving',trans_choice('general.allow_receiving',1),array('class'=>'')) !!}
                            {!! Form::select('allow_receiving',array('1'=>trans_choice('general.yes',1),'0'=>trans_choice('general.no',1)),$trade_currency->allow_receiving, array('class' => 'form-control',)) !!}
                        </div>
                        <div class="col-md-4">
                            {!! Form::label('allow_sending',trans_choice('general.allow_sending',1),array('class'=>'')) !!}
                            {!! Form::select('allow_sending',array('1'=>trans_choice('general.yes',1),'0'=>trans_choice('general.no',1)),$trade_currency->allow_sending, array('class' => 'form-control',)) !!}
                        </div>

                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            {!! Form::label('allow_withdrawal',trans_choice('general.allow_withdrawal',1),array('class'=>'')) !!}
                            {!! Form::select('allow_withdrawal',array('1'=>trans_choice('general.yes',1),'0'=>trans_choice('general.no',1)),$trade_currency->allow_withdrawal, array('class' => 'form-control',)) !!}
                        </div>
                        <div class="col-md-6">
                            {!! Form::label('active',trans_choice('general.active',1),array('class'=>'')) !!}
                            {!! Form::select('active',array('1'=>trans_choice('general.yes',1),'0'=>trans_choice('general.no',1)),$trade_currency->active, array('class' => 'form-control',)) !!}
                        </div>

                    </div>
                </div>
            @if($trade_currency->cryptocurrency==1)
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            {!! Form::label('api_key',trans_choice('general.api_key',1),array('class'=>'')) !!}
                            {!! Form::text('api_key',$trade_currency->api_key, array('class' => 'form-control','required'=>'')) !!}
                        </div>
                        <div class="col-md-6">
                            {!! Form::label('address',trans_choice('general.address',1),array('class'=>'')) !!}
                            {!! Form::text('address',$trade_currency->address, array('class' => 'form-control','required'=>'')) !!}
                        </div>
                    </div>
                </div>
            @endif

            <div class="form-group">
                {!! Form::label('notes',trans_choice('general.description',1),array('class'=>'')) !!}
                {!! Form::textarea('notes',$trade_currency->notes, array('class' => 'form-control', 'placeholder'=>"",'rows'=>'3')) !!}
            </div>


        </div>
        <!-- /.panel-body -->
        <div class="panel-footer">
            <div class="heading-elements">
                <button type="submit" class="btn btn-primary pull-right">{{trans_choice('general.save',2)}}</button>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
    <!-- /.box -->
@endsection

@section('footer-scripts')
    <script>

    </script>
@endsection