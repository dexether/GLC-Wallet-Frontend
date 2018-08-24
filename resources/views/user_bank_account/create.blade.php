@extends('layouts.master')
@section('title')
    {{trans_choice('general.add',1)}} {{trans_choice('general.account',1)}}
@endsection
@section('content')
    <div class="panel panel-white">
        <div class="panel-heading">
            <h6 class="panel-title">{{trans_choice('general.add',1)}} {{trans_choice('general.account',1)}}</h6>
            <div class="heading-elements">

            </div>
        </div>
        {!! Form::open(array('url' => url('user_bank_account/store'), 'method' => 'post', 'name' => 'form')) !!}
        <div class="panel-body">
            <div class="form-group">
                {!! Form::label('withdrawal_method_id',trans_choice('general.bank',1).' '.trans_choice('general.account',1),array('class'=>'')) !!}
                {!! Form::select('withdrawal_method_id',$withdrawal_methods,null, array('class' => 'form-control',null,'required'=>'required','placeholder'=>'')) !!}
            </div>
            <div class="form-group">
                {!! Form::label('account_name',trans_choice('general.account',1)." ".trans_choice('general.name',1),array('class'=>'')) !!}
                {!! Form::text('account_name',null, array('class' => 'form-control', 'placeholder'=>'','required'=>'required')) !!}
            </div>
            <div class="form-group">
                {!! Form::label('account_number',trans_choice('general.account',1)." ".trans_choice('general.number',1),array('class'=>'')) !!}
                {!! Form::text('account_number',null, array('class' => 'form-control', 'placeholder'=>'','required'=>'required')) !!}
            </div>
            <div class="form-group">
                {!! Form::label('agency_number',trans_choice('general.agency_number',1),array('class'=>'')) !!}
                {!! Form::text('agency_number',null, array('class' => 'form-control', 'placeholder'=>'')) !!}
            </div>
            <div class="form-group">
                {!! Form::label('cpf_number',trans_choice('general.cpf_number',1),array('class'=>'')) !!}
                {!! Form::text('cpf_number',null, array('class' => 'form-control', 'placeholder'=>'')) !!}
            </div>
            <div class="form-group">
                {!! Form::label('default_account',trans_choice('general.default',1),array('class'=>'')) !!}
                {!! Form::select('default_account',array('1'=>trans_choice('general.yes',1),'0'=>trans_choice('general.no',1)),1, array('class' => 'form-control',)) !!}
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

