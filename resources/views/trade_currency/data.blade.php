@extends('layouts.master')
@section('title')
    {{trans_choice('general.trade',1)}} {{trans_choice('general.currency',2)}}
@endsection
@section('content')
<div class="pageContent">
<div class="container">
    <div class="panel panel-white">
        <div class="panel-heading">
            <h6 class="panel-title"> {{trans_choice('general.trade',1)}} {{trans_choice('general.currency',2)}}</h6>

            <div class="heading-elements">

            </div>
        </div>
        <div class="panel-body ">
            <div class="table-responsive">
                <table id="data-table" class="table table-striped table-condensed table-hover">
                    <thead>
                    <tr>
                        <th>{{trans_choice('general.id',1)}}</th>
                        <th>{{trans_choice('general.logo',1)}}</th>
                        <th>{{trans_choice('general.currency',1)}}</th>
                        <th>{{trans_choice('general.type',1)}}</th>
                        <th>{{trans_choice('general.fee',1)}}</th>
                        <th>{{trans_choice('general.status',1)}}</th>
                        <th>{{ trans_choice('general.action',1) }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($data as $key)
                        <tr>
                            <td>{{ $key->id }}</td>
                            <td>
                                @if(empty($key->logo))
                                    <img src="{{asset('uploads/no_image.png')}}" width="33">
                                @else
                                    <img src="{{asset('uploads/'.$key->logo)}}" width="33">
                                @endif
                            </td>
                            <td>
                                {{ $key->name }}
                                @if($key->default_currency==1)
                                    <span class="label label-success">{{trans_choice('general.default',1)}}</span>
                                @endif
                            </td>
                            <td>{{ $key->xml_code }}</td>
                            <td>
                                @if($key->fee_method=="fixed")
                                    <b>{{trans_choice('general.deposit_fixed_fee',1)}}
                                        :</b>   {{ round($key->deposit_fixed_fee,$key->decimals) }}<br>
                                    <b>{{trans_choice('general.withdrawal_fixed_fee',1)}}
                                        :</b>   {{ round($key->withdrawal_fixed_fee,$key->decimals) }}<br>
                                    <b>{{trans_choice('general.commission_fixed_fee',1)}}
                                        :</b>   {{ round($key->commission_fixed_fee,$key->decimals) }}<br>
                                @endif
                                @if($key->fee_method=="percentage")
                                    <b>{{trans_choice('general.deposit_percentage_fee',1)}}
                                        :</b>   {{ round($key->deposit_percentage_fee,$key->decimals) }}%<br>
                                    <b>{{trans_choice('general.withdrawal_percentage_fee',1)}}
                                        :</b>   {{ round($key->withdrawal_percentage_fee,$key->decimals) }}%<br>
                                    <b>{{trans_choice('general.commission_percentage_fee',1)}}
                                        :</b>   {{ round($key->commission_percentage_fee,$key->decimals) }}%<br>
                                @endif
                                @if($key->fee_method=="both")
                                    <b>{{trans_choice('general.deposit_fee',1)}}
                                        :</b>{{ round($key->deposit_fixed_fee,$key->decimals) }}
                                    +   {{ round($key->deposit_percentage_fee,$key->decimals) }}%<br>
                                    <b>{{trans_choice('general.withdrawal_fee',1)}}
                                        :</b> {{ round($key->withdrawal_fixed_fee,$key->decimals) }}
                                    +  {{ round($key->withdrawal_percentage_fee,$key->decimals) }}%<br>
                                    <b>{{trans_choice('general.commission_fee',1)}}
                                        :</b> {{ round($key->commission_fixed_fee,$key->decimals) }}
                                    +   {{ round($key->commission_percentage_fee,$key->decimals) }}%<br>
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
                            <td class="text-center">
                                <ul class="icons-list">
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                            <i class="icon-menu9"></i>
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                            @if(Sentinel::hasAccess('currencies.update'))
                                                <li><a href="{{ url('trade_currency/'.$key->id.'/edit') }}"><i
                                                                class="fa fa-edit"></i> {{ trans('general.edit') }} </a>
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
</div>
</div>
    <!-- /.box -->
@endsection
@section('footer-scripts')
    <script>
        $('#data-table').DataTable({
            "order": [[0, "asc"]],
            "columnDefs": [
                {"orderable": false, "targets": [6]}
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
