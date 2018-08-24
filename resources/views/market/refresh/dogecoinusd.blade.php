<div style="height: 565px; overflow: scroll">
    <div class="col-md-6 ">
        <h3><b>{{trans_choice('general.buy',1)}} {{trans_choice('general.order',2)}}</b></h3>
        <table class="table table-striped table-bordered table-condensed table-hover ">
            <thead>
            <tr>
                <th><b>{{trans_choice('general.amount',1)}}</b></th>
                <th><b>{{trans_choice('general.volume',1)}}</b></th>
                <th><b>{{trans_choice('general.bid',1)}}</b></th>
            </tr>
            </thead>
            <tbody class="order_book" id="buy_orders">
            @foreach($buy_orders as $key)
                <tr data-id="{{$key->id}}" data-volume="{{round($key->volume,$dogecoin->decimals)}}"
                    data-amount="{{round($key->amount,2)}}" onclick="quick_buy(this)">
                    <td>{{number_format($key->volume*$key->amount,2)}}</td>
                    <td>{{round($key->volume,$dogecoin->decimals)}}</td>
                    <td>{{number_format($key->amount,2)}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="col-md-6 ">
        <h3><b>{{trans_choice('general.sell',1)}} {{trans_choice('general.order',2)}}</b></h3>
        <table class="table table-striped table-bordered table-condensed table-hover">
            <thead>
            <tr>
                <th><b>{{trans_choice('general.ask',1)}}</b></th>
                <th><b>{{trans_choice('general.volume',1)}}</b></th>
                <th><b>{{trans_choice('general.amount',1)}}</b></th>
            </tr>
            </thead>
            <tbody class="order_book" id="sell_orders">
            @foreach($sell_orders as $key)
                <tr data-id="{{$key->id}}" data-volume="{{round($key->volume,$dogecoin->decimals)}}"
                    data-amount="{{round($key->amount,2)}}" onclick="quick_sell(this)">
                    <td>{{number_format($key->amount,2)}}</td>
                    <td>{{round($key->volume,$dogecoin->decimals)}}</td>
                    <td>{{number_format($key->volume*$key->amount,2)}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>