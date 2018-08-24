@extends('layouts.master')
@section('title')
    Exchange Buy History
@endsection
@section('content')
<div class="pageContent">
    <div class="container">
    <div class="panel panel-white">
        <div class="panel-heading">
            <h6 class="panel-title"> Buy History </h6>

            <div class="heading-elements">
            </div>
        </div>
        <div class="panel-body ">
            <div class="table-responsive">
                <table id="data-table" class="table table-striped table-condensed table-hover">
                    <thead>
                    <tr>
                        <th>Sr No.</th>
                        <th>User Name</th>
                        <th>Order ID</th>
                        <th>Count</th>
                        <th>Symbol</th>
                        <th>Rate</th>
                        <th>Amount</th>
                        <th>Price</th>
                        {{--<th>Origional Amount</th>--}}
                        {{--<th>Remaining Amount</th>--}}
                        <th>Status</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php $i=1; ?>
                    @foreach($buy_data as $key)
                     <tr >
                        <td>{{ $i++ }}</td>
                        <td>{{ $key->userdata->first_name }} {{ $key->userdata->last_name }}</td>
                        <td>{{ $key->order_id }}</td>
                        <td>1</td>
                        <td>{{ strtoupper($key->symbol) }}</td>
                        <td>{{ number_format($key->same_price,2) }}</td>
                        <td>{{ number_format($key->price,2) }}</td>
                        <td>{{ number_format($key->final_aed,2) }}</td>
                        {{--<td>{{ number_format($key->original_amount,2) }}</td>--}}
                        {{--<td>{{ number_format($key->remaining_amount,2) }}</td>--}}
                        <td >
                            @if($key->status == 0) <label class="label label-default buycount"> Pending</label>
                            @elseif($key->status == 1)<label class="label label-success buycount">  Success </label>
                            @elseif($key->status == 2)<label class="label label-warning buycount">  Partially </label>
                            @elseif($key->status == 3)<label class="label label-danger buycount">  Cancel </label>
                            @else
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
        $('#data-table').DataTable({});
    </script>

    <script>
        $(document).ready(function() {
            setInterval(function () {
                getMessage();
            }, 60 * 50);

            setInterval(function () {
                location.reload();
            }, 120000);


            function getMessage() {
                var t = $('#data-table').DataTable();
                var table = $('#data-table').dataTable();
                var numItems = table.fnGetData().length;

                $.ajax({
                    type: 'get',
                    url: '{{url('buycountshow')}}'+'/buy/'+ numItems,
                    data: '_token = <?php echo csrf_token() ?>',
                    success: function (data) {
                        var buy = data.data;
                        var table = $('#data-table').dataTable();
                        //Get the total rows
                        if (data.error == 'ok') {
                            $.each(buy, function (index, value) {

                                if (value.status == 0) {

                                    var row = '<label class="label label-default buycount "> Pending</label>';
                                }
                                else if (value.status == 1) {
                                    var row = '<label class="label label-success buycount ">  Success </label>';
                                }
                                else if (value.status == 2) {
                                    var row = '<label class="label label-warning buycount ">  Partially </label>';
                                }
                                else if (value.status == 3) {
                                    var row = '<label class="label label-danger buycount ">  Cancel </label>';
                                }
                                // $('#data-table tbody  ').after(row);
                                counter = 1;
                                t.row.add([
                                    0,
                                    value.userdata.first_name + ' ' + value.userdata.last_name,
                                    value.order_id, 1,
                                    value.symbol,
                                    value.same_price,
                                    value.price,
                                    value.final_aed,
                                    row,
                                ]).draw(false);


                            });
                        }
                    }
                });
            }
        });
    </script>
@endsection
