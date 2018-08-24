@extends('layouts.master')
@section('title')
    {{$title}}
@endsection
<div class="dark-theme">
@section('content')

    <style>
        .order_book {
            cursor: pointer;
        }
    </style>

    <section>
      <div class="pageContent wallets">
        <div class="container">
          <!--
          <div class="pageTitle"><h1>Trading Exchange - {{$trade_currency->xml_code}}</h1></div>
          -->
          <div class="ordr_book">
              <div class="sec_top_all">
                  <div class="row">
                      
                      <div class="col-lg-6 col-md-6 col-sm-6 padding-0">
                          <div class="customSelect">
                      <ul class="slct_currn">
                        <li class="dropdown @if(Request::is('market/*')) active @endif">
                        <a href="#" class="dropdown-toggle aSelct" data-toggle="dropdown">Select the Cryptocurrency</a>
                        <ul class="dropdown-menu dropdown-menu-right slct_cust_drop">
                            @if($btc->active==1)
                                <li><a href="{{ url('market/data?market=btcusd') }}"><i
                                                class="fa fa-circle-o"></i> BTC
                                    </a></li>
                            @endif
                            @if($ltc->active==1)
                                <li><a href="{{ url('market/data?market=ltcusd') }}"><i
                                                class="fa fa-circle-o"></i> LTC
                                    </a></li>
                            @endif
                            @if($dogecoin->active==1)
                                <li><a href="{{ url('market/data?market=dogecoinusd') }}"><i
                                                class="fa fa-circle-o"></i> Dogecoin
                                    </a></li>
                            @endif
                            @if($xrp->active==1)
                                <li><a href="{{ url('market/data?market=xrpusd') }}"><i
                                                class="fa fa-circle-o"></i> Ripple
                                    </a></li>
                            @endif
                            @if($eth->active==1)
                                <li><a href="{{ url('market/data?market=ethusd') }}"><i
                                                class="fa fa-circle-o"></i> Ethereum
                                    </a></li>
                            @endif
                        </ul>
                    </li>
                    </ul>
                   </div>
                      </div>
                  </div>
              </div>
              <div class="row">
                  <div class="col-lg-4 col-md-4 col-sm-4 ordr_data padding-0">
                    <div class="buy_sell_sec">
                    <h2>BUY ORDERS</h2>
                      
                      <div class="table-responsive">
                      <table class="table table-hover">
                        <thead>
                          <tr>
                            <th>{{trans_choice('general.amount',1)}}</th>
                            <th>{{trans_choice('general.volume',1)}}</th>
                            <th>{{trans_choice('general.bid',1)}}</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($buy_orders as $key)
                                    <tr data-id="{{$key->id}}"
                                        data-volume="{{round($key->volume,$trade_currency->decimals)}}"
                                        data-amount="{{round($key->price,$usd->decimals)}}" onclick="quick_buy(this)">
                                        <td>{{number_format($key->amount,$usd->decimals)}}</td>
                                        <td>{{round($key->volume,$trade_currency->decimals)}}</td>
                                        <td>{{number_format($key->price,$usd->decimals)}}</td>
                                    </tr>
                                @endforeach
                        </tbody>
                      </table>
                  </div>

                   </div>





                  </div>
                  <div class="col-lg-4 col-md-4 col-sm-4 ordr_data padding-0">
                  <div class="buy_sell_sec" style="margin-left: 0%;">
                      <h2 style="text-align: right;">SELL ORDERS</h2>
                      <div class="table-responsive">
                      <table class="table table-hover">
                        <thead>
                          <tr>
                            <th>{{trans_choice('general.ask',1)}}</th>
                            <th>{{trans_choice('general.volume',1)}}</th>
                            <th>{{trans_choice('general.amount',1)}}</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($sell_orders as $key)
                                    <tr data-id="{{$key->id}}"
                                        data-volume="{{round($key->volume,$trade_currency->decimals)}}"
                                        data-amount="{{round($key->price,$usd->decimals)}}" onclick="quick_sell(this)">
                                        <td>{{number_format($key->price,$usd->decimals)}}</td>
                                        <td>{{round($key->volume,$trade_currency->decimals)}}</td>
                                        <td>{{number_format($key->amount,$usd->decimals)}}</td>
                                    </tr>
                          @endforeach
                        </tbody>
                      </table>
                  </div>
                    </div>
                  </div>

              </div>                
          </div>





          <div class="row">
         <div class="trde padding-0">
              
                  <div class="col-sm-6 padding-0">
                    
                    <div class="trde_buy">
                        <h6>{{trans_choice('general.trade',1)}}</h6>
                        <input type="hidden" id="btc_max" value="{{$trade_currency->maximum_amount}}">
                        <input type="hidden" id="btc_min" value="{{$trade_currency->minimum_amount}}">
                        <input type="hidden" id="balance">
                        {!! Form::open(array('url' => url('market/buy'), 'method' => 'post', 'id' => 'buy-form')) !!}
                        <input type="hidden" name="trade_currency_id" value="{{$trade_currency->id}}"/>
                                <div class="form-group">
                                    <label>{{$usd->xml_code}} {{trans_choice('general.balance',1)}}: {{number_format(\App\Helpers\GeneralHelper::user_currency_balance(Sentinel::getUser()->id,$usd->id),2)}}
                                    </label>
                                    <input type="number" style="color: white;" placeholder="{{trans_choice('general.volume',1)}}"
                                           class="form-control cust_fld" name="buy_volume" id="buy_volume" required>
                                </div>
                                <div class="form-group">
                                    <label>{{trans_choice('general.lowest_ask',1)}}: {{number_format($minimum_trade,2)}}</label>
                                    <input type="number" style="color: white;" placeholder="{{trans_choice('general.price',1)}}"
                                           class="form-control cust_fld" name="buy_price" id="buy_price"
                                           required>
                                </div>
                                <label style="margin-bottom: 9px"></label>
                                <button type="submit"
                                        class="btn btn-green btn-block"
                                        id="buy_submit">{{trans_choice('general.buy',1)}}</button>
                        {!! Form::close() !!}
                    </div>
                  </div>
                  <div class="col-sm-6 padding-0">
                    <h6></h6>
                    <div class="trde_sell">
                      {!! Form::open(array('url' => url('market/sell'), 'method' => 'post', 'id' => 'sell-form')) !!}
                    <input type="hidden" name="trade_currency_id" value="{{$trade_currency->id}}"/>
                            <div class="form-group">
                                <label>{{$trade_currency->xml_code}} {{trans_choice('general.balance',1)}}: {{round(\App\Helpers\GeneralHelper::user_currency_balance(Sentinel::getUser()->id,$trade_currency->id),$trade_currency->decimals)}}
                                </label>
                                <input type="number" style="color: white;" placeholder="{{trans_choice('general.volume',1)}}"
                                       class="form-control cust_fld" name="sell_volume" id="sell_volume" required>
                            </div>
                            <div class="form-group">
                                <label>{{trans_choice('general.highest_bid',1)}}: {{number_format($maximum_trade,2)}}</label>
                                <input type="number" style="color: white;" placeholder="{{trans_choice('general.price',1)}}"
                                       class="form-control cust_fld" name="sell_price" id="sell_price"
                                       required>
                            </div>

                            <label style="margin-bottom: 9px"></label>
                            <button type="submit"
                                    class="btn btn-red btn-block"
                                    id="sell_submit">{{trans_choice('general.sell',1)}}</button>
                    {!! Form::close() !!}
                  </div>
                  </div>
              </div>
          </div>


          <div class="row">
          <div class="pend_ordr padding-0">
              
                  <div class="col-lg-12 padding-0">
                    <div class="buy_sell_sec trde_pend_ordr">
                    <h6>{{trans_choice('general.my',1)}} {{trans_choice('general.pending',1)}} {{trans_choice('general.order',2)}}</h6>
                    @if(count($pending_orders)==0)
                                    <p class="text-center"> {{trans_choice('general.no',1)}} {{trans_choice('general.order',2)}}</p>
                                @else
                                <div class="table-responsive">
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
                                                        <i data-toggle="tooltip" class="fa fa-times"
                                                           aria-hidden="true"
                                                           style="color: #797474" title=""
                                                           data-original-title="Cancel"></i>
                                                    </a></td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                @endif
                    </div>
                  </div>
              </div>
          </div>




          
          
          <div class="trde_chart">
            <div class="row">
                <div class="col-md-12">
                    <div class="chart trde_pend_ordr">
                        <h6>{{trans_choice('general.price',1)}} {{trans_choice('general.chart',1)}}</h6>
                    </div>
                    <div id="monthly_chart" class="monthly_chrt"></div>
                </div>
            </div>
          </div>

          
      </div>
    </div>
</section>
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
                $("#order_book").load('{{url('market/refresh?trade_currency_id='.$trade_currency->id)}}');
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
                    "url": "{{url('market/graph?trade_currency_id='.$trade_currency->id)}}",
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
                    "url": "{{url('market/graph?trade_currency_id='.$trade_currency->id)}}",
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
            var refreshGraph = setInterval(function () {
             $.ajax({
             url: "{{url('market/graph?trade_currency_id='.$trade_currency->id)}}", dataType: "json", success: function (result) {
             chart.dataProvider = result;
             chart.validateData();
             }, error: function () {

             }
             });

             }, 30000);
        })
    </script>
@endsection
