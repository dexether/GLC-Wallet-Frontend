@extends('layouts.master')
@section('title')
    {{trans_choice('general.add',1)}} {{trans_choice('general.method',1)}}
@endsection
@section('content')
    <div class="panel panel-white">
        <div class="panel-heading">
            <h6 class="panel-title">{{trans_choice('general.add',1)}} {{trans_choice('general.method',1)}}</h6>
            <div class="heading-elements">

            </div>
        </div>
        {!! Form::open(array('url' => url('payment_gateway/store'), 'method' => 'post', 'name' => 'form',"enctype"=>"multipart/form-data")) !!}
        <div class="panel-body">
            <div class="form-group">
                <div class="row">
                    <div class="col-md-6">
                        {!! Form::label('name',trans_choice('general.name',1)." *",array('class'=>'')) !!}
                        {!! Form::text('name',null, array('class' => 'form-control', 'placeholder'=>trans_choice('general.name',1),'required'=>'required')) !!}

                    </div>
                    <div class="col-md-6">
                        {!! Form::label('logo',trans_choice('general.logo',1),array('class'=>'')) !!}
                        {!! Form::file('logo',array('class'=>'form-control','id'=>'logo')) !!}
                    </div>
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('active',trans_choice('general.active',1),array('class'=>'')) !!}
                {!! Form::select('active',array('1'=>trans_choice('general.yes',1),'0'=>trans_choice('general.no',1)),1, array('class' => 'form-control',)) !!}
            </div>
            <div class="form-group">
                {!! Form::label('notes',trans_choice('general.description',1)." *",array('class'=>'')) !!}
                {!! Form::textarea('notes',null, array('class' => 'form-control', 'required'=>"required",'rows'=>'3')) !!}
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

