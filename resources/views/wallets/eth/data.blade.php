@extends('layouts.master')
@section('title')
    Ethereum {{trans_choice('general.wallet',1)}}
@endsection
@section('content')

<div class="modal fade text-center" id="myModaleth" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <!--<div class="modal-header border-model">-->
        <!--  <button type="button" class="close" data-dismiss="modal">&times;</button>-->
        <!--  <h4 class="modal-title">Modal Header</h4>-->
        <!--</div>-->
        <div class="modal-body">

            <div class="p-5">
                <div class="qr_data">
                    <div class="row">
                        <div class="col-sm-12">
                            <h2 class="model-title"><b>Use this address to receive eth in your wallet</b></h2>
                        </div>
                        <div class="col-sm-12">
                                    <img
                                    src="data:image/png;base64, {{DNS2D::getBarcodePNG($wallet->address, "QRCODE",5,5)}}"
                                    alt="barcode"/>
                        </div>
                        <div class="col-sm-12">
                            <h4>{{trans_choice('general.my_address',1)}}</h4>
                            <h6><b>{{$wallet->address}}</b></h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  
<section>
      <div class="pageContent wallets">
        <div class="container">
          
    <div class="row">
        <div class="col-md-4">
            <div class="panel panel-white2">
                <div class="panel-body2 ">
                    @include('left_menu.client_balance')
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="btc_wall">
                          <div class="panel panel-white">
                    <div class="panel-heading">
                    <h6 class="panel-title"> Ethereum Wallet<a class="heading-elements-toggle"><i class="icon-more"></i></a></h6>
                </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                         @if(session('error'))<br><div class="alert alert-danger">{{ session('error') }}</div><br>@endif
                        <div class="qr_sec">

                        @if(empty($wallet->address))
                        <div class="alert alert-warning alert-bordered">
                            <button type="button" class="close" data-dismiss="alert"><span>×</span><span
                                        class="sr-only">Close</span></button>
                            {{trans_choice('general.no_address',1)}}
                        </div>
                      
@if(!empty($wallet->wallet_id))

          <form action="{{ url('wallets/show_address') }}" method="post" >
                          {{ csrf_field() }}
                          <input class="form-control cust_fld" id="name" name="coin" value="teth" type="hidden">
                            <div class="act_btns withdrw_btc">        
                                    <button type="submit" class="btn btn-default  btn-xs send_rec">
                                       Show Address
                                   </button>
                             </div>
                        </form>


@else
                       <form action="{{ url('wallets/create_address') }}" method="post" >
                          {{ csrf_field() }}
                        <input class="form-control cust_fld" id="name" name="coin" value="teth" type="hidden">
                            <div class="act_btns withdrw_btc">        
                                    <button type="submit" class="btn btn-default  btn-xs send_rec">
                                       <i class="fa fa-plus"></i> {{trans_choice('general.new',1)}} {{trans_choice('general.address',1)}}
                                   </button>
                             </div>
                        </form>
@endif
          
                    @else
                    <div class="qr_data">
                        <div class="row">
                            <div class="col-sm-3">
                            <img
                                    src="data:image/png;base64, {{DNS2D::getBarcodePNG($wallet->address, "QRCODE",5,5)}}"
                                    alt="barcode"/>
                            </div>
                            <div class="col-sm-9">
                        <h4>{{trans_choice('general.my_address',1)}}</h4>
                        <p><b>{{$wallet->address}}</b>
                            @if(\App\Models\Setting::where('setting_key','wallet_address_limit')->first()->setting_value>\App\Models\WalletAddress::where('user_id',Sentinel::getUser()->id)->where('trade_currency_id',$eth->id)->count())
                                <div class="act_btns withdrw_btc">        
                                    <a href="{{ url('wallet/generate_address?coin=eth') }}"
                                       class="btn btn-default  btn-xs send_rec"><i class="fa fa-plus"></i> {{trans_choice('general.new',1)}} {{trans_choice('general.address',1)}}
                                    </a>
                                 </div>
                            @endif
                        </p>
                    </div>
                        </div>
                    </div>
                    @endif
                    </div>
                    <div class="tabbable">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#deposits" data-toggle="tab"
                                                  class="legitRipple">{{trans_choice('general.deposit',2)}}</a></li>
                            <li class=""><a href="#withdrawals" data-toggle="tab"
                                            class="legitRipple">{{trans_choice('general.withdrawal',2)}}</a></li>
                        </ul>

                        <div class="tab-content wallet_tble">
                             <div class="tab-pane active" id="deposits">
                                <div class="table-responsive">
                                    <table id="deposits1" class="table table-striped table-condensed table-hover">
                                        <thead>
                                        <tr>
                                            <th>{{trans_choice('general.time',1)}}</th>
                                            <th>{{trans_choice('general.trans_id',1)}}</th>
                                            <th>{{trans_choice('general.amount',1)}}</th>
                                            <th>Receiver Address </th>
                                            <th>{{trans_choice('general.status',1)}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($deposits as $key)
                                            <tr>
                                                <td>{{ $key->created_at }}</td>
                                                <td>
                                                    <a href="https://live.blockcypher.com/btc/tx/{{$key->transaction_id}}"
                                                       target="_blank"> {{ substr($key->transaction_id,0,32) }}...</a>
                                                </td>
                                                <td>{{ round($key->amount,$btc->decimals) }}</td>
                                                <td>{{ $key->receiver_address }}</td>
                                                <td>
                                                    @if($key->status=="pending")
                                                        {{trans_choice('general.pending',1)}}
                                                    @endif
                                                    @if($key->status=="processing")
                                                        {{trans_choice('general.processing',1)}}
                                                    @endif
                                                    @if($key->status=="cancelled")
                                                        {{trans_choice('general.cancelled',1)}}
                                                    @endif
                                                    @if($key->status=="done")
                                                        {{trans_choice('general.done',1)}}
                                                    @endif
                                                    @if($key->status=="accepted")
                                                        {{trans_choice('general.accepted',1)}}
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                           <div class="tab-pane" id="withdrawals">
                                <div class="table-responsive">
                                    <table id="withdrawals1" class="table table-striped table-condensed table-hover">
                                        <thead>
                                        <tr>
                                          
                                            <th>{{trans_choice('general.time',1)}}</th>
                                            <th>{{trans_choice('general.amount',1)}}</th>
                                            <th>TXID</th>
                                            <th>SENDER ADDRESS</th>
                                            <th>{{trans_choice('general.status',1)}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($withdrawals as $key)
                                            <tr>
                                               
                                                <td>{{ $key->created_at }}</td>
                                                <td>{{ round($key->amount,$btc->decimals) }}</td>
                                                <td>{{ $key->transaction_id }}</td>
                                                <td>{{ $key->sender_address }}</td>
                                                <td>
                                                    @if($key->status=="pending")
                                                        {{trans_choice('general.pending',1)}}
                                                        <!--<a href="{{url('wallet/withdrawal/'.$key->id.'/cancel')}}"-->
                                                        <!--   class="delete">-->
                                                        <!--    <i data-toggle="tooltip" class="fa fa-times-circle-o fa-2x"-->
                                                        <!--       aria-hidden="true"-->
                                                        <!--       style="color: #797474" title=""-->
                                                        <!--       data-original-title="Cancel"></i>-->
                                                        <!--</a>-->
                                                    @endif
                                                    @if($key->status=="processing")
                                                        {{trans_choice('general.processing',1)}}
                                                    @endif
                                                    @if($key->status=="cancelled")
                                                        {{trans_choice('general.cancelled',1)}}
                                                    @endif
                                                    @if($key->status=="done")
                                                        {{trans_choice('general.done',1)}}
                                                    @endif
                                                    @if($key->status=="accepted")
                                                        {{trans_choice('general.accepted',1)}}
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>
                    </div>
<!--               <div class="col-sm-2">-->
<!--                        <div class="act_btns withdrw_btc">        -->
<!--                        <a href="{{ url('wallets/eth/send') }}"-->
<!--                           class="btn btn-default send_rec">-->
<!--<i class="fa fa-paper-plane" aria-hidden="true"></i> Send-->
<!--                        </a>-->
<!--                         </div>-->
<!--                    </div>-->
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
</div>
</div>
</section>
@endsection
@section('footer-scripts')
    <script>
            $('#deposits1').DataTable();
        $('#withdrawals1').DataTable();
    </script>
@endsection
