<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Trading Exchange</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet"
          type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/themes/limitless/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/themes/limitless/css/icons/icomoon/styles.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="{{ asset('assets/themes/limitless/css/core.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/themes/limitless/css/components.css') }}">

    <!--  New added css -->
    <link rel="stylesheet" href="{{ asset('assets/themes/limitless/css/jquery.mCustomScrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/themes/limitless/css/style.css') }}">
    <!-- End new Added CSS -->

    <link href="{{ asset('assets/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/plugins/bootstrap-touchspin/bootstrap.touchspin.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/plugins/fullcalendar/fullcalendar.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/plugins/fancybox/jquery.fancybox.css') }}"
          rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/plugins/amcharts/plugins/export/export.css') }}"
          rel="stylesheet"
          type="text/css"/>
    <link href="{{ asset('assets/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css') }}"
          rel="stylesheet"
          type="text/css"/>
    <link href="{{ asset('assets/plugins/datepicker/bootstrap-datepicker3.min.css') }}" rel="stylesheet"
          type="text/css"/>


    {{--Start Page header level scripts--}}

    {{--End Page level scripts--}}
</head>
<body class="dashboard">

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="dashboard-header row">
                <div class="dashboard-header-sidebar col-sm-2">
                    <div>
                        <a href="{{url('/dashboard')}}"><svg  xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="136px" height="18px">
                                <path fill-rule="evenodd"  fill="#fff"  d="M135.341,13.079 L135.341,16.000 L125.459,16.000 L125.459,1.837 L134.981,1.837 L134.981,4.738 L128.760,4.738 L128.760,7.398 L134.641,7.398 L134.641,10.139 L128.760,10.139 L128.760,13.079 L135.341,13.079 ZM115.260,16.000 L109.979,16.000 L109.979,1.837 L115.100,1.837 C119.121,1.837 123.202,3.517 123.202,8.878 C123.202,13.860 119.161,16.000 115.260,16.000 ZM115.020,4.758 L113.320,4.758 L113.320,13.039 L114.940,13.039 C117.381,13.039 119.641,12.039 119.641,8.878 C119.641,5.698 117.381,4.758 115.020,4.758 ZM103.901,13.219 L98.420,13.219 L97.380,16.000 L93.722,16.000 L93.659,16.000 L89.721,16.000 L86.661,10.379 L85.500,10.379 L85.500,16.000 L82.140,16.000 L82.140,1.837 L87.541,1.837 C90.261,1.837 92.962,2.877 92.962,6.118 C92.962,8.018 91.842,9.379 90.021,9.939 L93.685,15.939 L99.600,1.837 L102.921,1.837 L108.802,16.000 L105.002,16.000 L103.901,13.219 ZM87.301,4.598 L85.480,4.598 L85.480,7.898 L87.101,7.898 C88.201,7.898 89.581,7.618 89.581,6.178 C89.581,4.858 88.321,4.598 87.301,4.598 ZM101.201,5.618 L99.400,10.479 L102.961,10.479 L101.201,5.618 ZM76.581,16.000 L73.160,16.000 L73.160,4.758 L69.160,4.758 L69.160,2.292 L64.021,9.999 L64.021,16.000 L60.601,16.000 L60.601,9.999 L55.280,1.837 L59.420,1.837 L62.441,7.078 L65.462,1.837 L69.160,1.837 L69.463,1.837 L80.582,1.837 L80.582,4.758 L76.581,4.758 L76.581,16.000 ZM53.362,16.000 L52.262,13.219 L46.781,13.219 L45.741,16.000 L42.020,16.000 L47.961,1.837 L51.282,1.837 L57.163,16.000 L53.362,16.000 ZM49.561,5.618 L47.761,10.479 L51.322,10.479 L49.561,5.618 ZM41.503,11.879 C41.503,14.960 38.802,16.000 36.102,16.000 L30.460,16.000 L30.460,1.837 L36.102,1.837 C38.302,1.837 40.923,2.617 40.923,5.478 C40.923,7.038 39.982,8.078 38.602,8.538 L38.602,8.578 C40.222,8.858 41.503,10.019 41.503,11.879 ZM35.441,4.558 L33.761,4.558 L33.761,7.478 L35.601,7.478 C36.882,7.478 37.622,6.938 37.622,5.938 C37.622,4.978 36.882,4.558 35.441,4.558 ZM35.661,9.999 L33.761,9.999 L33.761,13.239 L35.681,13.239 C36.762,13.239 38.082,12.939 38.082,11.559 C38.082,10.379 37.122,9.999 35.661,9.999 ZM18.188,17.576 C17.911,17.875 17.595,18.000 17.288,18.000 C16.278,18.000 15.365,16.647 16.272,15.668 L16.589,15.327 C15.259,15.233 13.979,14.896 12.796,14.130 C11.704,13.423 10.824,12.468 10.048,11.436 C9.776,11.074 9.516,10.703 9.264,10.329 C8.973,9.894 8.694,9.451 8.412,9.009 C7.819,8.078 7.214,7.157 6.446,6.352 C5.198,5.044 3.605,4.604 1.874,4.604 C1.689,4.604 1.503,4.609 1.315,4.619 C1.287,4.620 1.259,4.621 1.232,4.621 C-0.431,4.621 -0.395,2.008 1.315,1.921 C1.510,1.911 1.702,1.906 1.891,1.906 C5.500,1.906 8.028,3.695 10.049,6.581 C10.137,6.707 10.225,6.832 10.311,6.962 C10.762,7.641 11.187,8.336 11.640,9.009 C12.108,9.704 12.607,10.376 13.198,10.983 C14.237,12.051 15.422,12.490 16.721,12.614 C16.639,12.515 16.559,12.414 16.476,12.316 C16.001,11.754 15.921,10.962 16.476,10.408 C16.729,10.157 17.106,10.015 17.477,10.015 C17.822,10.015 18.162,10.137 18.391,10.408 C19.124,11.276 19.824,12.169 20.557,13.037 C21.034,13.515 21.217,14.309 20.626,14.946 L18.188,17.576 ZM18.391,7.609 C17.915,8.172 16.964,8.096 16.475,7.609 C15.921,7.056 16.001,6.264 16.475,5.702 C16.559,5.603 16.639,5.502 16.721,5.404 C15.421,5.528 14.237,5.967 13.198,7.035 C12.787,7.458 12.421,7.913 12.078,8.385 C11.891,8.101 11.705,7.812 11.517,7.518 C11.319,7.208 11.114,6.886 10.904,6.571 C10.774,6.374 10.641,6.185 10.508,5.999 C11.170,5.194 11.913,4.459 12.796,3.887 C13.979,3.122 15.259,2.785 16.589,2.691 L16.272,2.349 C15.090,1.073 17.001,-0.839 18.188,0.442 L20.626,3.072 C21.217,3.709 21.034,4.503 20.557,4.981 C19.824,5.848 19.124,6.742 18.391,7.609 ZM1.315,13.399 C3.261,13.497 5.064,13.113 6.446,11.665 C7.032,11.051 7.524,10.368 7.988,9.665 C8.210,10.013 8.438,10.371 8.673,10.722 C8.960,11.149 9.273,11.592 9.611,12.032 C7.554,14.709 4.971,16.281 1.315,16.096 C-0.423,16.008 -0.432,13.310 1.315,13.399 Z"/>
                            </svg>
                        </a>
                    </div>
                </div>
                <div class="col-sm-4">
                    <ul class="header-left">
                        <li>
                            <div class="onhover-dropdown">
                                <a> Trading <i class="fa fa-caret-down"></i></a>
                                <ul class="onhover-show-div">
                                    <li ondblclick="call_all_order('BTC')" onclick="call_all('BTC')"><img src="{{ url('/') }}/assets/themes/limitless/images/icon/btc.png" alt="">BTC</li>
                                    <li onclick="call_all('ETH')"><img src="{{ url('/') }}/assets/themes/limitless/images/icon/eth.png" alt="">ETH</li>
                                    <li onclick="call_all('LTC')"><img src="{{ url('/') }}/assets/themes/limitless/images/icon/ltc.png" alt="">LTC</li>
                                    <li onclick="call_all('XRP')"><img src="{{ url('/') }}/assets/themes/limitless/images/icon/xrp.png" alt="">XRP</li>
                                </ul>
                            </div>
                        </li>
                        <li class="onhover-dropdown">
                            <div class="onhover-dropdown">
                                <a class="mr-10"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="12px" height="16px">
                                        <path fill-rule="evenodd" fill="#fff" d="M11.999,13.902 C12.000,13.652 12.001,13.866 11.999,13.902 ZM11.999,14.194 C11.999,14.194 11.115,16.000 6.000,16.000 C0.884,16.000 0.001,14.194 0.001,14.194 C0.001,13.984 0.000,13.864 0.000,13.799 C0.001,13.834 0.004,13.818 0.009,13.519 C0.077,9.853 0.591,8.797 4.260,8.125 C4.260,8.125 4.783,8.800 6.000,8.800 C7.217,8.800 7.739,8.125 7.739,8.125 C11.449,8.804 11.933,9.877 11.992,13.641 C11.996,13.882 11.998,13.923 11.999,13.902 C11.999,13.966 11.999,14.060 11.999,14.194 ZM6.000,7.825 C4.245,7.825 2.823,6.073 2.823,3.913 C2.823,1.752 3.290,-0.000 6.000,-0.000 C8.709,-0.000 9.176,1.752 9.176,3.913 C9.176,6.073 7.754,7.825 6.000,7.825 Z"></path>
                                    </svg> My account <i class="fa fa-caret-down"></i></a>
                                <ul class="onhover-show-div">
                                    @if(Sentinel::check())
                                    <a href="{{url('logout')}}"><li class="text-primary"><i class="fa fa-sign-out mr-10"></i>Logout</li></a>
                                    @else
                                        <a href="{{url('login')}}"><li class="text-primary" ><i class="fa fa-sign-in mr-10"></i>Login</li></a>
                                        <a href="{{url('register')}}"><li class="text-primary"><i class="fa fa-plus-square-o mr-10"></i>Register</li></a>
                                    @endif
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>

                <div class="col-sm-6 text-right">
                    <ul class="header-right">
                        <li>
                            <form class="form-inline search-form">
                                <div class="form-group">
                                    <label class="sr-only">Email</label>
                                    <input type="search" class="form-control-plaintext" placeholder="Search..">
                                </div>
                            </form>
                        </li>
                        <li><button type="button" class="btn btn-xs btn-info theme-btn">Tour</button></li>
                    </ul>
                </div>
            </div>
<?php


     
//BTC
 $full_array = json_decode(file_get_contents('https://min-api.cryptocompare.com/data/pricemultifull?fsyms=BTC&tsyms=ETH,LTC,XRP,AED'));

         $eth_last_btc = $full_array->RAW->BTC->ETH->PRICE;
         $eth_vol_btc = $full_array->RAW->BTC->ETH->VOLUME24HOUR;
         $eth_24hr_btc = $full_array->RAW->BTC->ETH->CHANGE24HOUR;
         $eth_low_btc = $full_array->RAW->BTC->ETH->LOW24HOUR;
         $eth_high_btc = $full_array->RAW->BTC->ETH->HIGH24HOUR;

         $ltc_last_btc = $full_array->RAW->BTC->LTC->PRICE;
         $ltc_vol_btc = $full_array->RAW->BTC->LTC->VOLUME24HOUR;
         $ltc_24hr_btc = $full_array->RAW->BTC->LTC->CHANGE24HOUR;
         $ltc_low_btc = $full_array->RAW->BTC->LTC->LOW24HOUR;
         $ltc_high_btc = $full_array->RAW->BTC->LTC->HIGH24HOUR;

         $xrp_last_btc = $full_array->RAW->BTC->XRP->PRICE;
         $xrp_vol_btc = $full_array->RAW->BTC->XRP->VOLUME24HOUR;
         $xrp_24hr_btc = $full_array->RAW->BTC->XRP->CHANGE24HOUR;
         $xrp_low_btc = $full_array->RAW->BTC->XRP->LOW24HOUR;
         $xrp_high_btc = $full_array->RAW->BTC->XRP->HIGH24HOUR;

         $aud_last_btc = $full_array->RAW->BTC->AED->PRICE;
         $aud_vol_btc = $full_array->RAW->BTC->AED->VOLUME24HOUR;
         $aud_24hr_btc = $full_array->RAW->BTC->AED->CHANGE24HOUR;
         $aud_low_btc = $full_array->RAW->BTC->AED->LOW24HOUR;
         $aud_high_btc = $full_array->RAW->BTC->AED->HIGH24HOUR;

       //  echo $xrp_last_btc.'||||'.$xrp_vol_btc.'||||'.$xrp_24hr_btc.'||||'.$xrp_high_btc;


         //LTC
         $full_array_ltc = json_decode(file_get_contents('https://min-api.cryptocompare.com/data/pricemultifull?fsyms=LTC&tsyms=ETH,BTC,XRP,AED'));

         $eth_last_ltc = $full_array_ltc->RAW->LTC->ETH->PRICE;
         $eth_vol_ltc = $full_array_ltc->RAW->LTC->ETH->VOLUME24HOUR;
         $eth_24hr_ltc = $full_array_ltc->RAW->LTC->ETH->CHANGE24HOUR;
         $eth_low_ltc = $full_array_ltc->RAW->LTC->ETH->LOW24HOUR;
         $eth_high_ltc = $full_array_ltc->RAW->LTC->ETH->HIGH24HOUR;

         $btc_last_ltc = $full_array_ltc->RAW->LTC->BTC->PRICE;
         $btc_vol_ltc = $full_array_ltc->RAW->LTC->BTC->VOLUME24HOUR;
         $btc_24hr_ltc = $full_array_ltc->RAW->LTC->BTC->CHANGE24HOUR;
         $btc_low_ltc = $full_array_ltc->RAW->LTC->BTC->LOW24HOUR;
         $btc_high_ltc = $full_array_ltc->RAW->LTC->BTC->HIGH24HOUR;

         $xrp_last_ltc = $full_array_ltc->RAW->LTC->XRP->PRICE;
         $xrp_vol_ltc = $full_array_ltc->RAW->LTC->XRP->VOLUME24HOUR;
         $xrp_24hr_ltc = $full_array_ltc->RAW->LTC->XRP->CHANGE24HOUR;
         $xrp_low_ltc = $full_array_ltc->RAW->LTC->XRP->LOW24HOUR;
         $xrp_high_ltc = $full_array_ltc->RAW->LTC->XRP->HIGH24HOUR;

         $aud_last_ltc = $full_array_ltc->RAW->LTC->AED->PRICE;
         $aud_vol_ltc = $full_array_ltc->RAW->LTC->AED->VOLUME24HOUR;
         $aud_24hr_ltc = $full_array_ltc->RAW->LTC->AED->CHANGE24HOUR;
         $aud_low_ltc = $full_array_ltc->RAW->LTC->AED->LOW24HOUR;
         $aud_high_ltc = $full_array_ltc->RAW->LTC->AED->HIGH24HOUR;


        $full_array_xrp = json_decode(file_get_contents('https://min-api.cryptocompare.com/data/pricemultifull?fsyms=XRP&tsyms=ETH,BTC,LTC,AED'));

         $eth_last_xrp = $full_array_xrp->RAW->XRP->ETH->PRICE;
         $eth_vol_xrp = $full_array_xrp->RAW->XRP->ETH->VOLUME24HOUR;
         $eth_24hr_xrp = $full_array_xrp->RAW->XRP->ETH->CHANGE24HOUR;
         $eth_low_xrp = $full_array_xrp->RAW->XRP->ETH->LOW24HOUR;
         $eth_high_xrp = $full_array_xrp->RAW->XRP->ETH->HIGH24HOUR;

         $btc_last_xrp = $full_array_xrp->RAW->XRP->BTC->PRICE;
         $btc_vol_xrp = $full_array_xrp->RAW->XRP->BTC->VOLUME24HOUR;
         $btc_24hr_xrp = $full_array_xrp->RAW->XRP->BTC->CHANGE24HOUR;
         $btc_low_xrp = $full_array_xrp->RAW->XRP->BTC->LOW24HOUR;
         $btc_high_xrp = $full_array_xrp->RAW->XRP->BTC->HIGH24HOUR;

         $ltc_last_xrp = $full_array_xrp->RAW->XRP->LTC->PRICE;
         $ltc_vol_xrp = $full_array_xrp->RAW->XRP->LTC->VOLUME24HOUR;
         $ltc_24hr_xrp = $full_array_xrp->RAW->XRP->LTC->CHANGE24HOUR;
         $ltc_low_xrp = $full_array_xrp->RAW->XRP->LTC->LOW24HOUR;
         $ltc_high_xrp = $full_array_xrp->RAW->XRP->LTC->HIGH24HOUR;

         $aud_last_xrp = $full_array_xrp->RAW->XRP->AED->PRICE;
         $aud_vol_xrp = $full_array_xrp->RAW->XRP->AED->VOLUME24HOUR;
         $aud_24hr_xrp = $full_array_xrp->RAW->XRP->AED->CHANGE24HOUR;
         $aud_low_xrp = $full_array_xrp->RAW->XRP->AED->LOW24HOUR;
         $aud_high_xrp = $full_array_xrp->RAW->XRP->AED->HIGH24HOUR;

         $full_array_eth = json_decode(file_get_contents('https://min-api.cryptocompare.com/data/pricemultifull?fsyms=ETH&tsyms=XRP,BTC,LTC,AED'));

         $xrp_last_eth = $full_array_eth->RAW->ETH->XRP->PRICE;
         $xrp_vol_eth = $full_array_eth->RAW->ETH->XRP->VOLUME24HOUR;
         $xrp_24hr_eth = $full_array_eth->RAW->ETH->XRP->CHANGE24HOUR;
         $xrp_low_eth = $full_array_eth->RAW->ETH->XRP->LOW24HOUR;
         $xrp_high_eth = $full_array_eth->RAW->ETH->XRP->HIGH24HOUR;

         $btc_last_eth = $full_array_eth->RAW->ETH->BTC->PRICE;
         $btc_vol_eth = $full_array_eth->RAW->ETH->BTC->VOLUME24HOUR;
         $btc_24hr_eth = $full_array_eth->RAW->ETH->BTC->CHANGE24HOUR;
         $btc_low_eth = $full_array_eth->RAW->ETH->BTC->LOW24HOUR;
         $btc_high_eth = $full_array_eth->RAW->ETH->BTC->HIGH24HOUR;

         $ltc_last_eth = $full_array_eth->RAW->ETH->LTC->PRICE;
         $ltc_vol_eth = $full_array_eth->RAW->ETH->LTC->VOLUME24HOUR;
         $ltc_24hr_eth = $full_array_eth->RAW->ETH->LTC->CHANGE24HOUR;
         $ltc_low_eth = $full_array_eth->RAW->ETH->LTC->LOW24HOUR;
         $ltc_high_eth = $full_array_eth->RAW->ETH->LTC->HIGH24HOUR;

         $aud_last_eth = $full_array_eth->RAW->ETH->AED->PRICE;
         $aud_vol_eth = $full_array_eth->RAW->ETH->AED->VOLUME24HOUR;
         $aud_24hr_eth = $full_array_eth->RAW->ETH->AED->CHANGE24HOUR;
         $aud_low_eth = $full_array_eth->RAW->ETH->AED->LOW24HOUR;
         $aud_high_eth = $full_array_eth->RAW->ETH->AED->HIGH24HOUR;

         //Get AED basic price
    $basic_price = json_decode(file_get_contents('https://min-api.cryptocompare.com/data/pricemultifull?fsyms=USD&tsyms=AED,BTC,LTC,ETH,XRP'));

         $basic = $basic_price->RAW->USD->AED->PRICE;
      //   $volume = $basic_price->RAW->USD->AED->VOLUME24HOUR;
         $chnage_24 = $basic_price->RAW->USD->AED->CHANGE24HOUR;
         $low = $basic_price->RAW->USD->AED->LOW24HOUR;
         $high = $basic_price->RAW->USD->AED->HIGH24HOUR;

         $price_aed = 1/$basic;
       //  $volume_aed = 1/$volume;
         $chnage_aed = 1/$chnage_24;
         $low_aed = 1/$low;
         $high_aed = 1/$high;

         $btc_last_aed = ($basic_price->RAW->USD->BTC->PRICE)/$price_aed;
         $btc_24hr_aed = ($basic_price->RAW->USD->BTC->CHANGE24HOUR)/$chnage_aed;
         $btc_low_aed = ($basic_price->RAW->USD->BTC->LOW24HOUR)/$low_aed;
         $btc_high_aed = ($basic_price->RAW->USD->BTC->HIGH24HOUR)/$high_aed;

         $ltc_last_aed = ($basic_price->RAW->USD->LTC->PRICE)/$price_aed;
         $ltc_24hr_aed = ($basic_price->RAW->USD->LTC->CHANGE24HOUR)/$chnage_aed;
         $ltc_low_aed = ($basic_price->RAW->USD->LTC->LOW24HOUR)/$low_aed;
         $ltc_high_aed = ($basic_price->RAW->USD->LTC->HIGH24HOUR)/$high_aed;

         $xrp_last_aed = ($basic_price->RAW->USD->XRP->PRICE)/$price_aed;
         $xrp_24hr_aed = ($basic_price->RAW->USD->XRP->CHANGE24HOUR)/$chnage_aed;
         $xrp_low_aed = ($basic_price->RAW->USD->XRP->LOW24HOUR)/$low_aed;
         $xrp_high_aed = ($basic_price->RAW->USD->XRP->HIGH24HOUR)/$high_aed;

         $eth_last_aed = ($basic_price->RAW->USD->ETH->PRICE)/$price_aed;
         $eth_24hr_aed = ($basic_price->RAW->USD->ETH->CHANGE24HOUR)/$chnage_aed;
         $eth_low_aed = ($basic_price->RAW->USD->ETH->LOW24HOUR)/$low_aed;
         $eth_high_aed = ($basic_price->RAW->USD->ETH->HIGH24HOUR)/$high_aed;

?>

<?php 

    $eth_balance = 0;
    $btc_balance = 0;
    $aed_balance = 0;
    $xrp_balance = 0;
    $ltc_balance = 0;

   foreach($trade_cur as $key_trade)
   {
    if($key_trade->trade_currency_id==1) { $eth_balance =$key_trade->balance; }  
    else if($key_trade->trade_currency_id==2) { $xrp_balance =$key_trade->balance; }  
    else if($key_trade->trade_currency_id==3) { $aed_balance =$key_trade->balance; }  
    else if($key_trade->trade_currency_id==4) { $btc_balance =$key_trade->balance; }  
    else if($key_trade->trade_currency_id==5) { $ltc_balance =$key_trade->balance; }  
    else {  }
   }
  ?>

            <div class="dashboard-main">
                <div class="dashboard-sidebar">
                    {{--Top Widget Start--}}
                    <div class="theme-widget rate-widget">
                        <div class="media" style="height: 70px">
                            <div class="media-left  media-middle" id="image_change">
                                    <img  src="{{ url('/')  }}/assets/themes/limitless/images/icon/btc.png" alt="">
                            </div>
                                 <div class="media-body text-center">
                                    <div class="txt-xl" id="coin_name">BTC/AED</div>
                                    <div class="text-muted">VOLUME <span class="txt-dark" id="coin_volume">28,558 BTC</span> </div>
                                    <div class="text-muted">LOW <span class="txt-dark" id="coin_low">8,121.7</span></div>
                                </div>
                                <div class="media-body text-center">
                                    <div class="txt-xl" id="coin_price">8,287.2</div>
                                    <div class="text-muted up" id="coin_24hr"> 0.73 %</div>
                                    <div class="text-muted">HIGH <span class="txt-dark" id="coin_high">8,482.2</span></div>
                                </div>
                        </div>
                    </div>
                    {{--Top Widget Start--}}

                    {{--Tickers widget start--}}
                    <div class="theme-widget tickers-widget open">
                        <div class="widget-header acr">
                            <h5> <i class="fa fa-chevron-right" aria-hidden="true"></i>Tickers</h5>
                        </div>
                        <div class="widget-body">
                          <div class="table-responsive">
                            <table width="100%" class="theme-tbl">
                                <thead>
                                <tr>
                                    <th>Symbol</th>
                                    <th>Last</th>
                                    <th>24Hr</th>
                                    <th>Volume</th>
                                </tr>
                                </thead>

                    <tbody>
                         <tr onmouseover="call_eth_btc()" id="call_eth_btc">
                            <th scope="row"  rowspan="4"> <img src="{{ url('/') }}/assets/themes/limitless/images/icon/btc.png" /><br> BTC</th>
                            <td><?php  echo number_format($eth_last_btc,2); ?><span>ETH</span></td>
                            <td><span class="up"><?php  echo number_format($eth_24hr_btc,2); ?>%</span></td>
                            <td><?php  echo number_format($eth_vol_btc,2); ?></td>
                        </tr>
                         <tr  onmouseover="call_xrp_btc()">
                            <td><?php  echo number_format($xrp_last_btc,2); ?><span>XRP</span></td>
                            <td><span class="up"><?php  echo number_format($xrp_24hr_btc,2); ?>%</span></td>
                            <td><?php  echo number_format($xrp_vol_btc,2); ?></td>
                        </tr> 

                        <tr  onmouseover="call_ltc_btc()">
                            <td><?php  echo number_format($ltc_last_btc,2); ?><span>LTC</span></td>
                            <td><span class="up"><?php  echo number_format($ltc_24hr_btc,2); ?>%</span></td>
                            <td><?php  echo number_format($ltc_vol_btc,2); ?></td>
                        </tr>
                        <tr  onmouseover="call_aed_btc()">
                            <td><?php  echo number_format($aud_last_btc,2); ?><span>AED</span></td>
                            <td><span class="up"><?php  echo number_format($aud_24hr_btc,2); ?>%</span></td>
                            <td><?php  echo number_format($aud_vol_btc,2); ?></td>
                        </tr> 
                    </tbody>

                      <tbody>
                        <tr onmouseover="call_eth_ltc()" >
                            <th scope="row"  rowspan="4"> <img src="{{ url('/') }}/assets/themes/limitless/images/icon/ltc.png" /><br> LTC</th>
                            <td><?php  echo number_format($eth_last_ltc,2); ?><span>ETH</span></td>
                            <td><span class="up"><?php  echo number_format($eth_24hr_ltc,2); ?>%</span></td>
                            <td><?php  echo number_format($eth_vol_ltc,2); ?></td>
                        </tr>
                        <tr  onmouseover="call_btc_ltc()" >
                            <td><?php  echo number_format($btc_last_ltc,2); ?><span>BTC</span></td>
                            <td><span class="up"><?php  echo number_format($btc_24hr_ltc,2); ?>%</span></td>
                            <td><?php  echo number_format($btc_vol_ltc,2); ?></td>
                        </tr>
                        <tr  onmouseover="call_xrp_ltc()" >
                            <td><?php  echo number_format($xrp_last_ltc,2); ?><span>XRP</span></td>
                            <td><span class="up"><?php  echo number_format($xrp_24hr_ltc,2); ?>%</span></td>
                            <td><?php  echo number_format($xrp_vol_ltc,2); ?></td>
                        </tr>
                        <tr  onmouseover="call_aed_ltc()" >
                            <td><?php  echo number_format($aud_last_ltc,2); ?><span>AED</span></td>
                            <td><span class="up"><?php  echo number_format($aud_24hr_ltc,2); ?>%</span></td>
                            <td><?php  echo number_format($aud_vol_ltc,2); ?></td>
                        </tr> 
                    </tbody>

                       <tbody>
                        <tr onmouseover="call_eth_xrp()" >
                            <th scope="row"  rowspan="4"> <img src="{{ url('/') }}/assets/themes/limitless/images/icon/xrp.png" /><br> XRP</th>
                            <td><?php  echo number_format($eth_last_xrp,2); ?><span>ETH</span></td>
                            <td><span class="up"><?php  echo number_format($eth_24hr_xrp,2); ?>%</span></td>
                            <td><?php  echo number_format($eth_vol_xrp,2); ?></td>
                        </tr>
                        <tr  onmouseover="call_ltc_xrp()" >
                            <td><?php  echo number_format($ltc_last_xrp,2); ?><span>LTC</span></td>
                            <td><span class="up"><?php  echo number_format($ltc_24hr_xrp,2); ?>%</span></td>
                            <td><?php  echo number_format($ltc_vol_xrp,2); ?></td>
                        </tr>
                        <tr  onmouseover="call_btc_xrp()" >
                            <td><?php  echo number_format($btc_last_xrp,2); ?><span>BTC</span></td>
                            <td><span class="up"><?php  echo number_format($btc_24hr_xrp,2); ?>%</span></td>
                            <td><?php  echo number_format($btc_vol_xrp,2); ?></td>
                        </tr>
                        <tr  onmouseover="call_aed_xrp()" >
                            <td><?php  echo number_format($aud_last_xrp,2); ?><span>AED</span></td>
                            <td><span class="up"><?php  echo number_format($aud_24hr_xrp,2); ?>%</span></td>
                            <td><?php  echo number_format($aud_vol_xrp,2); ?></td>
                        </tr> 
                    </tbody>

                     <tbody>
                        <tr onmouseover="call_xrp_eth()" >
                            <th scope="row"  rowspan="4"> <img src="{{ url('/') }}/assets/themes/limitless/images/icon/eth.png" /><br> ETH</th>
                            <td><?php  echo number_format($xrp_last_eth,2); ?><span>XRP</span></td>
                            <td><span class="up"><?php  echo number_format($xrp_24hr_eth,2); ?>%</span></td>
                            <td><?php  echo number_format($xrp_vol_eth,2); ?></td>
                        </tr>
                        <tr  onmouseover="call_ltc_eth()" >
                            <td><?php  echo number_format($ltc_last_eth,2); ?><span>LTC</span></td>
                            <td><span class="up"><?php  echo number_format($ltc_24hr_eth,2); ?>%</span></td>
                            <td><?php  echo number_format($ltc_vol_eth,2); ?></td>
                        </tr>
                        <tr  onmouseover="call_btc_eth()" >
                            <td><?php  echo number_format($btc_last_eth,2); ?><span>BTC</span></td>
                            <td><span class="up"><?php  echo number_format($btc_24hr_eth,2); ?>%</span></td>
                            <td><?php  echo number_format($btc_vol_eth,2); ?></td>
                        </tr>
                        <tr  onmouseover="call_aed_eth()" >
                            <td><?php  echo number_format($aud_last_eth,2); ?><span>AED</span></td>
                            <td><span class="up"><?php  echo number_format($aud_24hr_eth,2); ?>%</span></td>
                            <td><?php  echo number_format($aud_vol_eth,2); ?></td>
                        </tr> 
                    </tbody>

                <!--         <tbody>
                        <tr onmouseover="call_eth_aed()">
                            <th scope="row"  rowspan="4"> <img src="{{ url('/') }}/assets/themes/limitless/images/icon/aed.png" /><br> AED</th>
                            <td><?php  echo number_format($eth_last_aed,2); ?><span>ETH</span></td>
                            <td><span class="up"><?php  echo number_format($eth_24hr_aed,2); ?>%</span></td>
                            <td>-</td>
                        </tr>
                        <tr  onmouseover="call_ltc_aed()">
                            <td><?php  echo number_format($ltc_last_aed,2); ?><span>LTC</span></td>
                            <td><span class="up"><?php  echo number_format($ltc_24hr_aed,2); ?>%</span></td>
                            <td>-</td>
                        </tr>
                        <tr  onmouseover="call_btc_aed()">
                            <td><?php  echo number_format($btc_last_aed,2); ?><span>BTC</span></td>
                            <td><span class="up"><?php  echo number_format($btc_24hr_aed,2); ?>%</span></td>
                            <td>-</td>
                        </tr>

                        <tr  onmouseover="call_xrp_aed()">
                            <td><?php  echo number_format($xrp_last_aed,2); ?><span>XRP</span></td>
                            <td><span class="up"><?php  echo number_format($xrp_24hr_aed,2); ?>%</span></td>
                            <td>-</td>
                        </tr> 

                    </tbody> -->

                            </table>
                            </div>
                        </div>
                    </div>
                    {{--Tickers widget ends--}}

                    {{--Order Form widget start--}}
                    <div class="theme-widget order-widget open">
                        <div class="widget-header  acr">
                            <h5> <i class="fa fa-chevron-right" aria-hidden="true"></i>Order Form</h5>
                        </div>
                        <div id="message"></div>
                        
                        <div class="widget-body" style="padding: 5px;">
                            <form class="form-sm">
                                <div class="row" style="margin-bottom: 8px;">
                                    <div>
                                        <select id="order_type" name="order_type" class="form-control cust_fld">
                                            <option value="exchange market" active>Exchange Market</option>
                                            <option value="trailing-stop">Trelling Stop</option>
                                            <option value="limit">Limits</option>
                                            <option value="market">Market</option>
                                            <option value="stop">Stop</option>
                                            <option value="fill-or-kill">Fill Or Kill</option>
                                        </select>
                                    </div>
                                    <div>
                                    </div>
                                </div>

                                <input type="hidden" name="coin_use" id="coin_use" value="BTC">

                                <div class="row d-flex">
                                    <div>
                                        <div class="input-group">
                                            <label> Amount AED</label> <span id="approx_usd" style="float: right;"> ≈ 0 </span>
                                            <input type="text" class="form-control cust_fld" onkeyup="calculate_price()" name="usd_amount" id="usd_amount" aria-describedby="sizing-addon1">
                                        </div>
                                  </div>
                                    <div>
                                        <div class="input-group">
                                            <label id="coinname"> AMOUNT BTC</label>
                                            <input type="text" name="coin_amount" id="coin_amount"  onkeyup="calculate_price()" class="form-control cust_fld"  aria-describedby="sizing-addon1">
                                        </div>
                                    </div>
                                </div>
                                <div class="row d-flex">
                                    <div>
                                        <div class="input-group">
                                            <label> Fees On <b>AED</b> </label>
                                            <input type="text" class="form-control cust_fld" id="buy_fees" aria-describedby="sizing-addon1">
                                        </div>
                                    </div>
                                    <div>
                                        <div class="input-group">
                                           <label> Fees On <b>AED</b></label>
                                            <input type="text"  id="sell_fees"  class="form-control cust_fld"  aria-describedby="sizing-addon1">
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" id="buy_fees_per" name="" value="{{ $buy_fees  }}">
                                <input type="hidden" id="sell_fees_per" name="" value="{{ $sell_fees  }}">
                                <input type="hidden" id="final_aed" name="" value="0">

                                <div class="row d-flex">
                                    <div>
                                        <label style="color: green;">Pay :<span  id="pay_div">0</span> </label><br>
                                        <label style="color: green;">Buy Fees : <b >{{ $buy_fees }}%</b></label>
                                        <button id="buy_button" type="button" onclick="create_exchange('buy')" class="btn btn-success btn-sm btn-block">Exchange Buy</button>
                                    </div>
                                    <div>
                                        <label style="color: green;">Receive :<span  id="rec_div">0</span></label><br>
                                        <label style="color: green;">Sell Fees: <b>{{ $sell_fees }}%</b></span></label>
                                        <button id="sell_button" type="button" onclick="create_exchange('sell')" class="btn btn-danger btn-sm btn-block">Exchange Sell</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    {{--Order Form widget ends--}}

                    {{--Balance Form widget start--}}
                    <div class="theme-widget balance-widget open">
                        <div class="widget-header acr">
                            <h5> <i class="fa fa-chevron-right" aria-hidden="true"></i>Balances</h5>
                        </div>
                        <div class="widget-body ">
                          <div class="table-responsive">
                            <table class="theme-tbl" width="100%">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th>Exchange</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <th scope="row">  <img src="{{ url('/')  }}/assets/themes/limitless/images/icon/btc.png" alt=""> BTC</th>
                                    <td><?php echo number_format($btc_balance,4); ?></td>
                                </tr>
                                </tbody>
                                <tbody>
                                <tr>
                                    <th scope="row">  <img src="{{ url('/')  }}/assets/themes/limitless/images/icon/eth.png" alt=""> ETH</th>
                                    <td><?php echo number_format($eth_balance,4); ?></td>
                                </tr>
                                </tbody>
                                <tbody>
                                <tr>
                                    <th scope="row">  <img src="{{ url('/')  }}/assets/themes/limitless/images/icon/xrp.png" alt=""> XRP</th>
                                    <td><?php echo number_format($xrp_balance,4); ?></td>
                                </tr>
                                </tbody>
                                <tbody class="last">
                                <tr>
                                    <th scope="row">  <img src="{{ url('/')  }}/assets/themes/limitless/images/icon/ltc.png" alt=""> LTC</th>
                                    <td><?php echo number_format($ltc_balance,4); ?></td>
                                </tr>
                                </tbody>
                               
                            </table>
                           </div>
                        </div>
                    </div>
                    {{--Balance Form widget ends--}}

                </div>
                <div class="dashboard-body">
                    <div class="">
                        <div class="row">
                            <div class="col-sm-12">

                                {{--Candal stick chart start--}}
                                <div class="theme-widget balance-widget ">
                                    <div class="widget-header acr">
                                        <h5> <i class="fa fa-chevron-right" aria-hidden="true"></i>CHART <span id="slash_coin">BTC/AED</span></h5>
                                    </div>
                                    <div class="widget-body">
                                        <div class="chart-div">

                                                          <section class="market-depth-sec">
                                                                    <div class="container">
                                                                      <div class="row">
                                                                        <div class="col-lg-12">
                                                                          <div class="market-depth-content">
                                                                            <div id="chartcontainer" ></div>
                                                                              <div id="loader" align="center">
                                                                                <img src="{{ URL::asset('loading.gif') }}">
                                                                              </div>
                                                                          </div>
                                                                        </div>
                                                                      </div>
                                                                    </div>
                                                                  </section>
                                                                  <input type="hidden" id="coin" value="">
                                                                  <input type="hidden" id="currency" value="">

                                        </div>
                                    </div>
                                </div>

                                <div class="theme-widget balance-widget ">
                                    <div class="widget-header acr">
                                        <h5> <i class="fa fa-chevron-right" aria-hidden="true"></i>Positions(0)</h5>
                                    </div>
                                    <div class="widget-body">
                                        <div class="">
                                        </div>
                                    </div>
                                </div>

                                <div class="theme-widget balance-widget open">
                                    <div class="widget-header acr">
                                        <h5> <i class="fa fa-chevron-right" aria-hidden="true"></i>Order </h5>
                                         <span style="float: right;margin-top: -25px;">   
                                            <button onclick="order_middle('bid')" class="btn btn-sm btn-default">Bid</button>
                                             <button onclick="order_middle('ask')"  class="btn btn-sm btn-default">Ask</button>
                                                <select id="both_side" onchange="call_order(this.value)">
                                                    <option value="ALL">All</option>
                                                    <option value="BTC">BTC/AED</option>
                                                    <option value="LTC">LTC/AED</option>
                                                    <option value="ETH">ETH/AED</option>
                                                    <option value="XRP">XRP/AED</option>
                                                </select>
                                        </span>
                                    </div>


                                    <div class="widget-body">
                                        <div class="table-responsive">
                                            <table id="order-tbl" class="display" style="width:100%">
                                            <thead>
                                            <tr>
                                                <th>Side</th>
                                                <th>order_id</th>
                                                <th>Pair</th>
                                                <th>Price</th>
                                                <th>Amount</th>
                                                <th>original amount</th>
                                                <th>remaining amount</th>
                                                <th>Status</th>
                                            </tr>
                                            </thead>
                                            <tbody id="order_middle">
                                                  @foreach($exchange_data as $exg)
                                                  @if($exg->status == 0 || $exg->status == 2)
                                                    <?php  if($exg->side == 'buy') { $color='#fbe9e7'; }
                                                                elseif($exg->side == 'sell') {  $color='#e8f5e9'; }
                                                                else {}  ?>
                                                         <?php $total = ($exg->price) * ($exg->same_price);  ?>
                                                           <tr onclick="order_tr_call(1,'{{$exg->price}}','{{$total}}','{{$exg->same_price}}')" style="background-color: <?php echo $color; ?>">
                                                                <td><b>{{ $exg->side}}</b></td>
                                                                <td>{{ $exg->order_id }}</td>
                                                                <td>{{ $exg->coin }}</td>
                                                                <td>{{ number_format($exg->same_price, 2) }}</td>
                                                                <td>{{ number_format($exg->price, 2) }}</td>
                                                                <td>{{ number_format($exg->original_amount, 2) }}</td>
                                                                <td>{{ number_format($exg->remaining_amount, 2) }}</td>
                                                               <td>
                                                                   @if($exg->status == 0)
                                                                   <label class="label label-warning"> Pending </label>
                                                                   @elseif($exg->status == 2)
                                                                   <label class="label label-info"> Partially Pay </label>
                                                                   @else
                                                                   @endif
                                                               </td>
                                                            </tr>
                                                       @else
                                                       @endif
                                                    @endforeach
                                            </tbody>
                                        </table>
                                     </div>
                                    </div>
                                </div>

                                <div class="theme-widget open">
                                    <div class="widget-header acr">
                                        <h5> <i class="fa fa-chevron-right" aria-hidden="true"></i>Order history(0)</h5>

                                         <span style="float: right;margin-top: -25px;"> 
                                            <button onclick="order_full('bid')" class="btn btn-sm btn-default">Bid</button>
                                             <button onclick="order_full('ask')"  class="btn btn-sm btn-default">Ask</button>
                                                <select onchange="call_order_full(this.value)">
                                                    <option value="ALL">All</option>
                                                    <option value="BTC">BTC/AED</option>
                                                    <option value="LTC">LTC/AED</option>
                                                    <option value="ETH">ETH/AED</option>
                                                    <option value="XRP">XRP/AED</option>
                                                </select>
                                        </span>

                                    </div>
                                    <div class="widget-body">
                                        <table id="order-his-tbl" class="display" style="width:100%">
                                            <thead>
                                            <tr>
                                                <th>Side</th>
                                                <th>order_id</th>
                                                <th>Pair</th>
                                                <th>Price</th>
                                                <th>Amount</th>
                                                <th>original amount</th>
                                                <th>remaining amount</th>
                                                <th>Status</th>
                                            </tr>
                                            </thead>
                                            <tbody id="order_full">
                                                  @foreach($exchange_data as $exg)
                                                  @if($exg->status == 3 || $exg->status == 1)
                                                  <?php  if($exg->side == 'buy') { $color='#fbe9e7'; }
                                                                elseif($exg->side == 'sell') {  $color='#e8f5e9'; }
                                                                else {}  ?>
                                                         <?php $total = ($exg->price) * ($exg->same_price);  ?>
                                                           <tr onclick="order_tr_call(1,'{{$exg->price}}','{{$total}}','{{$exg->same_price}}')" style="background-color: <?php echo $color; ?>">
                                                                <td><b>{{ $exg->side}}</b></td>
                                                                <td>{{ $exg->order_id }}</td>
                                                                <td>{{ $exg->coin }}</td>
                                                                <td>{{ number_format($exg->same_price, 2) }}</td>
                                                                <td>{{ number_format($exg->price, 2) }}</td>
                                                                <td>{{ number_format($exg->original_amount, 2) }}</td>
                                                                <td>{{ number_format($exg->remaining_amount, 2) }}</td>
                                                               <td>
                                                                   @if($exg->status == 1)
                                                                   <label class="label label-success"> Seccess </label>
                                                                   @elseif($exg->status == 3)
                                                                   <label class="label label-danger"> Cancel </label>
                                                                   @else
                                                                   @endif
                                                               </td>
                                                            </tr>
                                                       @else
                                                       @endif
                                                    @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-lg-8">
                                <div class="theme-widget balance-widget  open">
                                    <div class="widget-header acr">
                                        <h5> <i class="fa fa-chevron-right" aria-hidden="true"></i>Order Book <span class="text-muted" id="order_coin">BTC/AED</span></h5>
                                    </div>
                                    <div class="widget-body">
                                        <div class="d-flex-tbl">
                                            <div class="w-50">
                                             <div class="table-responsive">
                                                <table  class="theme-dt bg-danger" style="width:100%">
                                                    <thead>
                                                    <tr>
                                                        <th>Count</th>
                                                        <th>Amount</th>
                                                        <th>Total</th>
                                                        <th>Price</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($exchange_data as $exg)
                                                        @if($exg->side == 'buy')
                                                         <?php $total = ($exg->price) * ($exg->same_price);  ?>
                                                           <tr onclick="order_tr_call(1,'{{$exg->price}}','{{$total}}','{{$exg->same_price}}')">
                                                                <td>1</td>
                                                                <td>{{ number_format($exg->price, 2) }}</td>
                                                                <td>{{ number_format($total, 2) }}</td>
                                                                <td>{{ number_format($exg->same_price, 2) }}</td>
                                                            </tr>
                                                        @else
                                                        @endif
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                               </div>
                                            </div>
                                            <div class="w-50">
                                              <div class="table-responsive">
                                                <table class="theme-dt bg-success" style="width:100%">
                                                    <thead>
                                                    <tr>
                                                        <th>Amount</th>
                                                        <th>Total</th>
                                                        <th>Price</th>
                                                        <th>Count</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($exchange_data as $exg)
                                                        @if($exg->side == 'sell')
                                                        <?php $total = ($exg->price) * ($exg->same_price);  ?>
                                                           <tr onclick="order_tr_call(1,'{{$exg->price}}','{{$total}}','{{$exg->same_price}}')">
                                                                <td>{{ number_format($exg->same_price, 2) }}</td>
                                                                <td>{{ number_format($total, 2) }}</td>
                                                                <td>{{ number_format($exg->price, 2) }}</td>
                                                                 <td>1</td>
                                                            </tr>
                                                        @else
                                                        @endif
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="full-book mt-10">
                                        <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModal">Full Book</button>
                                        </div>
                                        <!-- Modal -->
                                        <div id="myModal" class="modal fade" role="dialog" >
                                            <div class="modal-dialog modal-lg">
                                                <!-- Modal content-->
                                                <div class="modal-content theme-contant">
                                                     <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <h4 class="modal-title">Order Full History</h4>
                                                      </div>
                                                 <div class="table-responsive">
                                                    <table  class="theme-dt" id="order-tbl" style="width:100%">
                                                     <thead>
                                                        <tr>
                                                            <th>Side</th>
                                                            <th>order_id</th>
                                                            <th>Pair</th>   
                                                            <th>Price</th>
                                                            <th>Amount</th>
                                                            <th>original_amount</th>
                                                            <th>remaining_amount</th>
                                                            <th>Status</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody id="order_middle">
                                                              @foreach($exchange_data as $exg)
                                                              <?php  if($exg->side == 'buy') { $color='#fbe9e7'; }
                                                                elseif($exg->side == 'sell') {  $color='#e8f5e9'; }
                                                                else {}  ?>
                                                                     <?php $total = ($exg->price) * ($exg->same_price);  ?>
                                                                       <tr onclick="order_tr_call(1,'{{$exg->price}}','{{$total}}','{{$exg->same_price}}')" style="background-color: <?php echo $color; ?>">
                                                                            <td><b>{{ $exg->side}}</b></td>
                                                                            <td>{{ $exg->order_id }}</td>
                                                                            <td>{{ $exg->coin }}</td>
                                                                            <td>{{ number_format($exg->same_price, 2) }}</td>
                                                                            <td>{{ number_format($exg->price, 2) }}</td>
                                                                            <td>{{ number_format($exg->original_amount, 2) }}</td>
                                                                            <td>{{ number_format($exg->remaining_amount, 2) }}</td>
                                                                           <td>
                                                                               @if($exg->status == 0)
                                                                               <label class="label label-warning"> Pending </label>
                                                                               @elseif($exg->status == 2)
                                                                               <label class="label label-info"> Partially Pay </label>
                                                                                @elseif($exg->status == 3)
                                                                               <label class="label label-danger"> Cancel </label>
                                                                                @elseif($exg->status == 1)
                                                                               <label class="label label-success"> Success </label>
                                                                               @else
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
                                </div>

                            <div class="col-xs-12 col-lg-4">
                                <div class="theme-widget balance-widget open">
                                    <div class="widget-header acr">
                                        <h5> <i class="fa fa-chevron-right" aria-hidden="true"></i>Trades Block <span class="text-muted">ETH/GBP</span></h5>
                                    </div>
                                    <div class="widget-body">
                                      <div class="table-responsive">
                                        <table class="display theme-dt" style="width:100%">
                                            <thead>
                                            <tr>
                                                <th>Status</th>
                                                <th>Time</th>
                                                <th>Price</th>
                                                <th>Amount</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr class="value-up">
                                                <td><i class="fa fa-chevron-up" aria-hidden="true"></i></td>
                                                <td>07:33:08</td>
                                                <td>8,111.5</td>
                                                <td>0.0100</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                      </div>
                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<footer>
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-sm-3">
                <h4 class="footer-title">Features</h4>
                <ul class="footer-links">
                    <li><a href="#" ><i class="fa fa-angle-double-right"></i>Trading</a></li>
                    <li><a href="#" ><i class="fa fa-angle-double-right"></i>Funding</a></li>
                    <li><a href="#" ><i class="fa fa-angle-double-right"></i>Deposite</a></li>
                    <li><a href="#" ><i class="fa fa-angle-double-right"></i>Withdrow</a></li>
                    <li><a href="#" ><i class="fa fa-angle-double-right"></i>Manage Wallet</a></li>
                </ul>
            </div>
            <div class="col-xs-6 col-sm-3">
                <h4 class="footer-title">Support</h4>
                <ul class="footer-links">
                    <li><a href="#" ><i class="fa fa-angle-double-right"></i>Trading</a></li>
                    <li><a href="#" ><i class="fa fa-angle-double-right"></i>Funding</a></li>
                    <li><a href="#" ><i class="fa fa-angle-double-right"></i>Deposite</a></li>
                    <li><a href="#" ><i class="fa fa-angle-double-right"></i>Withdrow</a></li>
                    <li><a href="#" ><i class="fa fa-angle-double-right"></i>Manage Wallet</a></li>
                </ul>
            </div>
            <div class="col-xs-6 col-sm-3">
                <h4 class="footer-title">Explore</h4>
                <ul class="footer-links">
                    <li><a href="#" ><i class="fa fa-angle-double-right"></i>Trading</a></li>
                    <li><a href="#" ><i class="fa fa-angle-double-right"></i>Funding</a></li>
                    <li><a href="#" ><i class="fa fa-angle-double-right"></i>Deposite</a></li>
                    <li><a href="#" ><i class="fa fa-angle-double-right"></i>Withdrow</a></li>
                    <li><a href="#" ><i class="fa fa-angle-double-right"></i>Manage Wallet</a></li>
                </ul>
            </div>
            <div class="col-xs-6 col-sm-3">
                <h4 class="footer-title">Contact</h4>
                <ul class="footer-links">
                    <li><a href="#" ><i class="fa fa-angle-double-right"></i>Support center</a></li>
                    <li><a href="#" ><i class="fa fa-angle-double-right"></i>Careers</a></li>
                    <li><a href="#" ><i class="fa fa-angle-double-right"></i>About Page</a></li>
                    <li><a href="#" ><i class="fa fa-angle-double-right"></i>Media contact</a></li>
                    <li><a href="#" ><i class="fa fa-angle-double-right"></i>Contact</a></li>
                </ul>
            </div>
        </div>
    </div>
</footer>






<!-- jQuery 2.2.3 -->
 <script src="{{ asset('assets/plugins/jQuery/jquery-2.2.3.min.js') }}"></script>  

<script src="{{ asset('assets/plugins/bootstrap-toastr/toastr.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/plugins/jqueryui/jquery-ui.min.js') }}" type="text/javascript"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.6 -->
<script src="{{ asset('assets/bootstrap/js/bootstrap.min.js') }}"></script>
<!--<script src="{{ asset('assets/plugins/datepicker/bootstrap-datepicker.min.js') }}"
            type="text/javascript"></script>-->
<script src="{{ asset('assets/bootstrap/js/jquery.mCustomScrollbar.js') }}"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<!-- /page container -->
<script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('assets/plugins/bootstrap-confirmation/bootstrap-confirmation.min.js') }}"
        type="text/javascript"></script>
<script src="{{ asset('assets/plugins/jquery-validation/jquery.validate.min.js') }}"
        type="text/javascript"></script>
<script src="{{ asset('assets/plugins/jquery-validation/additional-methods.min.js') }}"
        type="text/javascript"></script>
<script src="{{ asset('assets/plugins/moment/js/moment.min.js') }}"
        type="text/javascript"></script>
<script src="{{ asset('assets/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js') }}"
        type="text/javascript"></script>
<script src="{{ asset('assets/plugins/bootstrap-touchspin/bootstrap.touchspin.min.js') }}"
        type="text/javascript"></script>
<script src="{{ asset('assets/plugins/tinymce/tinymce.min.js') }}"
        type="text/javascript"></script>
<script src="{{ asset('assets/plugins/fancybox/jquery.fancybox.js') }}"
        type="text/javascript"></script>
<script src="{{ asset('assets/plugins/jquery.numeric.js') }}"></script>

<script src="{{ asset('assets/themes/limitless/js/plugins/loaders/pace.min.js') }}"></script>
<script src="{{ asset('assets/themes/limitless/js/plugins/loaders/blockui.min.js') }}"></script>
 <script src="{{ asset('assets/themes/limitless/js/core/app.js') }}"></script> 
<script src="{{ asset('assets/themes/limitless/js/plugins/ui/ripple.min.js') }}"></script>
<script src="{{ asset('assets/themes/limitless/js/plugins/forms/styling/uniform.min.js') }}"></script>
<script src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
<!-- SlimScroll 1.3.0 -->
<script src="{{ asset('assets/themes/limitless/js/plugins/tables/datatables/datatables.min.js') }}"></script>


@yield('footer-scripts')
<!-- ChartJS 1.0.1 -->
<script src="{{ asset('assets/themes/limitless/js/custom.js') }}"></script>
<script>

    $(".acr").click(function(){
        $(this).parent().toggleClass("open");
    });

    $('#order-tbl').DataTable();
    $('#order-his-tbl').DataTable();
    $('#balance-tbl').DataTable();
    $('#block-1-tbl').DataTable();
    $('#block-2-tbl').DataTable();


    $('[data-toggle="tooltip"]').tooltip();


</script>

<script>
    //BTC
        function call_eth_btc()
        {
             $('#image_change').empty(); $('#coin_name').empty(); $('#coin_volume').empty(); $('#coin_low').empty();
             $('#coin_high').empty(); $('#coin_price').empty(); $('#coin_24hr').empty();

              $('#image_change').append("<img style='height:50px;width:50px;' src='{{ url('/')  }}/assets/themes/limitless/images/icon/btc.png'>"); 
             $('#coin_name').append('BTC/ETH');
             $('#coin_volume').append('<?php echo number_format($eth_vol_btc,2); ?>');
             $('#coin_low').append('<?php echo number_format($eth_low_btc,2); ?>');
             $('#coin_high').append('<?php echo number_format($eth_high_btc,2); ?>');
             $('#coin_price').append('<?php echo number_format($eth_last_btc,2); ?> ETH');
             $('#coin_24hr').append('<?php echo number_format($eth_24hr_btc,2); ?> %');
        } 
    
  function call_ltc_btc()
        {
             $('#image_change').empty(); $('#coin_name').empty(); $('#coin_volume').empty(); $('#coin_low').empty();
             $('#coin_high').empty(); $('#coin_price').empty(); $('#coin_24hr').empty();
            $('#image_change').append("<img style='height:50px;width:50px;' src='{{ url('/')  }}/assets/themes/limitless/images/icon/btc.png'>"); 
            $('#coin_name').append('BTC/LTC');
            $('#coin_volume').append('<?php echo number_format($ltc_vol_btc,2); ?>');
            $('#coin_low').append('<?php echo number_format($ltc_low_btc,2); ?>');
            $('#coin_high').append('<?php echo number_format($ltc_high_btc,2); ?>');
            $('#coin_price').append('<?php echo number_format($ltc_last_btc,2); ?> LTC');
            $('#coin_24hr').append('<?php echo number_format($ltc_24hr_btc,2); ?> %');
        }

        function call_xrp_btc()
        {
             $('#image_change').empty(); $('#coin_name').empty(); $('#coin_volume').empty(); $('#coin_low').empty();
             $('#coin_high').empty(); $('#coin_price').empty(); $('#coin_24hr').empty();
             $('#image_change').append("<img style='height:50px;width:50px;' src='{{ url('/')  }}/assets/themes/limitless/images/icon/btc.png'>"); 
             $('#coin_name').append('BTC/XRP');
             $('#coin_volume').append('<?php echo number_format($xrp_vol_btc,2); ?>');
             $('#coin_low').append('<?php echo number_format($xrp_low_btc,2); ?>');
             $('#coin_high').append('<?php echo number_format($xrp_high_btc,2); ?>');
             $('#coin_price').append('<?php echo number_format($xrp_last_btc,2); ?> XRP');
             $('#coin_24hr').append('<?php echo number_format($xrp_24hr_btc,2); ?> %');
        }

       
  function call_aed_btc()
        {
             $('#image_change').empty(); $('#coin_name').empty(); $('#coin_volume').empty(); $('#coin_low').empty();
             $('#coin_high').empty(); $('#coin_price').empty(); $('#coin_24hr').empty();
            $('#image_change').append("<img style='height:50px;width:50px;' src='{{ url('/')  }}/assets/themes/limitless/images/icon/btc.png'>"); 
            $('#coin_name').append('BTC/AED');
            $('#coin_volume').append('<?php echo number_format($aud_vol_btc,2); ?>');
            $('#coin_low').append('<?php echo number_format($aud_low_btc,2); ?>');
            $('#coin_high').append('<?php echo number_format($aud_high_btc,2); ?>');
            $('#coin_price').append('<?php echo number_format($aud_last_btc,2); ?> AED');
            $('#coin_24hr').append('<?php echo number_format($aud_24hr_btc,2); ?> %');
        }

//LTC
        function call_eth_ltc()
        {
             $('#image_change').empty(); $('#coin_name').empty(); $('#coin_volume').empty(); $('#coin_low').empty();
             $('#coin_high').empty(); $('#coin_price').empty(); $('#coin_24hr').empty();
             $('#image_change').append("<img style='height:50px;width:50px;' src='{{ url('/')  }}/assets/themes/limitless/images/icon/ltc.png'>"); 
             $('#coin_name').append('LTC/ETH');
             $('#coin_volume').append('<?php echo number_format($eth_vol_ltc,2); ?>');
             $('#coin_low').append('<?php echo number_format($eth_low_ltc,2); ?>');
             $('#coin_high').append('<?php echo number_format($eth_high_ltc,2); ?>');
             $('#coin_price').append('<?php echo number_format($eth_last_ltc,2); ?> ETH');
             $('#coin_24hr').append('<?php echo number_format($eth_24hr_ltc,2); ?> %');
        }

        function call_btc_ltc()
        {
             $('#image_change').empty(); $('#coin_name').empty(); $('#coin_volume').empty(); $('#coin_low').empty();
             $('#coin_high').empty(); $('#coin_price').empty(); $('#coin_24hr').empty();
                $('#image_change').append("<img style='height:50px;width:50px;' src='{{ url('/')  }}/assets/themes/limitless/images/icon/ltc.png'>"); 
                $('#coin_name').append('LTC/BTC');
                $('#coin_volume').append('<?php echo number_format($btc_vol_ltc,2); ?>');
                $('#coin_low').append('<?php echo number_format($btc_low_ltc,2); ?>');
                $('#coin_high').append('<?php echo number_format($btc_high_ltc,2); ?>');
                $('#coin_price').append('<?php echo number_format($btc_last_ltc,2); ?> BTC');
                $('#coin_24hr').append('<?php echo number_format($btc_24hr_ltc,2); ?> %');
     }
        function call_xrp_ltc()
        {
             $('#image_change').empty(); $('#coin_name').empty(); $('#coin_volume').empty(); $('#coin_low').empty();
             $('#coin_high').empty(); $('#coin_price').empty(); $('#coin_24hr').empty();
               $('#image_change').append("<img style='height:50px;width:50px;' src='{{ url('/') }}/assets/themes/limitless/images/icon/ltc.png'>"); 
              $('#coin_name').append('LTC/XRP');
                $('#coin_volume').append('<?php echo number_format($xrp_vol_ltc,2); ?>');
                $('#coin_low').append('<?php echo number_format($xrp_low_ltc,2); ?>');
                $('#coin_high').append('<?php echo number_format($xrp_high_ltc,2); ?>');
              $('#coin_price').append('<?php echo number_format($xrp_last_ltc,2); ?> XRP');
              $('#coin_24hr').append('<?php echo number_format($xrp_24hr_ltc,2); ?> %');
        }

  function call_aed_ltc()
        {
             $('#image_change').empty(); $('#coin_name').empty(); $('#coin_volume').empty(); $('#coin_low').empty();
             $('#coin_high').empty(); $('#coin_price').empty(); $('#coin_24hr').empty();
               $('#image_change').append("<img style='height:50px;width:50px;' src='{{ url('/')  }}/assets/themes/limitless/images/icon/ltc.png'>"); 
               $('#coin_name').append('LTC/AED');
                 $('#coin_volume').append('<?php echo number_format($aud_vol_ltc,2); ?>');
              $('#coin_low').append('<?php echo number_format($aud_low_ltc,2); ?>');
              $('#coin_high').append('<?php echo number_format($aud_high_ltc,2); ?>');
               $('#coin_price').append('<?php echo number_format($aud_last_ltc,2); ?> AED');
               $('#coin_24hr').append('<?php echo number_format($aud_24hr_ltc,2); ?> %');
        }

        //XRP
        function call_eth_xrp()
        {
             $('#image_change').empty(); $('#coin_name').empty(); $('#coin_volume').empty(); $('#coin_low').empty();
             $('#coin_high').empty(); $('#coin_price').empty(); $('#coin_24hr').empty();
                     $('#image_change').append("<img style='height:50px;width:50px;' src='{{ url('/')  }}/assets/themes/limitless/images/icon/xrp.png'>"); 
                $('#coin_name').append('XRP/ETH');
                  $('#coin_volume').append('<?php echo number_format($eth_vol_xrp,2); ?>');
                $('#coin_low').append('<?php echo number_format($eth_low_xrp,2); ?>');
                 $('#coin_high').append('<?php echo number_format($eth_high_xrp,2); ?>');
                  $('#coin_price').append('<?php echo number_format($eth_last_xrp,2); ?> ETH');
                 $('#coin_24hr').append('<?php echo number_format($eth_24hr_xrp,2); ?> %');
        }

          function call_btc_xrp()
                {
                     $('#image_change').empty(); $('#coin_name').empty(); $('#coin_volume').empty(); $('#coin_low').empty();
             $('#coin_high').empty(); $('#coin_price').empty(); $('#coin_24hr').empty();
                            $('#image_change').append("<img style='height:50px;width:50px;' src='{{ url('/')  }}/assets/themes/limitless/images/icon/xrp.png'>"); 
                       $('#coin_name').append('XRP/BTC');
                          $('#coin_volume').append('<?php echo number_format($btc_vol_xrp,2); ?>');
                        $('#coin_low').append('<?php echo number_format($btc_low_xrp,2); ?>');
                        $('#coin_high').append('<?php echo number_format($btc_high_xrp,2); ?>');
                        $('#coin_price').append('<?php echo number_format($btc_last_xrp,2); ?> BTC');
                     $('#coin_24hr').append('<?php echo number_format($btc_24hr_xrp,2); ?> %');
                }

        function call_ltc_xrp()
        {
             $('#image_change').empty(); $('#coin_name').empty(); $('#coin_volume').empty(); $('#coin_low').empty();
             $('#coin_high').empty(); $('#coin_price').empty(); $('#coin_24hr').empty();
                    $('#image_change').append("<img style='height:50px;width:50px;' src='{{ url('/')  }}/assets/themes/limitless/images/icon/xrp.png'>"); 
              $('#coin_name').append('XRP/LTC');
                 $('#coin_volume').append('<?php echo number_format($ltc_vol_xrp,2); ?>');
                $('#coin_low').append('<?php echo number_format($ltc_low_xrp,2); ?>');
                $('#coin_high').append('<?php echo number_format($ltc_high_xrp,2); ?>');
                $('#coin_price').append('<?php echo number_format($ltc_last_xrp,2); ?> LTC');
               $('#coin_24hr').append('<?php echo number_format($ltc_24hr_xrp,2); ?> %');
        }

  function call_aed_xrp()
        {
             $('#image_change').empty(); $('#coin_name').empty(); $('#coin_volume').empty(); $('#coin_low').empty();
             $('#coin_high').empty(); $('#coin_price').empty(); $('#coin_24hr').empty();
                    $('#image_change').append("<img style='height:50px;width:50px;' src='{{ url('/')  }}/assets/themes/limitless/images/icon/xrp.png'>"); 
               $('#coin_name').append('XRP/AED');
                 $('#coin_volume').append('<?php echo number_format($aud_vol_xrp,2); ?>');
              $('#coin_low').append('<?php echo number_format($aud_low_xrp,2); ?>');
              $('#coin_high').append('<?php echo number_format($aud_high_xrp,2); ?>');
               $('#coin_price').append('<?php echo number_format($aud_last_xrp,2); ?> AED');
               $('#coin_24hr').append('<?php echo number_format($aud_24hr_xrp,2); ?> %');
        }


        //ETH
        function call_xrp_eth()
        {
             $('#image_change').empty(); $('#coin_name').empty(); $('#coin_volume').empty(); $('#coin_low').empty();
             $('#coin_high').empty(); $('#coin_price').empty(); $('#coin_24hr').empty();
                     $('#image_change').append("<img style='height:50px;width:50px;' src='{{ url('/')  }}/assets/themes/limitless/images/icon/eth.png'>"); 
                $('#coin_name').append('ETH/XRP');
                  $('#coin_volume').append('<?php echo number_format($xrp_vol_eth,2); ?>');
                $('#coin_low').append('<?php echo number_format($xrp_low_eth,2); ?>');
                 $('#coin_high').append('<?php echo number_format($xrp_high_eth,2); ?>');
                  $('#coin_price').append('<?php echo number_format($xrp_last_eth,2); ?> XRP');
                 $('#coin_24hr').append('<?php echo number_format($xrp_24hr_eth,2); ?> %');
        }

          function call_btc_eth()
                {
                     $('#image_change').empty(); $('#coin_name').empty(); $('#coin_volume').empty(); $('#coin_low').empty();
             $('#coin_high').empty(); $('#coin_price').empty(); $('#coin_24hr').empty();
                    $('#image_change').empty();  $('#image_change').append("<img style='height:50px;width:50px;' src='{{ url('/')  }}/assets/themes/limitless/images/icon/eth.png'>"); 
                   $('#coin_name').empty(); $('#coin_name').append('ETH/BTC');
                     $('#coin_volume').empty();$('#coin_volume').append('<?php echo number_format($btc_vol_eth,2); ?>');
                      $('#coin_low').empty();$('#coin_low').append('<?php echo number_format($btc_low_eth,2); ?>');
                     $('#coin_high').empty();$('#coin_high').append('<?php echo number_format($btc_high_eth,2); ?>');
                    $('#coin_price').empty();$('#coin_price').append('<?php echo number_format($btc_last_eth,2); ?> BTC');
                  $('#coin_24hr').empty();$('#coin_24hr').append('<?php echo number_format($btc_24hr_eth,2); ?> %');
                }

        function call_ltc_eth()
        {
             $('#image_change').empty(); $('#coin_name').empty(); $('#coin_volume').empty(); $('#coin_low').empty();
             $('#coin_high').empty(); $('#coin_price').empty(); $('#coin_24hr').empty();
            $('#image_change').append("<img style='height:50px;width:50px;' src='{{ url('/')  }}/assets/themes/limitless/images/icon/eth.png'>"); 
              $('#coin_name').append('ETH/LTC');
                 $('#coin_volume').append('<?php echo number_format($ltc_vol_eth,2); ?>');
                $('#coin_low').append('<?php echo number_format($ltc_low_eth,2); ?>');
                $('#coin_high').append('<?php echo number_format($ltc_high_eth,2); ?>');
                $('#coin_price').append('<?php echo number_format($ltc_last_eth,2); ?> LTC');
               $('#coin_24hr').append('<?php echo number_format($ltc_24hr_eth,2); ?> %');
        }

  function call_aed_eth()
        {
             $('#image_change').empty(); $('#coin_name').empty(); $('#coin_volume').empty(); $('#coin_low').empty();
             $('#coin_high').empty(); $('#coin_price').empty(); $('#coin_24hr').empty();
             $('#image_change').append("<img style='height:50px;width:50px;' src='{{ url('/')  }}/assets/themes/limitless/images/icon/eth.png'>"); 
               $('#coin_name').append('ETH/AED');
                 $('#coin_volume').append('<?php echo number_format($aud_vol_eth,2); ?>');
              $('#coin_low').append('<?php echo number_format($aud_low_eth,2); ?>');
              $('#coin_high').append('<?php echo number_format($aud_high_eth,2); ?>');
               $('#coin_price').append('<?php echo number_format($aud_last_eth,2); ?> AED');
               $('#coin_24hr').append('<?php echo number_format($aud_24hr_eth,2); ?> %');
        }


        //AED
        function call_eth_aed()
        {
             $('#image_change').empty(); $('#coin_name').empty(); $('#coin_volume').empty(); $('#coin_low').empty();
             $('#coin_high').empty(); $('#coin_price').empty(); $('#coin_24hr').empty();
                $('#image_change').append("<img style='height:50px;width:50px;' src='{{ url('/')  }}/assets/themes/limitless/images/icon/aed.png'>"); 
                $('#coin_name').append('AED/ETH');
                  $('#coin_volume').append('-');
                $('#coin_low').append('<?php echo number_format($eth_low_aed,2); ?>');
                 $('#coin_high').append('<?php echo number_format($eth_high_aed,2); ?>');
                  $('#coin_price').append('<?php echo number_format($eth_last_aed,2); ?> ETH');
                 $('#coin_24hr').append('<?php echo number_format($eth_24hr_aed,2); ?> %');
        }

          function call_btc_aed()
                {
                     $('#image_change').empty(); $('#coin_name').empty(); $('#coin_volume').empty(); $('#coin_low').empty();
             $('#coin_high').empty(); $('#coin_price').empty(); $('#coin_24hr').empty();
                     $('#image_change').append("<img style='height:50px;width:50px;' src='{{ url('/')  }}/assets/themes/limitless/images/icon/aed.png'>"); 
                       $('#coin_name').append('XRP/BTC');
                          $('#coin_volume').append('-');
                        $('#coin_low').append('<?php echo number_format($btc_low_aed,2); ?>');
                        $('#coin_high').append('<?php echo number_format($btc_high_aed,2); ?>');
                        $('#coin_price').append('<?php echo number_format($btc_last_aed,2); ?> BTC');
                     $('#coin_24hr').append('<?php echo number_format($btc_24hr_aed,2); ?> %');
                }

        function call_ltc_aed()
        {
             $('#image_change').empty(); $('#coin_name').empty(); $('#coin_volume').empty(); $('#coin_low').empty();
             $('#coin_high').empty(); $('#coin_price').empty(); $('#coin_24hr').empty();
            $('#image_change').append("<img style='height:50px;width:50px;' src='{{ url('/')  }}/assets/themes/limitless/images/icon/aed.png'>"); 
              $('#coin_name').append('XRP/LTC');
                 $('#coin_volume').append('-');
                $('#coin_low').append('<?php echo number_format($ltc_low_aed,2); ?>');
                $('#coin_high').append('<?php echo number_format($ltc_high_aed,2); ?>');
                $('#coin_price').append('<?php echo number_format($ltc_last_aed,2); ?> LTC');
               $('#coin_24hr').append('<?php echo number_format($ltc_24hr_aed,2); ?> %');
        }

  function call_xrp_aed()
        {
             $('#image_change').empty(); $('#coin_name').empty(); $('#coin_volume').empty(); $('#coin_low').empty();
             $('#coin_high').empty(); $('#coin_price').empty(); $('#coin_24hr').empty();
               $('#image_change').append("<img style='height:50px;width:50px;' src='{{ url('/')  }}/assets/themes/limitless/images/icon/aed.png'>"); 
               $('#coin_name').append('XRP/AED');
                 $('#coin_volume').append('-');
              $('#coin_low').append('<?php echo number_format($xrp_low_aed,2); ?>');
              $('#coin_high').append('<?php echo number_format($xrp_high_aed,2); ?>');
               $('#coin_price').append('<?php echo number_format($xrp_last_aed,2); ?> XRP');
               $('#coin_24hr').append('<?php echo number_format($xrp_24hr_aed,2); ?> %');
        }

</script>

<script src="{{ asset('candle/js/highstock.js') }}"></script>
<script src="{{ asset('candle/js/exporting.js') }}"></script>
<script src="{{ asset('candle/js/btc_chart_head.js') }}"></script>

<script type="text/javascript">

  $(document).ready( function(){
    data();
    loadcharts('BTC', 'AED'); 
    $('#coin').val('BTC');
    $('#currency').val('AED');
  });

  function loadcharts(coin, cur) { 
    $('#coin').val(coin);
    $('#currency').val(cur);
    $('#loader').show();


    $.getJSON("chart/"+coin+'/'+cur, function(data) {
      //console.log(data); 
      Highcharts.setOptions({
      global: {
          timezoneOffset: -2 * 60
      }
      });
      // split the data set into ohlc and volume
      var ohlc = [],
          volume = [],
          dataLength = data.length;
          
      for (i = 0; i < dataLength; i++) {
          ohlc.push([
              data[i]['time']*1000, // the date
              data[i]['open'], // open
              data[i]['high'], // high
              data[i]['low'], // low
              data[i]['close'] // close
          ]);
          
          volume.push([
              data[i]['time']*1000, // the date
              data[i]['volumefrom'] // the volume
          ])
      }

      // create the chart
      $('#chartcontainer').highcharts('StockChart', {
        
        rangeSelector: {
            inputEnabled: $('#chartcontainer').width() > 480,
            selected: 0,
            enabled: false
            
        },
        //Rads added START
        navigator: { //Rads says not sure why this one is purple!
            enabled: false
        },
        chart: {
          marginBottom: 3,
          height: 500,
          backgroundColor: '#FFFFFF'
        },
        
        scrollbar: {
            enabled: false
        },

        credits: {
            enabled: false
        },
        exporting: {
            enabled: false
        }, 
        yAxis: [{
            
            labels: {
                enabled: true,
                align: 'left',
            },
            
            title: {
                text: 'OHLC',
                x: 11
            },
            height: '10%',
            height: '100%', 
            lineWidth: 2
        }, {
            labels: {
                align: 'right',
                x: -3,
                style: { "color": "#000000", "fontWeight": "none" }
            },
            title: {
                text: 'Volume',
                y: 70,
                style: { "color": "#000000", "fontWeight": "bold" }
            },
            height: '100%',
            offset: 0,
            lineWidth: 2,
            opposite: false
            
        }],

         rangeSelector: {
            buttons: [{
                type: 'hour',
                count: 1,
                text: '1H'
            }, {
                type: 'day',
                count: 1,
                text: '1D'
            }, {
                type: 'week',
                count: 1,
                text: '1W'
            }, {
                type: 'month',
                count: 1,
                text: '1M'
            }, {
                type: 'all',
                count: 1,
                text: 'All'
            }],
            selected: 1,
            inputEnabled: true
        },
        
        series: [{
            type: 'column',
            //color: '#FF9900',//This changes the bar chart to orange Also changes the little dot...
            color: '#4ebc91',
            name: 'Volume',
            data: volume,
            yAxis: 1,
           
          }, 
          {
            type: 'candlestick',
            name: coin+'/'+cur,
            data: ohlc,
            color: '#EB4D5C',
            upColor: '#1f87e6',
            lineColor: '#EB4D5C',               
            upLineColor: 'green' // docs
              
        }]

      });

      $('#loader').hide();
    });
  }

  function data(){
    $.getJSON("/get-market-data", function(json) { 
      //console.log(json); 
      $(json).each(function( i ) {

        var coin = json[i]["coin"];  
        var currency = json[i]["currency"]; 
        var close = json[i]["close"]; 
        var high = json[i]["high"]; 
        var last_change = json[i]["last_change"]; 
        var low = json[i]["low"]; 
        var open = json[i]["open"]; 
        var price = json[i]["price"]; 
        var volume = json[i]["volume"];  

        $('.'+coin+'-'+currency).html('');  
        $('.'+coin+'-'+currency).append(price);  

        $('.'+coin+currency+'-HP').html('');  
        $('.'+coin+currency+'-HP').append(high);  

        $('.'+coin+currency+'-DC').html('');  
        $('.'+coin+currency+'-DC').append(last_change);  

        $('.'+coin+currency+'-TO').html('');  
        $('.'+coin+currency+'-TO').append(open);  

        $('.'+coin+currency+'-TF').html('');  
        $('.'+coin+currency+'-TF').append(volume);  

      });

    });
  }  

  setInterval(coindeta, 5000)

  function coindeta(){   
    data();
  };

  function call_all(coin)
  {
     $('#message').empty();

    $('#slash_coin').empty();
    $('#slash_coin').append(coin+'/AED');

    $('#fees_coin').empty();
    $('#fees_coin').append('<b>'+coin+'</b>');

    $('#fees_coin1').empty();
    $('#fees_coin1').append('<b>'+coin+'</b>');
  
    //Add currency for dynamic charts
    $('#coin').val(coin);
    $('#currency').val('AED');

    $('#coinname').empty();
    $('#coinname').append('Amount '+coin);

    $('#coin_use').val(coin);
    $('#chartcontainer').empty();

    $('#order_coin').empty();
    $('#order_coin').append(coin+' /AED');

    var coinx = coin.toLowerCase(); 

   $('#image_change').empty();$('#image_change').append("<img style='height:50px;width:50px;' src='{{ url('/')  }}/assets/themes/limitless/images/icon/"+coinx+".png'>"); 

   if(coinx == 'btc')
   {   call_aed_btc();  }
   else if(coinx == 'eth')
   {   call_aed_eth(); }
   else if(coinx == 'ltc')
   {   call_aed_ltc(); }
   else if(coinx == 'xrp')
   {   call_aed_xrp(); }
   else
   {  call_aed_btc();  }

    data();
    loadcharts(coin, 'AED'); 

  }

  function call_all_order(coin)
  {
   $('#order_full').empty();
     $('#order_middle').empty();

       $.ajax({
                  url: 'exchange/order',
                  type: 'post',
                  data:{ option:coin,_token:"{{csrf_token()}}"},
                  success: function(response)
                  {
                    alert(response);
                   //   $('#order_full').append(response);
                    //  $('#order_middle').append(response);
                  }
                 }); 
  }


  function order_tr_call(count,amount,total,price)
  {
     $('#message').empty();
     document.getElementById("buy_button").disabled = false;
     document.getElementById("sell_button").disabled = false;

     $('#usd_amount').val(price);
     $('#coin_amount').val(total);

        var usd_amount = 0;
        var coin_amount = 0;

         usd_amount = $('#usd_amount').val();
         coin_amount = $('#coin_amount').val();

        var multiply = parseFloat(usd_amount) * parseFloat(coin_amount); if(isNaN(multiply)){  multiply=0; }
        $('#approx_usd').empty();
        $('#approx_usd').append('≈ '+multiply);
        $('#final_aed').val(multiply);

        var bfees = '{{ $buy_fees }}';
        var sfees = '{{ $sell_fees }}';

        var aed_amount = $('#final_aed').val();

        var final_buy_fees = parseFloat(aed_amount) * parseFloat(bfees) / 100;  if(isNaN(final_buy_fees)){  final_buy_fees=0; }
        $('#buy_fees').val(final_buy_fees);

         var final_sell_fees = parseFloat(aed_amount) * parseFloat(sfees) / 100; if(isNaN(final_sell_fees)){  final_sell_fees=0; }
        $('#sell_fees').val(final_sell_fees);
        var coin_name = $('#coin_use').val();

        var pay_total = parseFloat(aed_amount)+parseFloat(final_buy_fees); if(isNaN(pay_total)){  pay_total=0; }
        var rec_total = parseFloat(aed_amount)-parseFloat(final_buy_fees); if(isNaN(rec_total)){  rec_total=0; }

        $("#pay_div").empty(); $("#pay_div").append(pay_total.toFixed(2)); 
        $("#rec_div").empty(); $("#rec_div").append(rec_total.toFixed(2));

         var bbalance = 0;
         var sbalance = 0;

             bbalance = "{{$aed_balance}}";
            if(coin_name == 'BTC')
            {    sbalance = "{{$btc_balance}}";   }
            else if(coin_name == 'LTC')
            {    sbalance = "{{$ltc_balance}}";   }
            else if(coin_name == 'XRP')
            {    sbalance =  "{{$xrp_balance}}";   }
            else if(coin_name == 'ETH')
            {    sbalance = "{{$eth_balance}}";   }
            else
            {  }

       //00
        if(parseFloat(aed_amount) < parseFloat(bbalance) && parseFloat(coin_amount) < parseFloat(sbalance))
        {
                      $('#message').empty();
                      document.getElementById("buy_button").disabled = false;
                      document.getElementById("sell_button").disabled = false;
       }//01
      else if(parseFloat(aed_amount) < parseFloat(bbalance) && parseFloat(coin_amount) > parseFloat(sbalance))
        {
              $('#message').append("<div class='alert alert-danger' role='alert'> Insufficient "+coin_name+" Balance.</div>"); 
              document.getElementById("buy_button").disabled = false;
              document.getElementById("sell_button").disabled = true;
        }//10
        else if(parseFloat(aed_amount) > parseFloat(bbalance) && parseFloat(coin_amount) < parseFloat(sbalance))
        {
              $('#message').append("<div class='alert alert-danger' role='alert'> Insufficient AED Balance.</div>"); 
              document.getElementById("buy_button").disabled = true;
              document.getElementById("sell_button").disabled = false;
        }//11
         else if(parseFloat(aed_amount) > parseFloat(bbalance) && parseFloat(coin_amount) > parseFloat(sbalance))
        {
              $('#message').append("<div class='alert alert-danger' role='alert'> Insufficient AED Balance.</div>"); 
              $('#message').append("<div class='alert alert-danger' role='alert'> Insufficient "+coin_name+" Balance.</div>"); 
              document.getElementById("buy_button").disabled = true;
              document.getElementById("sell_button").disabled = true;
        }
        else  {  }


  }

  function create_exchange(type)
  {
     $('#message').empty();

     var usd_amount = $('#usd_amount').val();
     var coin_amount = $('#coin_amount').val();
     var order_type = $('#order_type').val();
     var coin_name = $('#coin_use').val();
     var buy_fees = $('#buy_fees').val();
     var sell_fees = $('#sell_fees').val();
     var final_aed = $('#final_aed').val();
     var balance = 0;

              $.ajax({
                  url: '/create_exg',
                  type: 'post',
                  data:{ final_aed:final_aed, buy_fees:buy_fees, sell_fees:sell_fees, type:type, usd_amount:usd_amount, coin_amount:coin_amount, order_type:order_type,coin_name:coin_name,_token:"{{csrf_token()}}"},
                  success: function(response)
                  {
                    if(response == 1)
                    {    $('#message').append("<div class='alert alert-success' role='alert'> Create "+ type +" Successfully</div>");  }
                    else if(response == 0)
                    {    $('#message').append("<div class='alert alert-danger' role='alert'> Some Problem of create "+type+" </div>");  }
                    else
                    {  }
                  }
                 });
  }

    function call_order(option)
    {
      $('#order_middle').empty();
       $.ajax({
                  url: 'exchange/call_order_middle',
                  type: 'post',
                  data:{ option:option,_token:"{{csrf_token()}}"},
                  success: function(response)
                  {
                      $('#order_middle').append(response);
                  }
                 });
    }

     function call_order_full(option)
    {
      $('#order_full').empty();
       $.ajax({
                  url: 'exchange/call_order_full',
                  type: 'post',
                  data:{ option:option,_token:"{{csrf_token()}}"},
                  success: function(response)
                  {
                      $('#order_full').append(response);
                  }
                 });
    }

    function order_full(option)
    {
      $('#order_full').empty();
       $.ajax({
                  url: 'exchange/order_full',
                  type: 'post',
                  data:{ option:option,_token:"{{csrf_token()}}"},
                  success: function(response)
                  {
                      $('#order_full').append(response);
                  }
                 });   
    }


      function order_middle(option)
    {
      $('#order_middle').empty();
       $.ajax({
                  url: 'exchange/order_middle',
                  type: 'post',
                  data:{ option:option,_token:"{{csrf_token()}}"},
                  success: function(response)
                  {
                      $('#order_middle').append(response);
                  }
                 });   
    }


  function calculate_price()
  {
     $('#message').empty();
     document.getElementById("buy_button").disabled = false;
     document.getElementById("sell_button").disabled = false;

    var usd_amount = 0;
    var coin_amount = 0;

     usd_amount = $('#usd_amount').val();
     coin_amount = $('#coin_amount').val();

    var multiply = parseFloat(usd_amount) * parseFloat(coin_amount); if(isNaN(multiply)){  multiply=0; }
    $('#approx_usd').empty();
    $('#approx_usd').append('≈ '+multiply);
    $('#final_aed').val(multiply);

    var bfees = '{{ $buy_fees }}';
    var sfees = '{{ $sell_fees }}';

    var aed_amount = $('#final_aed').val();

    var final_buy_fees = parseFloat(aed_amount) * parseFloat(bfees) / 100;  if(isNaN(final_buy_fees)){  final_buy_fees=0; }
    $('#buy_fees').val(final_buy_fees);

     var final_sell_fees = parseFloat(aed_amount) * parseFloat(sfees) / 100; if(isNaN(final_sell_fees)){  final_sell_fees=0; }
    $('#sell_fees').val(final_sell_fees);
    var coin_name = $('#coin_use').val();

    var pay_total = parseFloat(aed_amount)+parseFloat(final_buy_fees); if(isNaN(pay_total)){  pay_total=0; }
    var rec_total = parseFloat(aed_amount)-parseFloat(final_buy_fees); if(isNaN(rec_total)){  rec_total=0; }

    $("#pay_div").empty(); $("#pay_div").append(pay_total.toFixed(2)); 
    $("#rec_div").empty(); $("#rec_div").append(rec_total.toFixed(2));

         var bbalance = 0;
         var sbalance = 0;

             bbalance = "{{$aed_balance}}";
            if(coin_name == 'BTC')
            {    sbalance = "{{$btc_balance}}";   }
            else if(coin_name == 'LTC')
            {    sbalance = "{{$ltc_balance}}";   }
            else if(coin_name == 'XRP')
            {    sbalance =  "{{$xrp_balance}}";   }
            else if(coin_name == 'ETH')
            {    sbalance = "{{$eth_balance}}";   }
            else
            {  }

       //00
        if(parseFloat(aed_amount) < parseFloat(bbalance) && parseFloat(coin_amount) < parseFloat(sbalance))
        {
                      $('#message').empty();
                      document.getElementById("buy_button").disabled = false;
                      document.getElementById("sell_button").disabled = false;
       }//01
      else if(parseFloat(aed_amount) < parseFloat(bbalance) && parseFloat(coin_amount) > parseFloat(sbalance))
        {
              $('#message').append("<div class='alert alert-danger' role='alert'> Insufficient "+coin_name+" Balance.</div>"); 
              document.getElementById("buy_button").disabled = false;
              document.getElementById("sell_button").disabled = true;
        }//10
        else if(parseFloat(aed_amount) > parseFloat(bbalance) && parseFloat(coin_amount) < parseFloat(sbalance))
        {
              $('#message').append("<div class='alert alert-danger' role='alert'> Insufficient AED Balance.</div>"); 
              document.getElementById("buy_button").disabled = true;
              document.getElementById("sell_button").disabled = false;
        }//11
         else if(parseFloat(aed_amount) > parseFloat(bbalance) && parseFloat(coin_amount) > parseFloat(sbalance))
        {
              $('#message').append("<div class='alert alert-danger' role='alert'> Insufficient AED Balance.</div>"); 
              $('#message').append("<div class='alert alert-danger' role='alert'> Insufficient "+coin_name+" Balance.</div>"); 
              document.getElementById("buy_button").disabled = true;
              document.getElementById("sell_button").disabled = true;
        }
        else  {  }
  }

</script>

</body>
</html>