@extends('layouts.master')
@section('title')
    {{trans_choice('general.offline',1)}} {{trans_choice('general.wallet',2)}}
@endsection
@section('content')
<div class="pageContent">
    <div class="container">
    <div class="panel panel-white">
        <div class="panel-heading">
            <h6 class="panel-title"> {{trans_choice('general.offline',1)}} {{trans_choice('general.wallet',2)}}</h6>

            <div class="heading-elements">
                @if(Sentinel::hasAccess('withdrawals.create'))
                    <a href="{{ url('offline_wallet/import/create') }}" class="btn btn-info btn-xs">
                        {{ trans_choice('general.import',1) }} {{trans_choice('general.wallet',2)}}
                    </a>
                    <a href="{{ url('offline_wallet/create') }}" class="btn btn-info btn-xs">
                        {{ trans_choice('general.add',1) }} {{trans_choice('general.wallet',1)}}
                    </a>
                @endif
            </div>
        </div>
        <div class="panel-body ">
            <div class="table-responsive">
                <table id="data-table" class="table table-striped table-condensed table-hover">
                    <thead>
                    <tr>
                        <th>{{trans_choice('general.address',1)}}</th>
                        <th>{{trans_choice('general.currency',1)}}</th>
                        <th>{{trans_choice('general.status',1)}}</th>
                        <th>{{trans_choice('general.created_at',1)}}</th>
                        <th>{{ trans_choice('general.action',1) }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($data as $key)
                        <tr>
                            <td>{{ $key->address }}</td>
                            <td>
                                @if(!empty($key->trade_currency))
                                    {{$key->trade_currency->name}}
                                @endif
                            </td>
                            <td>
                                @if($key->active==1)
                                    <span class="label label-success">{{trans_choice('general.active',1)}}</span>
                                @endif
                                @if($key->active==0)
                                    <span class="label label-warning">{{trans_choice('general.inactive',1)}}</span>
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
                                            @if(Sentinel::hasAccess('withdrawals.update'))
                                                <li><a href="{{ url('offline_wallet/'.$key->id.'/edit') }}"><i
                                                                class="fa fa-edit"></i> {{ trans('general.edit') }} </a>
                                                </li>
                                            @endif
                                            @if(Sentinel::hasAccess('withdrawals.delete'))
                                                <li><a href="{{ url('offline_wallet/'.$key->id.'/delete') }}"
                                                       class="delete"><i
                                                                class="fa fa-trash"></i> {{ trans('general.delete') }}
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
        <!-- /.panel-body -->
    </div>
    <!-- /.box -->
</div>
</div>
@endsection
@section('footer-scripts')
    <script>
        $('#data-table').DataTable({
            "order": [[3, "desc"]],
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
