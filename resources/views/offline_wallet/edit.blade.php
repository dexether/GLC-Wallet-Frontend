@extends('layouts.master')
@section('title')
    {{trans_choice('general.edit',1)}} {{trans_choice('general.method',1)}}
@endsection
@section('content')
<div class="pageContent">
    <div class="container">
    <div class="panel panel-white">
        <div class="panel-heading">
            <h6 class="panel-title">{{trans_choice('general.edit',1)}} {{trans_choice('general.wallet',1)}}</h6>
            <div class="heading-elements">

            </div>
        </div>
        {!! Form::open(array('url' => url('offline_wallet/'.$offline_wallet->id.'/update'), 'method' => 'post', 'name' => 'form',"enctype"=>"multipart/form-data")) !!}
        <div class="panel-body">
            <div class="form-group">
                {!! Form::label('address',trans_choice('general.address',1)." *",array('class'=>'')) !!}
                {!! Form::text('address',$offline_wallet->address, array('class' => 'form-control', 'placeholder'=>trans_choice('general.address',1),'required'=>'required')) !!}
            </div>
            <div class="form-group">
                {!! Form::label('trade_currency_id',trans_choice('general.trade',1)." ".trans_choice('general.currency',1),array('class'=>'')) !!}
                {!! Form::select('trade_currency_id',$trade_currencies,$offline_wallet->trade_currency_id, array('placeholder'=>trans_choice('general.select',1),'class' => 'form-control select2','required'=>'required',)) !!}
            </div>
            <div class="form-group">
                {!! Form::label('active',trans_choice('general.active',1),array('class'=>'')) !!}
                {!! Form::select('active',array('1'=>trans_choice('general.yes',1),'0'=>trans_choice('general.no',1)),$offline_wallet->active, array('class' => 'form-control',)) !!}
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
</div>
    <!-- /.box -->
@endsection

