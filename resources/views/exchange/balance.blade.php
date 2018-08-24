@extends('layouts.master')
@section('title')
    Exchange Balance
@endsection
@section('content')
<div class="pageContent">
    <div class="container">
    <div class="panel panel-white">
        <div class="panel-heading">
            <h6 class="panel-title"> MY Balance </h6>

            <div class="heading-elements">
            </div>
        </div>
        <div class="panel-body ">
            <div class="table-responsive">
                <table id="data-table" class="table table-striped table-condensed table-hover">
                    <thead>
                    <tr>
                        <th>Sr No.</th>
                        <th>Name</th>
                        <th>Balance</th>
                        <th>Available</th>
                        <th>Reserved</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>1</td>
                        <td>USD</td>
                        <td>{{@$data['usd_balance']}}</td>
                        <td>{{@$data['usd_available']}}</td>
                        <td>{{@$data['usd_reserved']}}</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>BTC</td>
                        <td>{{@$data['btc_balance']}}</td>
                        <td>{{@$data['btc_available']}}</td>
                        <td>{{@$data['btc_reserved']}}</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>ETH</td>
                        <td>{{@$data['eth_balance']}}</td>
                        <td>{{@$data['eth_available']}}</td>
                        <td>{{@$data['eth_reserved']}}</td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>XRP</td>
                        <td>{{@$data['xrp_balance']}}</td>
                        <td>{{@$data['xrp_available']}}</td>
                        <td>{{@$data['xrp_reserved']}}</td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td>LTC</td>
                        <td>{{@$data['ltc_balance']}}</td>
                        <td>{{@$data['ltc_available']}}</td>
                        <td>{{@$data['ltc_reserved']}}</td>
                    </tr>
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
            "order": [[9, "desc"]],
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
