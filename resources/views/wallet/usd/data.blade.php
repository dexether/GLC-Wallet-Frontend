@extends('layouts.master')
@section('title')
    {{$usd->name}} {{trans_choice('general.wallet',1)}}
@endsection
@section('content')
<section>
      <div class="pageContent  wallets">
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
            <div class="panel panel-white">
                <div class="panel-heading">
                    <h6 class="panel-title"> {{$usd->name}} {{trans_choice('general.wallet',1)}}</h6>

                    <div class="heading-elements">
                        <a href="{{ url('wallet/usd/deposit') }}"
                           class="btn btn-default send_rec"><i class="fa fa-plus"></i> {{trans_choice('general.deposit',1)}}
                        </a>
                        <a href="{{ url('wallet/usd/withdraw') }}"
                           class="btn btn-default send_rec"><i class="fa fa-send"></i> {{trans_choice('general.withdraw',1)}}
                        </a>
                    </div>
                </div>
                <div class="panel-body ">
                    <div class="tabbable">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#deposits" data-toggle="tab"
                                                  class="legitRipple">{{trans_choice('general.deposit',2)}}</a></li>
                            <li class=""><a href="#withdrawals" data-toggle="tab"
                                            class="legitRipple">{{trans_choice('general.withdrawal',2)}}</a></li>
                        </ul>

                        <div class="tab-content">
                            <div class="tab-pane active" id="deposits">
                                <div class="table-responsive">
                                    <table id="" class="table table-striped table-condensed table-hover data-table">
                                        <thead>
                                        <tr>
                                            <th>{{trans_choice('general.id',1)}}</th>
                                            <th>{{trans_choice('general.time',1)}}</th>
                                            <th>{{trans_choice('general.amount',1)}}</th>
                                            <th>{{trans_choice('general.from',1)}}</th>
                                            <th>{{trans_choice('general.status',1)}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($deposits as $key)
                                            <tr>
                                                <td>{{ $key->id }}</td>
                                                <td>{{ $key->created_at }}</td>
                                                <td>{{ round($key->amount,$usd->decimals) }}</td>
                                                <td>
                                                    @if($key->bank_account)
                                                        @if(!empty($key->bank_account->withdrawal_method))
                                                            {{ $key->bank_account->withdrawal_method->name }}
                                                        @endif
                                                         ({{ $key->bank_account->account_name }}- {{ $key->bank_account->account_number }})
                                                    @else
                                                        {{ $key->account_name }}- {{ $key->account_number }}
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($key->status=="pending")
                                                        {{trans_choice('general.pending',1)}}
                                                        <a href="{{url('wallet/deposit/'.$key->id.'/cancel')}}"
                                                           class="delete">
                                                            <i data-toggle="tooltip" class="fa fa-times-circle-o fa-2x"
                                                               aria-hidden="true"
                                                               style="color: #797474" title=""
                                                               data-original-title="Cancel"></i>
                                                        </a>
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
                                    <table id="data-table" class="table table-striped table-condensed table-hover data-table">
                                        <thead>
                                        <tr>
                                            <th>{{trans_choice('general.id',1)}}</th>
                                            <th>{{trans_choice('general.time',1)}}</th>
                                            <th>{{trans_choice('general.account',1)}}</th>
                                            <th>{{trans_choice('general.amount',1)}}</th>
                                            <th>{{trans_choice('general.fee',2)}}</th>
                                            <th>{{trans_choice('general.status',1)}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($withdrawals as $key)
                                            <tr>
                                                <td>{{ $key->id }}</td>
                                                <td>{{ $key->created_at }}</td>
                                                <td>
                                                    @if($key->bank_account)
                                                        @if(!empty($key->bank_account->withdrawal_method))
                                                            {{ $key->bank_account->withdrawal_method->name }}
                                                        @endif
                                                        ({{$key->bank_account->account_name }}- {{ $key->bank_account->account_number }})
                                                    @else
                                                        {{ $key->account_name }}- {{ $key->account_number }}
                                                    @endif
                                                </td>
                                                <td>{{ round($key->amount,$usd->decimals) }}</td>
                                                <td>{{round( $key->fee,$usd->decimals) }}</td>
                                                <td>
                                                    @if($key->status=="pending")
                                                        {{trans_choice('general.pending',1)}}
                                                        <a href="{{url('wallet/withdrawal/'.$key->id.'/cancel')}}"
                                                           class="delete">
                                                            <i data-toggle="tooltip" class="fa fa-times-circle-o fa-2x"
                                                               aria-hidden="true"
                                                               style="color: #797474" title=""
                                                               data-original-title="Cancel"></i>
                                                        </a>
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
        $('.data-table').DataTable({
            "order": [[0, "desc"]],
            "columnDefs": [
                {"orderable": false, "targets": []}
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
