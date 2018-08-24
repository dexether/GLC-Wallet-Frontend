@extends('layouts.master')
@section('title')
    {{trans_choice('general.bank',1)}} {{trans_choice('general.account',2)}}
@endsection
@section('content')
    <div class="panel panel-white">
        <div class="panel-heading">
            <h6 class="panel-title"> {{trans_choice('general.bank',1)}} {{trans_choice('general.account',2)}}</h6>

            <div class="heading-elements">
                <a href="{{ url('user_bank_account/create') }}" class="btn btn-info btn-xs">
                    {{ trans_choice('general.add',1) }} {{ trans_choice('general.account',1) }}
                </a>
            </div>
        </div>
        <div class="panel-body ">
            <div class="table-responsive">
                <table id="data-table" class="table table-striped table-condensed table-hover">
                    <thead>
                    <tr>
                        <th>{{trans_choice('general.bank',1)}}</th>
                        <th>{{trans_choice('general.account',1)}} {{trans_choice('general.name',1)}}</th>
                        <th>{{trans_choice('general.account',1)}} {{trans_choice('general.number',1)}}</th>
                        <th>{{trans_choice('general.agency_number',1)}}</th>
                        <th>{{trans_choice('general.cpf_number',1)}}</th>
                        <th>{{trans_choice('general.status',1)}}</th>
                        <th>{{ trans_choice('general.action',1) }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($data as $key)
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
                                    <span class="label label-success" data-toggle="tooltip" title="Default"><i
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
                            <td class="text-center">
                                <ul class="icons-list">
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                            <i class="icon-menu9"></i>
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-right" role="menu">

                                            <li><a href="{{ url('user_bank_account/'.$key->id.'/edit') }}"><i
                                                            class="fa fa-edit"></i> {{ trans('general.edit') }} </a>
                                            </li>
                                            <li><a href="{{ url('user_bank_account/'.$key->id.'/delete') }}"
                                                   class="delete"><i
                                                            class="fa fa-trash"></i> {{ trans('general.delete') }}
                                                </a>
                                            </li>
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
