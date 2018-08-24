@extends('layouts.master')
@section('title')
@endsection
@section('content')


    <div class="panel panel-white">
        <div class="panel-heading">
            <h6 class="panel-title">  {{trans_choice('general.placeorder',1)}} </h6>

            <div class="heading-elements">

            </div>
        </div>
        <div class="panel-body ">
            <div class="table-responsive" id="app">
                {{--<h1>@{{ counter }} + @{{ counter1 }}</h1>--}}


                {!! Form::open(array('url' => url('placeorder'), 'method' => 'post', 'name' => 'form',"enctype"=>"multipart/form-data")) !!}
                <div class="panel-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                {!! Form::label('name','USD',array('class'=>'')) !!}
                                <input v-model="counter" readonly required="required" name="USD" type="text"  id="name" class="form-control">
                            </div>
                            <div class="col-md-4">
                                {!! Form::label('name','BTC',array('class'=>'')) !!}
                                <input readonly  v-model="counter1" required="required" name="BTC" type="text"  id="name" class="form-control">

                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.panel-body -->
                <div class="panel-footer">
                    <div class="heading-elements">

                        <button  type="button" :disabled="counter == null"  v-on:click.stop.prevent="placeordersell" class="btn btn-primary pull-right ">{{trans_choice('general.sell',1)}}</button>
                        <button type="button" :disabled="counter == null"  v-on:click.stop.prevent="placeordersbuy" class="btn btn-primary pull-right ">{{trans_choice('general.buy',1)}}</button>


                    </div>
                </div>
                {!! Form::close() !!}

                <div class="panel-heading">
                    <h6 class="panel-title">  {{trans_choice('general.orders',1)}} </h6>

                    <div class="heading-elements">

                    </div>
                </div>


                <table id="data-table" class="table table-striped table-condensed table-hover">
                    <thead>
                    <tr>
                        <th>USD</th>
                        <th>BTC</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(value, key, index) in info.data.slice(0,20)" v-on:click="say(value[0],value[1])">
                    <td>  @{{ value[0]}}</td>
                    <td>  @{{ value[1]}}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>



<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
{{--<script src="/js/app.js"></script>--}}
<script>

    new Vue({
        el: '#app',
        data () {
            return {
                info: null,
                counter: null,
                counter1: null,
            }
        },
        mounted () {
                this.interval = setInterval(function(){
                    axios.get('{{url("callnew")}}').then(response => (this.info = response))
                }.bind(this), 2000);
            },

            methods: {
                say: function (message,message1) {
                    this.counter = message;
                    this.counter1 = message1;
                },
                placeordersbuy() {
                    axios.post('{{url(('placeordersbuy'))}}', {
                        _token: '{{csrf_token()}}',
                        body: JSON.stringify({ USD: this.counter, BTC: this.counter1, }),
                    })
                            .then((response) => {
                    console.log(response);
                        if(response.data == 1){
                        this.counter = '';
                        this.counter1 = '';
                        }
                        if(response.data == 0)
                        {
                            swal(
                                    'alert?',
                                    'insufficient balance',
                                    'question'
                            )
                        }
                })
                .catch((error) => {
                        console.log(error);
                })
                },

                placeorderssell() {
                    axios.post('{{url(('placeorderssell'))}}', {
                        _token: '{{csrf_token()}}',
                        body: JSON.stringify({ USD: this.counter, BTC: this.counter1, }),
                    })
                            .then((response) => {
                        console.log(response);
                    if(response.data == 1){
                        this.counter = '';
                        this.counter1 = '';
                    }
                    if(response.data == 0)
                    {
                        swal(
                                'alert?',
                                'insufficient balance',
                                'question'
                        )
                    }
                })
                .catch((error) => {
                        console.log(error);
                })
                },

            }
    })


</script>


@endsection
