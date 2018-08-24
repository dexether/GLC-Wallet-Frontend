<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MarketData;
use App\Bitfinex;
use App\User;

class MarketDataController extends Controller
{
    public function Chart($coin, $currency)
    {	 
    	$btc_data = json_decode(file_get_contents('https://min-api.cryptocompare.com/data/histohour?fsym='.$coin.'&tsym='.$currency.'&limit=1000&aggregate=1')); 
    	return $chart_data = $btc_data->Data;	
    }

    public function Testing()
    {
    	$data = json_decode(file_get_contents('https://min-api.cryptocompare.com/data/pricemultifull?fsyms=BTC,ETH&tsyms=USD,EUR,GBP,RUB,BTC'));
    	print_r($data);
    }

    public function updateMarketData()
    {
    	$data = json_decode(file_get_contents('https://min-api.cryptocompare.com/data/pricemultifull?fsyms=BTC,ETH,XRP,LTC,DASH,XMR,BTS&tsyms=USD')); 
        MarketData::truncate();

    	foreach ($data->RAW as $key => $value) {
    		foreach ($value as $key1 => $value1) {
    			
    			$market = new MarketData;
    			$market->coin = $value1->FROMSYMBOL;
    			$market->currency = $value1->TOSYMBOL;
    			$market->price = $value1->PRICE;
    			$market->open = $value1->OPENDAY;
    			$market->high = $value1->HIGHDAY;
    			$market->low = $value1->LOWDAY;
    			$market->close = $value1->HIGH24HOUR;
    			$market->volume = $value1->VOLUMEDAY;
    			$market->last_change = $value1->CHANGEDAY;
    			$market->time = $value1->LASTUPDATE;
    			$market->save();
    		}
    	}
    	return 'Success';
    }

    public function marketData()
    {
    	return MarketData::get();
    } 

    public function marketDataByCoin($coin)
    {
       return MarketData::where('coin',$coin)->first();
    } 

}
