@extends('layouts.master')
@section('title')
    {{trans_choice('general.announcement',1)}}
@endsection
@section('content')
<div class="pageContent">
    <div class="container">
    <div class="panel panel-white">
        <div class="panel-heading">
            <h6 class="panel-title">{{trans_choice('general.announcement',1)}}</h6>
            <div class="heading-elements">

            </div>
        </div>
        {!! Form::open(array('url' => url('announcement'), 'method' => 'post', 'name' => 'form')) !!}
        <div class="panel-body">
            <div class="form-group">
                {!! Form::label('announcement',trans_choice('general.announcement',1),array('class'=>'')) !!}
                {!! Form::textarea('announcement',\App\Models\Setting::where('setting_key','announcement')->first()->setting_value, array('class' => 'form-control','rows'=>'3')) !!}
            </div>
            <div class="form-group">
                {!! Form::label('announcement_type',trans_choice('general.type',1),array('class'=>'')) !!}
                {!! Form::select('announcement_type',array('info'=>"info",'warning'=>"warning",'danger'=>"danger",'success'=>"success"),\App\Models\Setting::where('setting_key','announcement_type')->first()->setting_value, array('class' => 'form-control',)) !!}
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

