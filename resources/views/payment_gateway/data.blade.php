@extends('layouts.master')
@section('title')
    {{trans_choice('general.payment',1)}} {{trans_choice('general.gateway',2)}}
@endsection
@section('content')
<div class="pageContent">
    <div class="container">
    <div class="panel panel-white">
        <div class="panel-heading">
            <h6 class="panel-title">  {{trans_choice('general.payment',1)}} {{trans_choice('general.gateway',2)}}</h6>

            {{--<div class="heading-elements">
                @if(Sentinel::hasAccess('deposits.create'))
                    <a href="{{ url('payment_gateway/create') }}" class="btn btn-info btn-xs">
                        {{ trans_choice('general.add',1) }} {{ trans_choice('general.gateway',1) }}
                    </a>
                @endif
            </div>--}}
        </div>
        <div class="panel-body ">
            <div class="table-responsive">
                <table id="data-table" class="table table-striped table-condensed table-hover">
                    <thead>
                    <tr>
                        <th>{{trans_choice('general.name',1)}}</th>
                        <th>{{trans_choice('general.logo',1)}}</th>
                        {{--<th>{{trans_choice('general.ready_to_use',1)}}</th>--}}
                        <th>{{ trans_choice('general.type',1) }}</th>
                        <th>{{ trans_choice('general.note',1) }}</th>
                        {{--<th>{{trans_choice('general.status',1)}}</th>--}}
                        <th>{{ trans_choice('general.action',1) }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($data as $key)
                        <tr>
                            <td>{{ $key->name }}</td>
                            <td>
                                @if(empty($key->logo))
                                    <img src="{{asset('uploads/no_image.png')}}" width="33">
                                @else
                                    <img src="{{asset('uploads/'.$key->logo)}}" width="33">
                                @endif
                            </td>
                            {{--<td>
                                @if($key->name=="Paypal")
                                    @if(empty($key->paypal_email))
                                        <i data-toggle="tooltip" class="fa fa-times-circle-o fa-2x" aria-hidden="true"
                                           style="color: #797474" title=""
                                           data-original-title="you need to fill your Paypal email first"></i>
                                    @else
                                        <i data-toggle="tooltip" class="fa fa-check-square-o fa-2x" aria-hidden="true"
                                           style="color: #1fb40e" title=""
                                           data-original-title="Gateway is ready to use!"></i>
                                    @endif


                                @elseif($key->name=="Paynow")
                                    @if(empty($key->paynow_id) || empty($key->paynow_key))
                                        <i data-toggle="tooltip" class="fa fa-times-circle-o fa-2x" aria-hidden="true"
                                           style="color: #797474" title=""
                                           data-original-title="you need to fill your Paynow account settings first"></i>
                                    @else
                                        <i data-toggle="tooltip" class="fa fa-check-square-o fa-2x" aria-hidden="true"
                                           style="color: #1fb40e" title=""
                                           data-original-title="Gateway is ready to use!"></i>
                                    @endif

                                @elseif($key->name=="Stripe")
                                    @if(empty($key->stripe_secret_key) || empty($key->stripe_publishable_key))
                                        <i data-toggle="tooltip" class="fa fa-times-circle-o fa-2x" aria-hidden="true"
                                           style="color: #797474" title=""
                                           data-original-title="you need to fill your Stripe account settings first"></i>
                                    @else
                                        <i data-toggle="tooltip" class="fa fa-check-square-o fa-2x" aria-hidden="true"
                                           style="color: #1fb40e" title=""
                                           data-original-title="Gateway is ready to use!"></i>
                                    @endif
                                @else
                                    <i data-toggle="tooltip" class="fa fa-check-square-o fa-2x" aria-hidden="true"
                                       style="color: #1fb40e" title=""
                                       data-original-title="Gateway is ready to use!"></i>
                                @endif
                            </td>--}}

                            {{--<td>
                                @if($key->active==1)
                                    <span class="label label-success">{{trans_choice('general.active',1)}}</span>
                                @endif
                                @if($key->active==0)
                                    <span class="label label-warning">{{trans_choice('general.inactive',1)}}</span>
                                @endif
                            </td>--}}
                            <td>
                                {{$key->type}}
                            </td>
                            <td>
                                {{$key->notes}}
                            </td>
                            <td class="text-center">
                                <ul class="icons-list">
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                            <i class="icon-menu9"></i>
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                            @if(Sentinel::hasAccess('deposits.update'))
                                                <li><a href="{{ url('payment_gateway/'.$key->id.'/edit') }}"><i
                                                                class="fa fa-edit"></i> {{ trans('general.edit') }} </a>
                                                </li>
                                            @endif
                                            @if($key->active==0)
                                                @if(Sentinel::hasAccess('deposits.delete'))
                                                    <li><a href="{{ url('payment_gateway/'.$key->id.'/delete') }}"
                                                           class="delete"><i
                                                                    class="fa fa-trash"></i> {{ trans('general.delete') }}
                                                        </a>
                                                    </li>
                                                @endif
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
                {"orderable": false, "targets": [3]}
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
