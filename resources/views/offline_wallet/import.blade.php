@extends('layouts.master')
@section('title')
    {{trans_choice('general.import',1)}} {{trans_choice('general.wallet',1)}}
@endsection
@section('content')
<div class="pageContent">
    <div class="container">
    <div class="panel panel-white">
        <div class="panel-heading">
            <h6 class="panel-title">{{trans_choice('general.import',1)}} {{trans_choice('general.wallet',1)}}</h6>
            <div class="heading-elements">
                <a href="{{asset('uploads/sample.xlsx')}}" target="_blank" class="btn btn-info btn-xs"
                   data-toggle="tooltip"
                   title="{{ trans_choice('general.download',1) }} {{trans_choice('general.template',1)}}">
                    <i class="fa fa-download"></i>
                </a>
            </div>
        </div>
        {!! Form::open(array('url' => url('offline_wallet/import/store'), 'method' => 'post', 'name' => 'form',"enctype"=>"multipart/form-data")) !!}
        <div class="panel-body">
            <div class="form-group">
                {!! Form::label('file',trans_choice('general.file',1)." *",array('class'=>'')) !!}
                {!! Form::file('file', array('class' => 'form-control', 'placeholder'=>trans_choice('general.file',1),'required'=>'required')) !!}
            </div>
            <div class="form-group">
                {!! Form::label('trade_currency_id',trans_choice('general.trade',1)." ".trans_choice('general.currency',1),array('class'=>'')) !!}
                {!! Form::select('trade_currency_id',$trade_currencies,null, array('placeholder'=>trans_choice('general.select',1),'class' => 'form-control select2','required'=>'required',)) !!}
            </div>
            <div class="form-group">
                {!! Form::label('active',trans_choice('general.active',1),array('class'=>'')) !!}
                {!! Form::select('active',array('1'=>trans_choice('general.yes',1),'0'=>trans_choice('general.no',1)),1, array('class' => 'form-control',)) !!}
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
</div>
    <!-- /.box -->
@endsection

