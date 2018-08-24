@extends('layouts.master')
@section('title')
    {{trans_choice('general.order',1)}} {{trans_choice('general.history',1)}}
@endsection
@section('content')
    <div class="panel panel-white">
        <div class="panel-heading">
            <h6 class="panel-title">  {{trans_choice('general.order',1)}} {{trans_choice('general.history',1)}}</h6>

            <div class="heading-elements">

            </div>
        </div>
        <div class="panel-body ">
            <div class="table-responsive">
                <table id="data-table" class="table table-striped table-condensed table-hover">
                    <thead>
                    <tr>
                        <th>{{trans_choice('general.id',1)}}</th>
                        <th>{{trans_choice('general.type',1)}}</th>
                        <th>{{trans_choice('general.status',1)}}</th>
                        <th>{{trans_choice('general.market',1)}}</th>
                        <th>{{trans_choice('general.price',1)}}</th>
                        <th>{{trans_choice('general.volume',1)}}</th>
                        <th>{{trans_choice('general.time',1)}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($data as $key)
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
                            <td>{{ round($key->amount,6) }}</td>
                            <td>{{round( $key->volume,6) }}</td>
                            <td>{{ $key->created_at }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- /.panel-body -->
    </div>
    <!-- /.box -->
@endsection
@section('footer-scripts')
    <script>
        $('#data-table').DataTable({
            "order": [[6, "desc"]],
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
