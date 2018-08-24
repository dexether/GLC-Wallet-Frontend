@extends('layouts.master')
@section('title')
    {{ $user->first_name }} {{ $user->last_name }}
@endsection
@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="panel panel-white">
                <div class="panel-heading">
                    <h6 class="panel-title">{{ $user->first_name }} {{ $user->last_name }}</h6>
                    <div class="heading-elements">

                    </div>
                </div>

                    @php


                         $address = explode("|", $user->address);

                        $street = $address[0];
                        $street_2 = $address[1];
                        $city = $address[2];
                        $state = $address[3];
                        $postcode = $address[4];

                    @endphp

                <div class="panel-body">
                    <table class="table table-responsive table-hover">
                        <tr>
                            <td>{{ trans('general.gender') }}</td>
                            <td>{{ $user->gender }}</td>
                        </tr>
                        <tr>
                            <td>{{ trans_choice('general.email',1) }}</td>
                            <td>{{ $user->email }}</td>
                        </tr>
                        <tr>
                            <td>{{ trans('general.email_verified') }}</td>
                            <td>
                                @if($user->email_verified==1)
                                    {{ trans('general.yes') }}
                                @else
                                    {{ trans('general.no') }}
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>{{ trans('general.phone') }}</td>
                            <td>{{ $user->phone }}</td>
                        </tr>
                        <tr>
                            <td>{{ trans('general.phone_verified') }}</td>
                            <td>
                                @if($user->phone_verified==1)
                                    {{ trans('general.yes') }}
                                @else
                                    {{ trans('general.no') }}
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>{{ trans('general.dob') }}</td>
                            <td>{{ $user->dob }}</td>
                        </tr>
                        <tr>
                            <td>{{ trans('general.country') }}</td>
                            <td>
                                @if(!empty($user->country))
                                    {{$user->country->name}}
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>{{ trans('general.city') }}</td>
                            <td>{{ $user->city }}</td>
                        </tr>
                        <tr>
                            <td>{{ trans('general.address') }}</td>
                            <td>{!!   $street.'|'.$street_2 !!}</td>
                        </tr>
                        <tr>
                            <td>{{ trans('general.zip') }}</td>
                            <td>{{ $postcode }}</td>
                        </tr>
                        <tr>
                            <td>{{ trans('general.documents_verified') }}</td>
                            <td>
                                @if($user->documents_verified==1)
                                    {{ trans('general.yes') }}
                                @else
                                    {{ trans('general.no') }}
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>{{ trans_choice('general.id',1)." ".trans_choice('general.type',1) }}</td>
                            <td>
                                @if($user->id_type=="id_card")
                                    {{ trans('general.id_card') }}
                                @endif
                                @if($user->id_type=="passport")
                                    {{ trans('general.passport') }}
                                @endif
                                @if($user->id_type=="driver_license")
                                    {{ trans('general.driver_license') }}
                                @endif
                                @if(!empty($user->id_picture))
                                    <br>
                                    <a href="{{asset('uploads/'.$user->id_picture)}}"
                                       target="_blank">{{$user->id_picture}}</a>
                                @endif
                                 <span >@if($user->id_picture!='' && $user->proof_of_residence_picture!='') No documents uploaded by user @endif</span>
                            </td>
                        </tr>
                        <tr>
                            <td>{{ trans_choice('general.proof_of_residence_type',1) }}</td>
                            <td>
                                @if($user->proof_of_residence_type=="bank_statement")
                                    {{ trans('general.bank_statement') }}
                                @endif
                                @if($user->proof_of_residence_type=="utility_bill")
                                    {{ trans('general.utility_bill') }}
                                @endif

                                @if(!empty($user->proof_of_residence_picture))
                                    <br>
                                    <a href="{{asset('uploads/'.$user->proof_of_residence_picture)}}"
                                       target="_blank">{{$user->proof_of_residence_picture}}</a>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>{{ trans('general.created_at') }}</td>
                            <td>{{ $user->created_at }}</td>
                        </tr>
                        <tr>
                            <td>{{ trans('general.updated_at') }}</td>
                            <td>{{ $user->updated_at }}</td>
                        </tr>
                        <tr>
                            <td>{{ trans('general.last_login') }}</td>
                            <td>{{ $user->last_login }}</td>
                        </tr>
                            {{--<tr>
                                <td>{{ trans('general.documents_verified') }}</td>
                                <td>
                                    @if($user->documents_verified == 0)
                                    <a href="{{url('user/'.$user->id.'/verified',1)}}" type="submit"  class="btn btn-info  btn-xs send_rec pull-left legitRipple">{{trans('general.documents_verified')}}</a>
                                    @else
                                    <a type="submit" class="btn btn-info   send_rec pull-left legitRipple">{{trans('general.documents_verified_done')}}</a>
                                    @endif
                                </td>

                            </tr>--}}
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <?php
            $usd = \App\Models\TradeCurrency::where('default_currency', 1)->first();
            $btc = \App\Models\TradeCurrency::where('network', "bitcoin")->first();
            $dogecoin = \App\Models\TradeCurrency::where('network', "dogecoin")->first();
            $ltc = \App\Models\TradeCurrency::where('network', "litecoin")->first();
            ?>
            <div class="row">

                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="panel panel-body bg-green has-bg-image">
                        <div class="media no-margin">
                            <div class="media-body">
                                <h3 class="no-margin">{{number_format(\App\Helpers\GeneralHelper::user_usd_balance($user->id)-\App\Helpers\GeneralHelper::user_usd_locked_balance($user->id),2)}}</h3>
                                <span class="text-uppercase text-size-mini">{{ $usd->xml_code }} {{ trans_choice('general.balance',1) }}</span>
                            </div>

                            <div class="media-right media-middle">
                                <i class="icon-wallet icon-3x opacity-75"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="panel panel-body bg-blue-400 has-bg-image">
                        <div class="media no-margin">
                            <div class="media-body">
                                <h3 class="no-margin">{{round(\App\Helpers\GeneralHelper::user_btc_balance($user->id)-\App\Helpers\GeneralHelper::user_btc_locked_balance($user->id),$btc->decimals)}}</h3>
                                <span class="text-uppercase text-size-mini">{{ $btc->xml_code }} {{ trans_choice('general.balance',1) }}</span>
                            </div>

                            <div class="media-right media-middle">
                                <i class="icon-wallet icon-3x opacity-75"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="panel panel-body bg-orange-400 has-bg-image">
                        <div class="media no-margin">
                            <div class="media-body">
                                <h3 class="no-margin">{{round(\App\Helpers\GeneralHelper::user_dogecoin_balance($user->id)-\App\Helpers\GeneralHelper::user_dogecoin_locked_balance($user->id),$dogecoin->decimals)}}</h3>
                                <span class="text-uppercase text-size-mini">{{ $dogecoin->xml_code }} {{ trans_choice('general.balance',1) }}</span>
                            </div>

                            <div class="media-right media-middle">
                                <i class="icon-wallet icon-3x opacity-75"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="panel panel-body bg-blue-400 has-bg-image">
                        <div class="media no-margin">
                            <div class="media-body">
                                <h3 class="no-margin"> {{round(\App\Helpers\GeneralHelper::user_ltc_balance($user->id)-\App\Helpers\GeneralHelper::user_ltc_locked_balance($user->id),$ltc->decimals)}}</h3>
                                <span class="text-uppercase text-size-mini">{{ $ltc->xml_code }} {{ trans_choice('general.balance',1) }}</span>
                            </div>
                            <div class="media-right media-middle">
                                <i class="icon-wallet icon-3x opacity-75"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel panel-white">
                <div class="panel-heading">
                    <h3 class="panel-title">{{ trans_choice('general.activity',2) }}</h3>
                    <div class="heading-elements">

                    </div>
                </div>
                <div class="panel-body">
                    <div class="tabbable">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#deposits" data-toggle="tab"
                                                  class="legitRipple">{{trans_choice('general.deposit',2)}}</a></li>
                            <li class=""><a href="#withdrawals" data-toggle="tab"
                                            class="legitRipple">{{trans_choice('general.withdrawal',2)}}</a></li>
                            <li class=""><a href="#orders" data-toggle="tab"
                                            class="legitRipple">{{trans_choice('general.order',2)}}</a></li>
                            <li class=""><a href="#bank_accounts" data-toggle="tab"
                                            class="legitRipple">{{trans_choice('general.bank',1)}} {{trans_choice('general.account',2)}}</a>
                            </li>
                        </ul>

                        <div class="tab-content">
                            <div class="tab-pane active" id="deposits">
                                <div class="table-responsive">
                                    <table id="" class="table table-striped table-condensed table-hover data-table">
                                        <thead>
                                        <tr>
                                            <th>{{trans_choice('general.id',1)}}</th>
                                            <th>{{trans_choice('general.currency',1)}}</th>
                                            <th>{{trans_choice('general.amount',1)}}</th>
                                            <th>{{trans_choice('general.account',1)}}</th>
                                            <th>{{trans_choice('general.status',1)}}</th>
                                            <th>{{trans_choice('general.time',1)}}</th>
                                            <th>{{ trans_choice('general.action',1) }}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach( \App\Models\Deposit::where('user_id',$user->id)->get() as $key)
                                            <?php
                                            $trade_currency = \App\Models\TradeCurrency::find($key->trade_currency_id);
                                            ?>
                                            <tr>
                                                <td>{{ $key->id }}</td>

                                                <?php   $street=''; $street_2 = ''; $city=''; $state=''; $postcode = ''; $country=''; ?>

                                                <td>
                                                    @if(!empty($trade_currency))
                                                        {{$trade_currency->xml_code}}
                                                    @endif
                                                </td>
                                                <td>{{ number_format($key->amount,2) }}</td>
                                                <td>
                                                    @if($key->network!="usd")
                                                        {{$key->receiver_address}}
                                                    @else
                                                        {{trans_choice('general.method',1)}}:
                                                        @if(!empty($key->deposit_method))
                                                            {{$key->deposit_method->name}}
                                                        @endif
                                                        <br>
                                                        {{trans_choice('general.name',1)}}:{{ $key->account_name }}<br>
                                                        {{trans_choice('general.number',1)}}:{{ $key->account_number }}
                                                        <br>
                                                        {{trans_choice('general.address',1)}}:{{ $key->address }}<br>
                                                    @endif
                                                </td>
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
                                                <td>{{ $key->created_at }}</td>
                                                <td class="text-center">
                                                    <ul class="icons-list">
                                                        <li class="dropdown">
                                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                                <i class="icon-menu9"></i>
                                                            </a>
                                                            <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                                                @if(Sentinel::hasAccess('borrowers.update'))
                                                                    <li>
                                                                        <a href="{{ url('deposit/'.$key->id.'/cancel') }}"
                                                                           class="delete">
                                                                            {{ trans('general.cancel') }} </a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="{{ url('deposit/'.$key->id.'/pending') }}"
                                                                           class="delete">
                                                                            {{ trans('general.pending') }} </a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="{{ url('deposit/'.$key->id.'/processing') }}"
                                                                           class="delete">
                                                                            {{ trans('general.processing') }} </a>
                                                                    </li>
                                                                    <li><a href="{{ url('deposit/'.$key->id.'/done') }}"
                                                                           class="delete">
                                                                            {{ trans('general.done') }} </a>
                                                                    </li>
                                                                @endif
                                                                @if(Sentinel::hasAccess('borrowers.delete'))
                                                                    <li>
                                                                        <a href="{{ url('deposit/'.$key->id.'/delete') }}"
                                                                           class="delete"> {{ trans('general.delete') }}
                                                                        </a>
                                                                    </li>
                                                                @endif
                                                            </ul>
                                                        </li>
                                                    </ul>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane " id="withdrawals">
                                <div class="table-responsive">
                                    <table id="" class="table table-striped table-condensed table-hover data-table">
                                        <thead>
                                        <tr>
                                            <th>{{trans_choice('general.id',1)}}</th>
                                            <th>{{trans_choice('general.currency',1)}}</th>
                                            <th>{{trans_choice('general.amount',1)}}</th>
                                            <th>{{trans_choice('general.account',1)}}</th>
                                            <th>{{trans_choice('general.status',1)}}</th>
                                            <th>{{trans_choice('general.time',1)}}</th>
                                            <th>{{ trans_choice('general.action',1) }}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach(\App\Models\Withdrawal::where('user_id',$user->id)->get() as $key)
                                            <?php
                                            $trade_currency = \App\Models\TradeCurrency::find($key->trade_currency_id);
                                            ?>
                                            <tr>
                                                <td>{{ $key->id }}</td>


                                                <td>
                                                    @if(!empty($trade_currency))
                                                        {{$trade_currency->xml_code}}
                                                    @endif
                                                </td>
                                                <td>{{ number_format($key->amount,2) }}</td>
                                                <td>
                                                    @if($key->network!="usd")
                                                        {{$key->receiver_address}}
                                                    @else
                                                        {{trans_choice('general.method',1)}}:
                                                        @if(!empty($key->withdrawal_method))
                                                            {{$key->withdrawal_method->name}}
                                                        @endif
                                                        <br>
                                                        {{trans_choice('general.name',1)}}:{{ $key->account_name }}<br>
                                                        {{trans_choice('general.number',1)}}:{{ $key->account_number }}
                                                        <br>
                                                        {{trans_choice('general.address',1)}}:{{ $key->address }}<br>
                                                    @endif
                                                </td>
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
                                                <td>{{ $key->created_at }}</td>
                                                <td class="text-center">
                                                    <ul class="icons-list">
                                                        <li class="dropdown">
                                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                                <i class="icon-menu9"></i>
                                                            </a>
                                                            <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                                                @if(Sentinel::hasAccess('borrowers.update'))
                                                                    <li>
                                                                        <a href="{{ url('withdrawal/'.$key->id.'/cancel') }}"
                                                                           class="delete">
                                                                            {{ trans('general.cancel') }} </a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="{{ url('withdrawal/'.$key->id.'/pending') }}"
                                                                           class="delete">
                                                                            {{ trans('general.pending') }} </a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="{{ url('withdrawal/'.$key->id.'/processing') }}"
                                                                           class="delete">
                                                                            {{ trans('general.processing') }} </a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="{{ url('withdrawal/'.$key->id.'/done') }}"
                                                                           class="delete">
                                                                            {{ trans('general.done') }} </a>
                                                                    </li>
                                                                @endif
                                                                @if(Sentinel::hasAccess('borrowers.delete'))
                                                                    <li>
                                                                        <a href="{{ url('withdrawal/'.$key->id.'/delete') }}"
                                                                           class="delete"> {{ trans('general.delete') }}
                                                                        </a>
                                                                    </li>
                                                                @endif
                                                            </ul>
                                                        </li>
                                                    </ul>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane " id="orders">
                                <div class="table-responsive">
                                    <table id="" class="table table-striped table-condensed table-hover data-table">
                                        <thead>
                                        <tr>
                                            <th>{{trans_choice('general.id',1)}}</th>
                                            <th>{{trans_choice('general.type',1)}}</th>
                                            <th>{{trans_choice('general.status',1)}}</th>
                                            <th>{{trans_choice('general.market',1)}}</th>
                                            <th>{{trans_choice('general.price',1)}}</th>
                                            <th>{{trans_choice('general.volume',1)}}</th>
                                            <th>{{trans_choice('general.amount',1)}}</th>
                                            <th>{{trans_choice('general.time',1)}}</th>
                                            <th>{{ trans_choice('general.action',1) }}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach(\App\Models\OrderBook::where('user_id',$user->id)->get() as $key)
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
                                                        <i class="fa fa-link" data-toggle="tooltip"
                                                           title="{{$key->linked_order_id}}"></i>
                                                    @endif
                                                    @if($key->status=="accepted")
                                                        {{trans_choice('general.accepted',1)}}
                                                    @endif
                                                </td>
                                                <td>
                                                    @if(!empty($trade_currency))
                                                        {{$trade_currency->xml_code}}/
                                                    @endif
                                                    @if(!empty($default))
                                                        {{$default->xml_code}}
                                                    @endif
                                                </td>
                                                <td>{{ number_format($key->price,2) }}</td>
                                                <td>{{round( $key->volume,6) }}</td>
                                                <td>{{ number_format($key->amount,2) }}</td>
                                                <td>{{ $key->created_at }}</td>
                                                <td class="text-center">
                                                    <ul class="icons-list">
                                                        <li class="dropdown">
                                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                                <i class="icon-menu9"></i>
                                                            </a>
                                                            <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                                                @if(Sentinel::hasAccess('borrowers.update'))
                                                                    <li><a href="{{ url('order/'.$key->id.'/cancel') }}"
                                                                           class="delete">
                                                                            {{ trans('general.cancel') }} </a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="{{ url('order/'.$key->id.'/pending') }}"
                                                                           class="delete">
                                                                            {{ trans('general.pending') }} </a>
                                                                    </li>
                                                                    <li><a href="{{ url('order/'.$key->id.'/done') }}"
                                                                           class="delete">
                                                                            {{ trans('general.done') }} </a>
                                                                    </li>
                                                                @endif
                                                                @if(Sentinel::hasAccess('borrowers.delete'))
                                                                    <li><a href="{{ url('order/'.$key->id.'/delete') }}"
                                                                           class="delete"> {{ trans('general.delete') }}
                                                                        </a>
                                                                    </li>
                                                                @endif
                                                            </ul>
                                                        </li>
                                                    </ul>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane " id="bank_accounts">
                                <div class="table-responsive">
                                    <table id="" class="table table-striped table-condensed table-hover data-table">
                                        <thead>
                                        <tr>
                                            <th>{{trans_choice('general.bank',1)}}</th>
                                            <th>{{trans_choice('general.account',1)}} {{trans_choice('general.name',1)}}</th>
                                            <th>{{trans_choice('general.account',1)}} {{trans_choice('general.number',1)}}</th>
                                            <th>{{trans_choice('general.agency_number',1)}}</th>
                                            <th>{{trans_choice('general.cpf_number',1)}}</th>
                                            <th>{{trans_choice('general.status',1)}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($user->bank_accounts as $key)
                                            <tr>
                                                <td>
                                                    @if(!empty($key->withdrawal_method))
                                                        {{ $key->withdrawal_method->name }}
                                                    @endif
                                                </td>
                                                <td>{{ $key->account_name }}</td>
                                                <td>
                                                    {{ $key->account_number }}
                                                    @if($key->default_account==1)
                                                        <span class="label label-success" data-toggle="tooltip"
                                                              title="Default"><i
                                                                    class="fa fa-check"></i> </span>
                                                    @endif
                                                </td>
                                                <td>{{ $key->agency_number }}</td>
                                                <td>{{ $key->cpf_number }}</td>
                                                <td>
                                                    @if($key->active==1)
                                                        <span class="label label-success">{{trans_choice('general.active',1)}}</span>
                                                    @endif
                                                    @if($key->active==0)
                                                        <span class="label label-warning">{{trans_choice('general.inactive',1)}}</span>
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
            </div>
        </div>
    </div>

@endsection
@section('footer-scripts')
    <script>
        $('.data-table').DataTable({
            "language": {
                "lengthMenu": "{{ trans('general.lengthMenu') }}",
                "zeroRecords": "{{ trans('general.zeroRecords') }}",
                "info": "{{ trans('general.info') }}",
                "infoEmpty": "{{ trans('general.infoEmpty') }}",
                "search": "{{ trans('general.search') }}",
                "infoFiltered": "{{ trans('general.infoFiltered') }}",
                "paginate": {
                    "first": "{{ trans('general.first') }}",
                    "last": "{{ trans('general.last') }}",
                    "next": "{{ trans('general.next') }}",
                    "previous": "{{ trans('general.previous') }}"
                },
                "columnDefs": [
                    {"orderable": false, "targets": 0}
                ]
            },
            responsive: true,
        });
    </script>
@endsection
