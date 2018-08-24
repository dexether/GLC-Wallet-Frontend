@extends('layouts.master')
@section('title')
    {{trans_choice('general.withdrawal',2)}}
@endsection
@section('content')
<div class="pageContent">
    <div class="container">
    <div class="panel panel-white">
        <div class="panel-heading">
            <h6 class="panel-title"> {{trans_choice('general.withdrawal',2)}}</h6>

            <div class="heading-elements">

            </div>
        </div>
        <div class="panel-body ">
            <div class="table-responsive">
                <table id="data-table" class="table table-striped table-condensed table-hover">
                    <thead>
                        <tr>
                            <th>{{trans_choice('general.id',1)}}</th>
                            <th>{{trans_choice('general.user',1)}}</th>
                            <th>{{trans_choice('general.currency',1)}}</th>
                            <th>{{trans_choice('general.amount',1)}}</th>
                            <th>{{trans_choice('general.fee',1)}}</th>
                            <th>{{trans_choice('general.account',1)}}</th>
                            <th>{{trans_choice('general.status',1)}}</th>
                            <th>{{trans_choice('general.time',1)}}</th>
                            <th>{{ trans_choice('general.action',1) }}</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($data as $key)
                        <?php
                        $trade_currency = \App\Models\TradeCurrency::find($key->trade_currency_id);
                        ?>
                        <tr>
                            <td>{{ $key->id }}</td>
                            <td>
                                @if(!empty($key->user))
                                    <a href="{{url('user/'.$key->user_id.'/show')}}"> {{$key->user->first_name}}  {{$key->user->last_name}}</a>
                                @endif
                            </td>

                            <td>
                                @if(!empty($trade_currency))
                                    {{$trade_currency->xml_code}}
                                @endif
                            </td>
                            <td>{{ number_format($key->amount,2) }}</td>
                            <td>{{ number_format($key->fee,2) }}</td>
                            <td>

                                {{--@if($key->network!="usd")--}}
                                    {{--{{$key->receiver_address}}--}}
                                {{--@else--}}
                                    @if($key->bank_account)
                                        @if(!empty($key->bank_account->withdrawal_method))
                                            {{ $key->bank_account->withdrawal_method->name }}
                                        @endif
                                         ({{ $key->bank_account->account_name }}- {{ $key->bank_account->account_number }})
                                    @else
                                        {{ $key->account_name }}- {{ $key->account_number }}
                                    @endif
                                {{--@endif--}}
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
                                @if($key->status=="pending")
                                <ul class="icons-list">
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                            <i class="icon-menu9"></i>
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                            @if(Sentinel::hasAccess('withdrawals.update'))

                                                <li><a href="{{ url('withdrawals/'.$key->id.'/cancel') }}"
                                                       class="delete">
                                                        {{ trans('general.cancel') }} </a>
                                                </li>
                                                {{--<li><a href="{{ url('withdrawals/'.$key->id.'/pending') }}"--}}
                                                       {{--class="delete">--}}
                                                        {{--{{ trans('general.pending') }} </a>--}}
                                                {{--</li>--}}
                                                {{--<li><a href="{{ url('withdrawals/'.$key->id.'/processing') }}"--}}
                                                       {{--class="delete">--}}
                                                        {{--{{ trans('general.processing') }} </a>--}}
                                                {{--</li>--}}
                                                <li><a href="{{ url('withdrawals/'.$key->id.'/done') }}" class="delete">
                                                        {{ trans('general.done') }} </a>
                                                </li>

                                            @endif
                                            {{--@if(Sentinel::hasAccess('withdrawals.delete'))--}}
                                                {{--<li><a href="{{ url('withdrawals/'.$key->id.'/delete') }}"--}}
                                                       {{--class="delete"> {{ trans('general.delete') }}--}}
                                                    {{--</a>--}}
                                                {{--</li>--}}
                                            {{--@endif--}}
                                        </ul>
                                    </li>
                                </ul>
                                @else
                                    --
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- /.panel-body -->
    </div>
</div>
</div>
    <!-- /.box -->
@endsection
@section('footer-scripts')
    <script>
        $('#data-table').DataTable({
            "order": [[6, "desc"]],
            "columnDefs": [
                {"orderable": false, "targets": [7]}
            ],
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
                }
            },
            responsive: false
        });
    </script>
@endsection
