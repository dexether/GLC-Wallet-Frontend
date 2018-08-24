<li class="@if(Request::is('dashboard')) active @endif">
    <a href="{{ url('dashboard') }}">
        <i class="fa fa-dashboard"></i> <span>{{trans_choice('general.dashboard',1)}}</span>
    </a>
</li>
@if(Sentinel::hasAccess('currencies'))
    <li class="@if(Request::is('trade_currency/*')) active @endif">
        <a href="{{ url('trade_currency/data') }}">
            <i class="fa fa-dollar"></i> <span> {{trans_choice('general.currency',2)}}</span>
        </a>
    </li>
@endif
@if(Sentinel::hasAccess('repayments'))
    <li class="@if(Request::is('order/*')) active @endif">
        <a href="{{ url('order/data') }}">
            <i class="fa fa-exchange"></i> <span> {{trans_choice('general.order',2)}}</span>
        </a>
    </li>
@endif

<li class="dropdown
    @if(Request::is('deposit/*')) active @endif
@if(Request::is('withdrawal/*')) active @endif">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <i class="fa fa-money"></i> <span>{{trans_choice('general.transaction',2)}}</span>
        <span class="caret"></span>
    </a>
    <ul class="dropdown-menu dropdown-menu-right">
        @if(Sentinel::hasAccess('deposits.view'))
            <li><a href="{{ url('deposit/data') }}"><i
                            class="fa fa-circle-o"></i> {{trans_choice('general.deposit',2)}}
                </a></li>
        @endif
        @if(Sentinel::hasAccess('withdrawals.view'))
            {{--<li><a href="{{ url('withdrawal/data') }}"><i class="fa fa-circle-o"></i> {{trans_choice('general.withdrawal',2)}}</a></li>--}}
            <li><a href="{{ url('withdrawals/data') }}"><i class="fa fa-circle-o"></i> {{trans_choice('general.withdrawal',2)}}</a></li>
        @endif

    </ul>
</li>
<li class="dropdown
    @if(Request::is('deposit/*')) active @endif
@if(Request::is('withdrawal/*')) active @endif">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <i class="fa fa-money"></i> <span>{{trans_choice('general.gateway',2)}}</span>
        <span class="caret"></span>
    </a>
    <ul class="dropdown-menu dropdown-menu-right">
        @if(Sentinel::hasAccess('deposits.view'))
            <li><a href="{{ url('payment_gateway/data') }}"><i
                            class="fa fa-circle-o"></i>{{trans_choice('general.payment',1)}} {{trans_choice('general.gateway',2)}}
                </a></li>
        @endif
        @if(Sentinel::hasAccess('withdrawals.view'))
            <li><a href="{{ url('withdrawal_method/data') }}"><i
                            class="fa fa-circle-o"></i> {{trans_choice('general.withdrawal',1)}} {{trans_choice('general.method',2)}}
                </a></li>
        @endif
    </ul>
</li>

<li class="dropdown @if(Request::is('exchange/*')) active @endif">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <i class="fa fa-exchange"></i> <span>Exchange</span>
        <span class="caret"></span>
    </a>
    <ul class="dropdown-menu dropdown-menu-right">
        
            <li><a href="{{ url('exchange/buy') }}"><i class="fa fa-circle-o"></i>Buy History</a></li>
            <li><a href="{{ url('exchange/sell') }}"><i class="fa fa-circle-o"></i>Sell History</a></li>
            <li><a href="{{ url('exchange/balance') }}"><i class="fa fa-circle-o"></i>My Balance</a></li>


          <!--  @if(Sentinel::hasAccess('deposits.view'))
            <li><a href="{{ url('payment_gateway/data') }}"><i class="fa fa-circle-o"></i>{{trans_choice('general.payment',1)}} {{trans_choice('general.gateway',2)}}
                </a></li>
        @endif

        @if(Sentinel::hasAccess('withdrawals.view'))
            <li><a href="{{ url('withdrawal_method/data') }}"><i
                            class="fa fa-circle-o"></i> {{trans_choice('general.withdrawal',1)}} {{trans_choice('general.method',2)}}
                </a></li>
        @endif -->
    </ul>
</li>


<li class="dropdown
    @if(Request::is('communication/*')) active @endif
@if(Request::is('setting/*')) active @endif
@if(Request::is('offline_wallet*')) active @endif
@if(Request::is('announcement*')) active @endif
@if(Request::is('audit_trail/*')) active @endif
@if(Request::is('user/*')) active @endif">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <i class="fa fa-money"></i> <span>{{trans_choice('general.utility',2)}}</span>
        <span class="caret"></span>
    </a>
    <ul class="dropdown-menu dropdown-menu-right">
        @if(Sentinel::hasAccess('communication'))
            <li class="dropdown-submenu @if(Request::is('communication/*')) active @endif
            @if(Request::is('sms_gateway/*')) active @endif
                    ">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-envelope"></i> <span>{{trans_choice('general.communication',2)}} </span>
                </a>
                <ul class="dropdown-menu dropdown-menu-right">
                    <li><a href="{{ url('communication/email') }}"><i
                                    class="fa fa-circle-o"></i> {{trans_choice('general.email',1)}}
                        </a></li>
                    <li><a href="{{ url('communication/sms') }}"><i
                                    class="fa fa-circle-o"></i> {{trans_choice('general.sms',2)}}
                        </a></li>
                    @if(Sentinel::hasAccess('settings'))
                        <li><a href="{{ url('sms_gateway/data') }}"><i
                                        class="fa fa-circle-o"></i> {{trans_choice('general.manage',2)}} {{trans_choice('general.sms',1)}} {{trans_choice('general.gateway',2)}}
                            </a></li>
                    @endif
                </ul>
            </li>
        @endif
        @if(Sentinel::hasAccess('users'))
            <li class="dropdown-submenu @if(Request::is('user/*')) active @endif">
                <a href="{{ url('user/data') }}" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-users"></i> <span>{{trans_choice('general.user',2)}}</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-right">
                    @if(Sentinel::hasAccess('users.view'))
                        <li><a href="{{ url('user/data') }}">
                                <i class="fa fa-circle-o"></i>
                                <span>{{trans_choice('general.view',2)}} {{trans_choice('general.user',2)}}</span>
                            </a></li>
                    @endif
                    @if(Sentinel::hasAccess('users.roles'))
                        <li><a href="{{ url('user/role/data') }}"><i
                                        class="fa fa-circle-o"></i>{{trans_choice('general.manage',2)}} {{trans_choice('general.role',2)}}
                            </a></li>
                    @endif
                    @if(Sentinel::hasAccess('users.create'))
                        <li><a href="{{ url('user/create') }}"><i
                                        class="fa fa-circle-o"></i>{{trans_choice('general.add',2)}} {{trans_choice('general.user',2)}}
                            </a></li>
                    @endif
                </ul>
            </li>
        @endif
        @if(Sentinel::hasAccess('audit_trail'))
            <li class="@if(Request::is('audit_trail/*')) active @endif">
                <a href="{{ url('audit_trail/data') }}">
                    <i class="fa fa-area-chart"></i> <span>{{trans_choice('general.audit_trail',2)}}</span>
                </a>
            </li>
        @endif
        @if(Sentinel::hasAccess('settings'))
            <li class="@if(Request::is('offline_wallet*')) active @endif">
                <a href="{{ url('offline_wallet/data') }}">
                    <i class="fa fa-google-wallet"></i>
                    <span>{{trans_choice('general.offline',1)}} {{trans_choice('general.wallet',2)}}</span>
                </a>
            </li>
            <li class="@if(Request::is('announcement*')) active @endif">
                <a href="{{ url('announcement') }}">
                    <i class="fa fa-bullhorn"></i> <span>{{trans_choice('general.announcement',1)}}</span>
                </a>
            </li>
            <li class="@if(Request::is('setting/*')) active @endif">
                <a href="{{ url('setting/data') }}">
                    <i class="fa fa-cog"></i> <span>{{trans_choice('general.setting',2)}}</span>
                </a>
            </li>
        @endif
    </ul>
</li>



