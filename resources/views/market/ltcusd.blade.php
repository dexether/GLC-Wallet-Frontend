@extends('layouts.master')
@section('title')
    {{$ltc->xml_code}}/{{$usd->xml_code}}
@endsection
@section('content')
    <style>
        .order_book {
            cursor: pointer;
        }
    </style>
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-white">
                <div class="panel-heading">
                    <h6 class="panel-title"> {{trans_choice('general.order_book',1)}}</h6>

                    <div class="heading-elements">

                    </div>
                </div>
                <div class="panel-body " id="order_book">
                    <div style="height: 400px; overflow: scroll">
                        <div class="col-md-6">
                            <h3><b>{{trans_choice('general.buy',1)}} {{trans_choice('general.order',2)}}</b></h3>
                            <table class="table table-striped table-bordered table-condensed table-hover ">
                                <thead>
                                <tr>
                                    <th><b>{{trans_choice('general.amount',1)}}</b></th>
                                    <th><b>{{trans_choice('general.volume',1)}}</b></th>
                                    <th><b>{{trans_choice('general.bid',1)}}</b></th>
                                </tr>
                                </thead>
                                <tbody class="order_book">
                                @foreach($buy_orders as $key)
                                    <tr data-id="{{$key->id}}" data-volume="{{round($key->volume,$btc->decimals)}}"
                                        data-amount="{{round($key->amount,2)}}" onclick="quick_buy(this)">
                                        <td>{{number_format($key->volume*$key->amount,2)}}</td>
                                        <td>{{round($key->volume,$btc->decimals)}}</td>
                                        <td>{{number_format($key->amount,2)}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <h3><b>{{trans_choice('general.sell',1)}} {{trans_choice('general.order',2)}}</b></h3>
                            <table class="table table-striped table-bordered table-condensed table-hover">
                                <thead>
                                <tr>
                                    <th><b>{{trans_choice('general.ask',1)}}</b></th>
                                    <th><b>{{trans_choice('general.volume',1)}}</b></th>
                                    <th><b>{{trans_choice('general.amount',1)}}</b></th>
                                </tr>
                                </thead>
                                <tbody class="order_book">
                                @foreach($sell_orders as $key)
                                    <tr data-id="{{$key->id}}" data-volume="{{round($key->volume,$btc->decimals)}}"
                                        data-amount="{{round($key->amount,2)}}" onclick="quick_sell(this)">
                                        <td>{{number_format($key->amount,2)}}</td>
                                        <td>{{round($key->volume,$btc->decimals)}}</td>
                                        <td>{{number_format($key->volume*$key->amount,2)}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-white">
                <div class="panel-heading">
                    <h6 class="panel-title"> {{trans_choice('general.trade',1)}}</h6>

                    <div class="heading-elements">
                        <span class="heading-text">{{trans_choice('general.last',1)}} {{trans_choice('general.traded',1)}} {{trans_choice('general.price',1)}}
                            : <span class="text-bold text-danger-600 position-right">  {{number_format($current_ltc,2)}}</span></span>
                    </div>
                </div>
                <div class="panel-body ">
                    <input type="hidden" id="btc_max" value="{{$ltc->maximum_amount}}">
                    <input type="hidden" id="btc_min" value="{{$ltc->minimum_amount}}">
                    <input type="hidden" id="baalance">
                    {!! Form::open(array('url' => url('market/ltcusd/buy'), 'method' => 'post', 'id' => 'buy-form')) !!}
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>{{$usd->xml_code}} {{trans_choice('general.balance',1)}}
                                    :{{number_format(\App\Helpers\GeneralHelper::user_usd_balance(Sentinel::getUser()->id)-\App\Helpers\GeneralHelper::user_usd_locked_balance(Sentinel::getUser()->id),2)}}
                                </label>
                                <input type="number" placeholder="{{trans_choice('general.volume',1)}}"
                                       class="form-control" name="buy_volume" id="buy_volume" required>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>{{trans_choice('general.lowest_ask',1)}}
                                    :{{number_format($minimum_ltc,2)}}</label>
                                <input type="number" placeholder="{{trans_choice('general.price',1)}}"
                                       class="form-control" name="buy_price" id="buy_price"
                                       required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label style="margin-bottom: 9px"></label>
                            <button type="submit"
                                    class="btn btn-primary btn-block"
                                    id="buy_submit">{{trans_choice('general.buy',1)}}</button>

                        </div>
                    </div>
                    {!! Form::close() !!}
                    {!! Form::open(array('url' => url('market/ltcusd/sell'), 'method' => 'post', 'id' => 'sell-form')) !!}
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>{{$ltc->xml_code}} {{trans_choice('general.balance',1)}}
                                    :
                                    {{round(\App\Helpers\GeneralHelper::user_ltc_balance(Sentinel::getUser()->id)-\App\Helpers\GeneralHelper::user_ltc_locked_balance(Sentinel::getUser()->id),$ltc->decimals)}}
                                </label>
                                <input type="number" placeholder="{{trans_choice('general.volume',1)}}"
                                       class="form-control" name="sell_volume" id="sell_volume" required>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>{{trans_choice('general.highest_bid',1)}}
                                    :{{number_format($maximum_ltc,2)}}</label>
                                <input type="number" placeholder="{{trans_choice('general.price',1)}}"
                                       class="form-control" name="sell_price" id="sell_price"
                                       required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label style="margin-bottom: 9px"></label>
                            <button type="submit"
                                    class="btn btn-primary btn-block"
                                    id="sell_submit">{{trans_choice('general.sell',1)}}</button>

                        </div>
                    </div>
                    {!! Form::close() !!}
                    <div class="row">
                        <div class="col-md-12">
                            <hr>
                        </div>
                    </div>
                    <h4>{{trans_choice('general.my',1)}} {{trans_choice('general.pending',1)}} {{trans_choice('general.order',2)}}</h4>
                    <div class="row">
                        <div class="col-md-12">
                            <div style="height: 300px; overflow: scroll">
                                @if(count($pending_orders)==0)
                                    <p class="text-center"> {{trans_choice('general.no',1)}} {{trans_choice('general.order',2)}}</p>
                                @else
                                    <table id="" class="table table-striped table-condensed table-hover">
                                        <thead>
                                        <tr>
                                            <th>{{trans_choice('general.id',1)}}</th>
                                            <th>{{trans_choice('general.type',1)}}</th>
                                            <th>{{trans_choice('general.price',1)}}</th>
                                            <th>{{trans_choice('general.volume',1)}}</th>
                                            <th>{{trans_choice('general.time',1)}}</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($pending_orders as $key)
                                            <?php
                                            $trade_currency = \App\Models\TradeCurrency::find($key->trade_currency_id);
                                            $default = \App\Models\TradeCurrency::where('default_currency', 1)->first();
                                            ?>
                                            <tr>
                                                <td>{{ $key->id }}</td>
                                                <td>
                                                    @if($key->order_type=="ask")
                                                        {{trans_choice('general.ask',1)}}
                                                    @endif
                                                    @if($key->order_type=="bid")
                                                        {{trans_choice('general.bid',1)}}
                                                    @endif
                                                </td>
                                                <td>{{ round($key->amount,6) }}</td>
                                                <td>{{round( $key->volume,6) }}</td>
                                                <td>{{ $key->created_at }}</td>
                                                <td><a href="{{url('market/'.$key->id.'/cancel')}}"
                                                       class="delete">
                                                        <i data-toggle="tooltip" class="fa fa-times-circle-o fa-2x"
                                                           aria-hidden="true"
                                                           style="color: #797474" title=""
                                                           data-original-title="Cancel"></i>
                                                    </a></td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-white">
                <div class="panel-heading">
                    {{trans_choice('general.price',1)}} {{trans_choice('general.chart',1)}}
                </div>
                <div class="panel-body ">
                    <div id="monthly_chart" style="height: 400px;"></div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer-scripts')
    <script>

        $("#buy-form").validate({
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
            }, submitHandler: function (form) {
                // do other things for a valid form
                form.submit();
            }
        });
        $("#sell-form").validate({
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
            }, submitHandler: function (form) {
                // do other things for a valid form
                form.submit();
            }
        });
        function quick_buy(e) {
            $("#sell_price").val($(e).attr("data-amount"));
            $("#sell_volume").val($(e).attr("data-volume"))
        }
        function quick_sell(e) {
            $("#buy_price").val($(e).attr("data-amount"));
            $("#buy_volume").val($(e).attr("data-volume"))
        }
        //refresh market
        $(document).ready(function (e) {
            var refreshId = setInterval(function () {
                $("#order_book").load('{{url('market/refresh?market=ltcusd')}}');
                //$("title").html("yes");
            }, 9000);
        })
    </script>
    <script src="{{ asset('assets/plugins/amcharts/amcharts.js') }}"
            type="text/javascript"></script>
    <script src="{{ asset('assets/plugins/amcharts/serial.js') }}"
            type="text/javascript"></script>
    <script src="{{ asset('assets/plugins/amcharts/amstock.js') }}"
            type="text/javascript"></script>
    <script src="{{ asset('assets/plugins/amcharts/plugins/dataloader/dataloader.js') }}"
            type="text/javascript"></script>
    <script src="{{ asset('assets/plugins/amcharts/themes/light.js') }}"
            type="text/javascript"></script>
    <script>
        var chartData = [];
        var chart = AmCharts.makeChart("monthly_chart", {
            "type": "stock",
            "theme": "light",
            "dataSets": [{
                "fieldMappings": [{
                    "fromField": "open",
                    "toField": "open"
                }, {
                    "fromField": "close",
                    "toField": "close"
                }, {
                    "fromField": "high",
                    "toField": "high"
                }, {
                    "fromField": "low",
                    "toField": "low"
                }, {
                    "fromField": "volume",
                    "toField": "volume"
                }, {
                    "fromField": "value",
                    "toField": "value"
                }],
                "color": "#7f8da9",
                "dataLoader": {
                    "url": "{{url('market/graph?market=ltcusd')}}",
                    "format": "json"
                },
                "title": "OHLC",
                "categoryField": "date"
            }, {
                "fieldMappings": [{
                    "fromField": "value",
                    "toField": "value"
                }],
                "color": "#fac314",
                "dataLoader": {
                    "url": "{{url('market/graph?market=ltcusd')}}",
                    "format": "json"
                },
                "compared": true,
                "title": "OHLC",
                "categoryField": "date"
            }],


            "panels": [{
                "title": "Value",
                "showCategoryAxis": false,
                "percentHeight": 70,
                "valueAxes": [{
                    "id": "v1",
                    "dashLength": 5
                }],

                "categoryAxis": {
                    "dashLength": 5
                },

                "stockGraphs": [{
                    "type": "candlestick",
                    "id": "g1",
                    "openField": "open",
                    "closeField": "close",
                    "highField": "high",
                    "lowField": "low",
                    "valueField": "close",
                    "lineColor": "#7f8da9",
                    "fillColors": "#7f8da9",
                    "negativeLineColor": "#db4c3c",
                    "negativeFillColors": "#db4c3c",
                    "fillAlphas": 1,
                    "useDataSetColors": false,
                    "comparable": false,
                    "compareField": "value",
                    "showBalloon": true,
                    "proCandlesticks": false,
                    "balloonText": "open:<b>[[open]]</b><br>close:<b>[[close]]</b><br>low:<b>[[low]]</b><br>high:<b>[[high]]</b>",
                }]
            },

                {
                    "title": "Volume",
                    "percentHeight": 30,
                    "marginTop": 1,
                    "showCategoryAxis": true,
                    "valueAxes": [{
                        "dashLength": 5
                    }],

                    "categoryAxis": {
                        "dashLength": 5
                    },

                    "stockGraphs": [{
                        "valueField": "volume",
                        "type": "column",
                        "showBalloon": true,
                        "fillAlphas": 1,
                        "balloonText": "volume:<b>[[volume]]</b>",
                    }]
                }
            ],

            "chartScrollbarSettings": {
                "graph": "g1",
                "graphType": "line",
                "usePeriod": "WW"
            },

            "chartCursorSettings": {
                "valueLineBalloonEnabled": true,
                "valueLineEnabled": true
            },

            "periodSelector": {
                "position": "bottom",
                "periods": [{
                    "period": "DD",
                    "count": 10,
                    "label": "10 days"
                }, {
                    "period": "MM",
                    "selected": true,
                    "count": 1,
                    "label": "1 month"
                }, {
                    "period": "YYYY",
                    "count": 1,
                    "label": "1 year"
                }, {
                    "period": "YTD",
                    "label": "YTD"
                }, {
                    "period": "MAX",
                    "label": "MAX"
                }]
            },
            "export": {
                "enabled": true
            }
        });


        $(document).ready(function (e) {
            /*var refreshGraph = setInterval(function () {
             $.ajax({
             url: "{{url('market/graph?market=ltcusd')}}", dataType: "json", success: function (result) {
             chart.dataProvider = result;
             chart.validateData();
             }, error: function () {

             }
             });

             }, 1000);*/
        })
    </script>
@endsection
