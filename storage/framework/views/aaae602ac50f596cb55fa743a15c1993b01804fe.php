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
    <link rel="stylesheet" href="<?php echo e(asset('assets/themes/limitless/css/bootstrap.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/themes/limitless/css/icons/icomoon/styles.css')); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="<?php echo e(asset('assets/themes/limitless/css/core.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/themes/limitless/css/components.css')); ?>">

    <!--  New added css -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/themes/limitless/css/jquery.mCustomScrollbar.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/themes/limitless/css/style.css')); ?>">
    <!-- End new Added CSS -->

    <link href="<?php echo e(asset('assets/plugins/font-awesome/css/font-awesome.min.css')); ?>" rel="stylesheet" type="text/css"/>
    <link href="<?php echo e(asset('assets/plugins/bootstrap-touchspin/bootstrap.touchspin.min.css')); ?>" rel="stylesheet" type="text/css"/>
    <link href="<?php echo e(asset('assets/plugins/fullcalendar/fullcalendar.css')); ?>" rel="stylesheet" type="text/css"/>
    <link href="<?php echo e(asset('assets/plugins/sweetalert2/sweetalert2.min.css')); ?>" rel="stylesheet" type="text/css"/>
    <link href="<?php echo e(asset('assets/plugins/fancybox/jquery.fancybox.css')); ?>"
          rel="stylesheet" type="text/css"/>
    <link href="<?php echo e(asset('assets/plugins/amcharts/plugins/export/export.css')); ?>" rel="stylesheet" type="text/css"/>
    <link href="<?php echo e(asset('assets/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css')); ?>" rel="stylesheet" type="text/css"/>
    <link href="<?php echo e(asset('assets/plugins/datepicker/bootstrap-datepicker3.min.css')); ?>" rel="stylesheet" type="text/css"/>
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    

    
    <style type="text/css">
        .card.full-card {
            position: fixed;
            top: 80px;
            z-index: 99999;
            -webkit-box-shadow: none;
            box-shadow: none;
            right: 0;
            border-radius: 0;
            border: 1px solid #ddd;
            width: calc(100vw - 287px);
            height: calc(100vh - 80px);
        }
        .loader {
            position: fixed;
            left: 0px;
            top: 0px;
            width: 100%;
            height: 100%;
            z-index: 9999;
            background: url('https://upload.wikimedia.org/wikipedia/commons/b/b1/Loading_icon.gif') 50% 50% no-repeat rgb(249,249,249);
            opacity: .8;
        }

        tr:hover {
            background-color: #2f2c2c1f;
        }

        .intro {
            background-color: #2f2c2c1f;
        }
        .onhover-dropdown  a li {
            color: #00000082;
        }


        /*.ltcdisabled
        {
            pointer-events: none;

            !* for "disabled" effect *!
            opacity: 0.5;
            background: #CCC;
        }*/
        </style>



</head>
<body class="dashboard" >
<div class="loader"></div>
<div class="container-fluid" id="app" >
    <div class="row">
        <div class="col-sm-12">
            <div class="dashboard-header row">
                <div class="dashboard-header-sidebar col-sm-2">
                    <div>
                        <a href="<?php echo e(url('/dashboard')); ?>"><svg  xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="136px" height="18px">
                                <path fill-rule="evenodd"  fill="#fff"  d="M135.341,13.079 L135.341,16.000 L125.459,16.000 L125.459,1.837 L134.981,1.837 L134.981,4.738 L128.760,4.738 L128.760,7.398 L134.641,7.398 L134.641,10.139 L128.760,10.139 L128.760,13.079 L135.341,13.079 ZM115.260,16.000 L109.979,16.000 L109.979,1.837 L115.100,1.837 C119.121,1.837 123.202,3.517 123.202,8.878 C123.202,13.860 119.161,16.000 115.260,16.000 ZM115.020,4.758 L113.320,4.758 L113.320,13.039 L114.940,13.039 C117.381,13.039 119.641,12.039 119.641,8.878 C119.641,5.698 117.381,4.758 115.020,4.758 ZM103.901,13.219 L98.420,13.219 L97.380,16.000 L93.722,16.000 L93.659,16.000 L89.721,16.000 L86.661,10.379 L85.500,10.379 L85.500,16.000 L82.140,16.000 L82.140,1.837 L87.541,1.837 C90.261,1.837 92.962,2.877 92.962,6.118 C92.962,8.018 91.842,9.379 90.021,9.939 L93.685,15.939 L99.600,1.837 L102.921,1.837 L108.802,16.000 L105.002,16.000 L103.901,13.219 ZM87.301,4.598 L85.480,4.598 L85.480,7.898 L87.101,7.898 C88.201,7.898 89.581,7.618 89.581,6.178 C89.581,4.858 88.321,4.598 87.301,4.598 ZM101.201,5.618 L99.400,10.479 L102.961,10.479 L101.201,5.618 ZM76.581,16.000 L73.160,16.000 L73.160,4.758 L69.160,4.758 L69.160,2.292 L64.021,9.999 L64.021,16.000 L60.601,16.000 L60.601,9.999 L55.280,1.837 L59.420,1.837 L62.441,7.078 L65.462,1.837 L69.160,1.837 L69.463,1.837 L80.582,1.837 L80.582,4.758 L76.581,4.758 L76.581,16.000 ZM53.362,16.000 L52.262,13.219 L46.781,13.219 L45.741,16.000 L42.020,16.000 L47.961,1.837 L51.282,1.837 L57.163,16.000 L53.362,16.000 ZM49.561,5.618 L47.761,10.479 L51.322,10.479 L49.561,5.618 ZM41.503,11.879 C41.503,14.960 38.802,16.000 36.102,16.000 L30.460,16.000 L30.460,1.837 L36.102,1.837 C38.302,1.837 40.923,2.617 40.923,5.478 C40.923,7.038 39.982,8.078 38.602,8.538 L38.602,8.578 C40.222,8.858 41.503,10.019 41.503,11.879 ZM35.441,4.558 L33.761,4.558 L33.761,7.478 L35.601,7.478 C36.882,7.478 37.622,6.938 37.622,5.938 C37.622,4.978 36.882,4.558 35.441,4.558 ZM35.661,9.999 L33.761,9.999 L33.761,13.239 L35.681,13.239 C36.762,13.239 38.082,12.939 38.082,11.559 C38.082,10.379 37.122,9.999 35.661,9.999 ZM18.188,17.576 C17.911,17.875 17.595,18.000 17.288,18.000 C16.278,18.000 15.365,16.647 16.272,15.668 L16.589,15.327 C15.259,15.233 13.979,14.896 12.796,14.130 C11.704,13.423 10.824,12.468 10.048,11.436 C9.776,11.074 9.516,10.703 9.264,10.329 C8.973,9.894 8.694,9.451 8.412,9.009 C7.819,8.078 7.214,7.157 6.446,6.352 C5.198,5.044 3.605,4.604 1.874,4.604 C1.689,4.604 1.503,4.609 1.315,4.619 C1.287,4.620 1.259,4.621 1.232,4.621 C-0.431,4.621 -0.395,2.008 1.315,1.921 C1.510,1.911 1.702,1.906 1.891,1.906 C5.500,1.906 8.028,3.695 10.049,6.581 C10.137,6.707 10.225,6.832 10.311,6.962 C10.762,7.641 11.187,8.336 11.640,9.009 C12.108,9.704 12.607,10.376 13.198,10.983 C14.237,12.051 15.422,12.490 16.721,12.614 C16.639,12.515 16.559,12.414 16.476,12.316 C16.001,11.754 15.921,10.962 16.476,10.408 C16.729,10.157 17.106,10.015 17.477,10.015 C17.822,10.015 18.162,10.137 18.391,10.408 C19.124,11.276 19.824,12.169 20.557,13.037 C21.034,13.515 21.217,14.309 20.626,14.946 L18.188,17.576 ZM18.391,7.609 C17.915,8.172 16.964,8.096 16.475,7.609 C15.921,7.056 16.001,6.264 16.475,5.702 C16.559,5.603 16.639,5.502 16.721,5.404 C15.421,5.528 14.237,5.967 13.198,7.035 C12.787,7.458 12.421,7.913 12.078,8.385 C11.891,8.101 11.705,7.812 11.517,7.518 C11.319,7.208 11.114,6.886 10.904,6.571 C10.774,6.374 10.641,6.185 10.508,5.999 C11.170,5.194 11.913,4.459 12.796,3.887 C13.979,3.122 15.259,2.785 16.589,2.691 L16.272,2.349 C15.090,1.073 17.001,-0.839 18.188,0.442 L20.626,3.072 C21.217,3.709 21.034,4.503 20.557,4.981 C19.824,5.848 19.124,6.742 18.391,7.609 ZM1.315,13.399 C3.261,13.497 5.064,13.113 6.446,11.665 C7.032,11.051 7.524,10.368 7.988,9.665 C8.210,10.013 8.438,10.371 8.673,10.722 C8.960,11.149 9.273,11.592 9.611,12.032 C7.554,14.709 4.971,16.281 1.315,16.096 C-0.423,16.008 -0.432,13.310 1.315,13.399 Z"/>
                            </svg>
                        </a>
                    </div>
                </div>
                <div class="col-sm-4">
                    <input v-model="currency" value="BTC"  type="hidden" class="form-control">
                    <ul class="header-left">
                        <li>
                            <div class="onhover-dropdown" >
                                <a> Trading <i class="fa fa-caret-down"></i></a>
                                <ul class="onhover-show-div" id="price_ticker">
                                    <a class="teading_a" href="<?php echo e(url('dashboard-exchange',"BTC")); ?>"><li><img src="<?php echo e(url('/')); ?>/assets/themes/limitless/images/icon/btc.png" alt="">BTC</li></a>
                                    <a class="teading_a" href="<?php echo e(url('dashboard-exchange',"ETH")); ?>"><li><img src="<?php echo e(url('/')); ?>/assets/themes/limitless/images/icon/eth.png" alt="">ETH</li></a>
                                    <a class="teading_a" href="<?php echo e(url('dashboard-exchange',"LTC")); ?>"><li><img src="<?php echo e(url('/')); ?>/assets/themes/limitless/images/icon/ltc.png" alt="">LTC</li></a>
                                    <a class="teading_a" href="<?php echo e(url('dashboard-exchange',"XRP")); ?>"><li><img src="<?php echo e(url('/')); ?>/assets/themes/limitless/images/icon/xrp.png" alt="">XRP</li></a>

                                    
                                    
                                    
                                    
                                </ul>
                            </div>
                        </li>

                        <li class="onhover-dropdown">
                            <div class="onhover-dropdown">
                                <a class="mr-10"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="12px" height="16px">
                                        <path fill-rule="evenodd" fill="#fff" d="M11.999,13.902 C12.000,13.652 12.001,13.866 11.999,13.902 ZM11.999,14.194 C11.999,14.194 11.115,16.000 6.000,16.000 C0.884,16.000 0.001,14.194 0.001,14.194 C0.001,13.984 0.000,13.864 0.000,13.799 C0.001,13.834 0.004,13.818 0.009,13.519 C0.077,9.853 0.591,8.797 4.260,8.125 C4.260,8.125 4.783,8.800 6.000,8.800 C7.217,8.800 7.739,8.125 7.739,8.125 C11.449,8.804 11.933,9.877 11.992,13.641 C11.996,13.882 11.998,13.923 11.999,13.902 C11.999,13.966 11.999,14.060 11.999,14.194 ZM6.000,7.825 C4.245,7.825 2.823,6.073 2.823,3.913 C2.823,1.752 3.290,-0.000 6.000,-0.000 C8.709,-0.000 9.176,1.752 9.176,3.913 C9.176,6.073 7.754,7.825 6.000,7.825 Z"></path>
                                    </svg> My account <i class="fa fa-caret-down"></i></a>
                                <ul class="onhover-show-div">
                                    <?php if(Sentinel::check()): ?>
                                        <a href="<?php echo e(url('logout')); ?>"><li class="text-primary"><i class="fa fa-sign-out mr-10"></i>Logout</li></a>
                                    <?php else: ?>
                                        <a href="<?php echo e(url('login')); ?>"><li class="text-primary" ><i class="fa fa-sign-in mr-10"></i>Login</li></a>
                                        <a href="<?php echo e(url('register')); ?>"><li class="text-primary"><i class="fa fa-plus-square-o mr-10"></i>Register</li></a>
                                    <?php endif; ?>
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

            $full_btc_usd  = json_decode(file_get_contents('https://www.bitstamp.net/api/v2/ticker/btcusd/'));
            $full_eth_usd  = json_decode(file_get_contents('https://www.bitstamp.net/api/v2/ticker/ethusd/'));
            $full_ltc_usd  = json_decode(file_get_contents('https://www.bitstamp.net/api/v2/ticker/ltcusd/'));
            $full_xrp_usd  = json_decode(file_get_contents('https://www.bitstamp.net/api/v2/ticker/xrpusd/'));


            $btc_aed_last = $full_btc_usd->last * $aed_rate;
            $btc_aed_high = $full_btc_usd->high * $aed_rate;
            $btc_aed_low = $full_btc_usd->low * $aed_rate;


            $eth_aed_last = $full_eth_usd->last * $aed_rate;
            $eth_aed_high = $full_eth_usd->high * $aed_rate;
            $eth_aed_low = $full_eth_usd->low * $aed_rate;


            $ltc_aed_last = $full_ltc_usd->last * $aed_rate;
            $ltc_aed_high = $full_ltc_usd->high * $aed_rate;
            $ltc_aed_low = $full_ltc_usd->low * $aed_rate;


            $xrp_aed_last = $full_xrp_usd->last * $aed_rate;
            $xrp_aed_high = $full_xrp_usd->high * $aed_rate;
            $xrp_aed_low = $full_xrp_usd->low * $aed_rate;
           

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

                $eth_balance = Sentinel::getuser()->ethereum_balance;
             $btc_balance = Sentinel::getuser()->bitcoin_balance;
             $aed_balance = Sentinel::getuser()->aed_balance;
             $xrp_balance = Sentinel::getuser()->ripple_balance;
             $ltc_balance = Sentinel::getuser()->litecoin_balance;


?>

            <div class="dashboard-main">
                <div class="dashboard-sidebar">
                    
                    <div class="theme-widget rate-widget">
                        <div class="media" style="height: 70px">
                            <div class="media-left  media-middle" id="image_change">
                                <img  src="<?php echo e(url('/')); ?>/assets/themes/limitless/images/icon/btc.png" alt="">
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
                                    <tr onmouseover="call_btc_aed_new()" id="call_btc_aed_new">
                                        <th scope="row"  rowspan="4"> <img src="<?php echo e(url('/')); ?>/assets/themes/limitless/images/icon/btc.png" /><br> BTC</th>
                                        <td><?php  echo number_format($btc_aed_last,2); ?><span>AED</span></td>
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
                                        <th scope="row"  rowspan="4"> <img src="<?php echo e(url('/')); ?>/assets/themes/limitless/images/icon/ltc.png" /><br> LTC</th>
                                        <td><?php  echo number_format($ltc_aed_last,2); ?><span>AED</span></td>
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
                                        <th scope="row"  rowspan="4"> <img src="<?php echo e(url('/')); ?>/assets/themes/limitless/images/icon/xrp.png" /><br> XRP</th>
                                        <td><?php  echo number_format($xrp_aed_last,2); ?><span>AED</span></td>
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
                                        <th scope="row"  rowspan="4"> <img src="<?php echo e(url('/')); ?>/assets/themes/limitless/images/icon/eth.png" /><br> ETH</th>
                                        <td><?php  echo number_format($eth_aed_last,2); ?><span>AED</span></td>
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
                            <th scope="row"  rowspan="4"> <img src="<?php echo e(url('/')); ?>/assets/themes/limitless/images/icon/aed.png" /><br> AED</th>
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
                    

                    
                    <div class="theme-widget order-widget open">
                        <div class="widget-header  acr">
                            <h5 > <i class="fa fa-chevron-right" aria-hidden="true"></i>Order Form</h5>
                        </div>
                        <div id="message"></div>

                        <div class="widget-body" style="padding: 5px;">
                            <form class="form-sm">
                                <div class="row" style="margin-bottom: 8px;">
                                    <div>
                                        <select id="order_type" name="order_type" class="form-control cust_fld">
                                            
                                            <option value="limit">Limits</option>
                                            <option value="market">Market</option>
                                          
                                        </select>
                                    </div>
                                    <div>
                                    </div>
                                </div>

                                <input type="hidden" name="coin_use" id="coin_use" value="BTC">

                                <div class="row d-flex">
                                    <div>
                                        <div class="input-group">
                                            <label> Amount AED</label> <span id="approx_usd" style="float: right;"> ≈  </span>
                                            <input onkeypress="return isNumber(event)" v-model="counter" type="text" class="form-control cust_fld" onkeyup="calculate_price()" name="usd_amount" id="usd_amount" aria-describedby="sizing-addon1">
                                        </div>
                                    </div>
                                    <div>
                                        <div class="input-group">
                                            <label id="coinname"> AMOUNT BTC</label>
                                            <input  onkeypress="return isNumber(event)"  v-model="counter1" type="text" name="coin_amount" id="coin_amount"  onkeyup="calculate_price()" class="form-control cust_fld"  aria-describedby="sizing-addon1">
                                        </div>
                                    </div>
                                </div>
                                <div class="row d-flex">
                                    <div>
                                        <div class="input-group">
                                            <label> Fees On <b>AED</b> </label>
                                            <input  v-model="feebuy" type="text" class="form-control cust_fld" readonly id="buy_fees" aria-describedby="sizing-addon1">
                                        </div>
                                    </div>
                                    <div>
                                        <div class="input-group">
                                            <label> Fees On <b>AED</b></label>
                                            <input v-model="feesell" type="text"  id="sell_fees" readonly class="form-control cust_fld"  aria-describedby="sizing-addon1">
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" id="buy_fees_per" name="" value="<?php echo e($buy_fees); ?>">
                                <input type="hidden" id="sell_fees_per" name="" value="<?php echo e($sell_fees); ?>">
                                <input type="hidden" id="final_aed" name="" value="0">

                                <div class="row d-flex">
                                    <div>
                                        <label style="color: green;">Pay :<span  id="pay_div"></span> </label><br>
                                        <label style="color: green;">Buy Fees : <b ><?php echo e($buy_fees); ?>%</b></label>
                                        <button id="buy_button"  onclick="buy_order()"    type="button"  class="btn btn-success btn-sm btn-block">Exchange Buy</button>
                                    </div>
                                    <div>
                                        <label style="color: green;">Receive :<span  id="rec_div"></span></label><br>
                                        <label style="color: green;">Sell Fees: <b><?php echo e($sell_fees); ?>%</b></span></label>
                                        <button id="sell_button" onclick="sell_order()"   type="button"  class="btn btn-danger btn-sm btn-block">Exchange Sell</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    

                    
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
                                        <th scope="row">  <img src="<?php echo e(url('/')); ?>/assets/themes/limitless/images/icon/btc.png" alt=""> BTC</th>
                                        <td><?php  echo number_format(Sentinel::getuser()->bitcoin_balance,4); ?></td>
                                    </tr>
                                    </tbody>
                                    <tbody>
                                    <tr>
                                        <th scope="row">  <img src="<?php echo e(url('/')); ?>/assets/themes/limitless/images/icon/eth.png" alt=""> ETH</th>
                                        <td><?php echo number_format(Sentinel::getuser()->ethereum_balance,4); ?></td>
                                    </tr>
                                    </tbody>
                                    <tbody>
                                    <tr>
                                        <th scope="row">  <img src="<?php echo e(url('/')); ?>/assets/themes/limitless/images/icon/xrp.png" alt=""> XRP</th>
                                        <td><?php echo number_format(Sentinel::getuser()->ripple_balance,4); ?></td>
                                    </tr>
                                    </tbody>
                                    <tbody class="last">
                                    <tr>
                                        <th scope="row">  <img src="<?php echo e(url('/')); ?>/assets/themes/limitless/images/icon/ltc.png" alt=""> LTC</th>
                                        <td><?php echo number_format(Sentinel::getuser()->litecoin_balance,4); ?></td>
                                    </tr>

                                    </tbody>
                                    <tbody class="last">
                                    <tr>
                                        <th scope="row">  <img src="https://cdn3.iconfinder.com/data/icons/currency-2/460/Arab-Emirates-Dirham-512.png" alt=""> AED</th>
                                        <td><?php echo number_format(Sentinel::getuser()->aed_balance,4); ?></td>
                                    </tr>

                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                    

                </div>
                <div class="dashboard-body">
                    <div class="">
                        <div class="row">
                            <div class="col-sm-12">

                                
                                <div   class="theme-widget balance-widget expand-chart"  >
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
                                                                <button class="btn btn-primary expand-chart-button" onclick="toggleFullScreen();">Expand</button>
                                                                <div id="chartcontainer"></div>
                                                                <div id="loader" align="center">
                                                                    <img src="<?php echo e(URL::asset('loading.gif')); ?>">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </section>
                                            <input type="hidden" id="coin" value="BTC">
                                            <input type="hidden" id="currency" value="">

                                        </div>
                                    </div>
                                </div>

                                <div @click="$event.target.classList.toggle('open')" class="theme-widget balance-widget ">
                                    <div class="widget-header acr">
                                        <h5> <i class="fa fa-chevron-right" aria-hidden="true"></i>Positions(0)</h5>
                                    </div>
                                    <div class="widget-body">
                                        <div class="">
                                        </div>
                                    </div>
                                </div>

                                <div class="theme-widget balance-widget open">
                                    <div class="widget-header">
                                        <h5 class="acr1"> <i class="fa fa-chevron-right" aria-hidden="true"></i>Order </h5>
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
                                                    <th>#</th>
                                                    <th>Side</th>
                                                    <th>order_id</th>
                                                    <th>Pair</th>
                                                    <th>Price</th>
                                                    <th>Amount</th>
                                                    <th>Fee</th>
                                                    <th>TOTAL</th>
                                                    <th>Action</th>
                                                    <th>Status</th>
                                                </tr>
                                                </thead>
                                                <tbody id="order_middle">
                                                <?php $i=1; ?>
                                                <?php $__currentLoopData = $exchange_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $exg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php if($exg->status == 0 || $exg->status == 2): ?>
                                                        <?php  if($exg->side == 'buy') { $color='#fbe9e7'; }
                                                        elseif($exg->side == 'sell') {  $color='#e8f5e9'; }
                                                        else {}  ?>
                                                        <?php $total = ($exg->price) * ($exg->same_price);  ?>
                                                        <tr id="<?php echo e("order_cancal".$exg->id); ?>" style="background-color: <?php echo $color; ?>">
                                                            <td><b><?php echo e($i++); ?></b></td>
                                                            <td><b><?php echo e($exg->side); ?></b></td>
                                                            <td><?php echo e($exg->order_id); ?></td>
                                                            <td><?php echo e($exg->symbol); ?></td>
                                                            <td><?php echo e(number_format($exg->same_price, 2)); ?></td>
                                                            <td><?php echo e(number_format($exg->price, 2)); ?></td>

                                                            <td><?php echo e(number_format($exg->buy_fees, 2)); ?></td>
                                                            <td><?php echo e(number_format($exg->final_aed,2)); ?></td>
                                                            <td >
                                                                <?php if($exg->status == 0): ?>
                                                                    <lable onclick="cancel_order_user('<?php echo e($exg->id); ?>','<?php echo e($exg->order_id); ?>')" class="btn btn-info">cancel</lable>
                                                                <?php endif; ?>
                                                            </td>
                                                            <td>
                                                                <?php if($exg->status == 0): ?>
                                                                    <label class="label label-warning"> Pending </label>
                                                                <?php elseif($exg->status == 2): ?>
                                                                    <label class="label label-info"> Partially Pay </label>
                                                                <?php else: ?>
                                                                <?php endif; ?>
                                                            </td>
                                                        </tr>
                                                    <?php else: ?>
                                                    <?php endif; ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <div class="theme-widget open">
                                    <div class="widget-header">
                                        <h5 class="acr1"> <i class="fa fa-chevron-right" aria-hidden="true"></i>Order history(0)</h5>

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
                                        <div class="table-responsive">
                                        <table id="order-his-tbl" class="display" style="width:100%">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Side</th>
                                                <th>order_id</th>
                                                <th>Pair</th>
                                                <th>Price</th>
                                                <th>Amount</th>
                                                <th>Fee</th>
                                                <th>TOTAL</th>
                                                <th>Status</th>
                                            </tr>
                                            </thead>
                                            <tbody id="order_full">
                                            <?php $i=1; ?>
                                            <?php $__currentLoopData = $exchange_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $exg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if($exg->status == 3 || $exg->status == 1): ?>
                                                    <?php  if($exg->side == 'buy') { $color='#fbe9e7'; }
                                                    elseif($exg->side == 'sell') {  $color='#e8f5e9'; }
                                                    else {}  ?>
                                                    <?php $total = ($exg->price) * ($exg->same_price);  ?>
                                                    <tr onclick="setvalue('<?php echo e($exg->same_price); ?>','<?php echo e($exg->price); ?>')" style="background-color: <?php echo $color; ?>">
                                                        <td><b><?php echo e($i++); ?></b></td>
                                                        <td><b><?php echo e($exg->side); ?></b></td>
                                                        <td><?php echo e($exg->order_id); ?></td>
                                                        <td><?php echo e($exg->symbol); ?></td>
                                                        <td><?php echo e(number_format($exg->same_price, 2)); ?></td>
                                                        <td><?php echo e(number_format($exg->price, 2)); ?></td>
                                                        <td><?php echo e(number_format($exg->buy_fees, 2)); ?></td>
                                                        <td><?php echo e(number_format($exg->final_aed, 2)); ?></td>

                                                        <td>
                                                            <?php if($exg->status == 1): ?>
                                                                <label class="label label-success"> Seccess </label>
                                                            <?php elseif($exg->status == 3): ?>
                                                                <label class="label label-danger"> Cancel </label>
                                                            <?php else: ?>
                                                            <?php endif; ?>
                                                        </td>
                                                    </tr>
                                                <?php else: ?>
                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </tbody>
                                        </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xs-12 col-lg-8">
                                <div class="theme-widget balance-widget  open">
                                    <div class="widget-header">
                                        <h5 class="acr1"> <i class="fa fa-chevron-right" aria-hidden="true"></i>Order Book  <span class="text-muted" id="order_coin">BTC/AED</span></h5>
                                    </div>
                                    <div class="widget-body">
                                        <div class="">
                                            <div class="scroll-table">
                                                <div class="row">
                                                    <div class="col-md-6 table-scroll">
                                                        <div class="table-responsive">
                                                            <table id="data-tab_bids" class="theme-dt bg-success tableclass scroll" style="width:100%">
                                                                <thead style="position: initial;">
                                                                <tr>
                                                                    <th ><span class="coinnames"></span> Amount</th>
                                                                    <th >Price / <span class="coinnames"></span></th>
                                                                    <th >Total: (AED)</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody id="bids_placeholder">

                                                                </tbody>
                                                            </table>

                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 table-scroll">
                                                        <table id="data-tab_asks" class="theme-dt bg-danger tableclass scroll" style="width:100%">
                                                            <thead style="position: initial;">
                                                            <tr>
                                                                <th  ><span class="coinnames"></span> Amount</th>
                                                                <th  >Price / <span class="coinnames"></span></th>
                                                                <th  >Total: (AED)</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody id="asks_placeholder">
                                                            
                                                            </tbody>
                                                        </table>

                                                    </div>
                                                </div>
                                            </div>



                                        </div>
                                        <div class="full-book mt-10">
                                            
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="col-xs-12 col-lg-4">
                                <div class="theme-widget balance-widget open">
                                    <div class="widget-header acr">
                                        <h5> <i class="fa fa-chevron-right" aria-hidden="true"></i>Trades Block <span class="text-muted"><samp class="coinnames"></samp>/AED</span></h5>
                                    </div>
                                    <div class="widget-body">
                                        <div id="typecall" class="table-responsive">
                                            <table class="display theme-dt tableclass scroll" style="width:100%;overflow: hidden;">
                                                <thead style="position: initial;">
                                                <tr style="background: #f8f8f8;">
                                                    <th >TYPE</th>
                                                    <th >Amount</th>
                                                    <th >PRICE</th>
                                                </tr>
                                                </thead>
                                                <tbody id="live_trade">
                                                
                                                </tbody>
                                            </table>
                                            <div></div>
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
<script src="<?php echo e(asset('assets/plugins/jQuery/jquery-2.2.3.min.js')); ?>"></script>

<script src="<?php echo e(asset('assets/plugins/bootstrap-toastr/toastr.min.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('assets/plugins/jqueryui/jquery-ui.min.js')); ?>" type="text/javascript"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo e(asset('assets/bootstrap/js/bootstrap.min.js')); ?>"></script>
<!--<script src="<?php echo e(asset('assets/plugins/datepicker/bootstrap-datepicker.min.js')); ?>"
            type="text/javascript"></script>-->
<script src="<?php echo e(asset('assets/bootstrap/js/jquery.mCustomScrollbar.js')); ?>"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<!-- /page container -->
<script src="<?php echo e(asset('assets/plugins/sweetalert2/sweetalert2.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/plugins/bootstrap-confirmation/bootstrap-confirmation.min.js')); ?>"
        type="text/javascript"></script>
<script src="<?php echo e(asset('assets/plugins/jquery-validation/jquery.validate.min.js')); ?>"
        type="text/javascript"></script>
<script src="<?php echo e(asset('assets/plugins/jquery-validation/additional-methods.min.js')); ?>"
        type="text/javascript"></script>
<script src="<?php echo e(asset('assets/plugins/moment/js/moment.min.js')); ?>"
        type="text/javascript"></script>
<script src="<?php echo e(asset('assets/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js')); ?>"
        type="text/javascript"></script>
<script src="<?php echo e(asset('assets/plugins/bootstrap-touchspin/bootstrap.touchspin.min.js')); ?>"
        type="text/javascript"></script>
<script src="<?php echo e(asset('assets/plugins/tinymce/tinymce.min.js')); ?>"
        type="text/javascript"></script>
<script src="<?php echo e(asset('assets/plugins/fancybox/jquery.fancybox.js')); ?>"
        type="text/javascript"></script>
<script src="<?php echo e(asset('assets/plugins/jquery.numeric.js')); ?>"></script>



<script src="<?php echo e(asset('assets/themes/limitless/js/core/app.js')); ?>"></script>
<script src="<?php echo e(asset('assets/themes/limitless/js/plugins/ui/ripple.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/themes/limitless/js/plugins/forms/styling/uniform.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/plugins/select2/select2.min.js')); ?>"></script>
<!-- SlimScroll 1.3.0 -->
<script src="<?php echo e(asset('assets/themes/limitless/js/plugins/tables/datatables/datatables.min.js')); ?>"></script>


<?php echo $__env->yieldContent('footer-scripts'); ?>
<!-- ChartJS 1.0.1 -->
<script src="<?php echo e(asset('assets/themes/limitless/js/custom.js')); ?>"></script>


<script src="https://d3dy5gmtp8yhk7.cloudfront.net/2.1/pusher.min.js"></script>
<script>


    var j = 0;
    var aed_price_admin =<?php echo e($aed_rate); ?>;


    function callshoket(currentcoin) {
        if (currentcoin == "BTC") {
            currrent = "order_book";
        }
        else if (currentcoin == "ETH") {
            currrent = "order_book_ethusd";
        }
        else if (currentcoin == "XRP") {
            currrent = "order_book_xrpusd";
        }
        else if (currentcoin == "LTC") {
            currrent = "order_book_ltcusd";
        }


        var bidsPlaceholder = document.getElementById("bids_placeholder");
        var asksPlaceholder = document.getElementById("asks_placeholder");
        var orderBookChannel = "";

        pusher = new Pusher('de504dc5763aeef9ff52');
        orderBookChannel = '';
        orderBookChannel = pusher.subscribe(currrent);
        i = 0;
        orderBookChannel.bind('data', function (data) {

            bidsPlaceholder.innerHTML = '';
            asksPlaceholder.innerHTML = '';
            for (i = 0; i < data.bids.length; i += 1) {

                var bidsrate = 'onclick="setvalue(' + data.bids[i][0] * aed_price_admin + ',' + data.bids[i][1] + ')"';

                bidsPlaceholder.innerHTML += '<tr ' + bidsrate + ' ><td>' + parseFloat(data.bids[i][1]).toFixed(4) + '</td><td>' + (data.bids[i][0] * aed_price_admin).toFixed(4) + ' AED' + '</td><td>' + (data.bids[i][1] * data.bids[i][0] * aed_price_admin).toFixed(4) + '</td></tr>';
            }
            for (i = 0; i < data.asks.length; i += 1) {
                var asksrate = 'onclick="setvalue(' + data.asks[i][0] * aed_price_admin + ',' + data.asks[i][1] + ')"';

                asksPlaceholder.innerHTML += '<tr ' + asksrate + ' ><td>' + parseFloat(data.asks[i][1]).toFixed(4) + '</td><td>' + (data.asks[i][0] * aed_price_admin).toFixed(4) + ' AED' + '</td><td>' + (data.asks[i][1] * data.asks[i][0] * aed_price_admin).toFixed(4) + '</td></tr>';
            }
        });
    }
</script>


<script>

    $(".acr").click(function(){
        $(this).parent().toggleClass("open");
    });

    $(".acr1").click(function(){
        $(this).parent().parent().toggleClass("open");
        $(this).parent().toggleClass("acr1");
    });

    $('#order-tbl').DataTable();
    $('#order-data-table3').DataTable();
    $('#order-his-tbl').DataTable();
    $('#balance-tbl').DataTable();
    $('#block-1-tbl').DataTable();
    $('#block-2-tbl').DataTable();


    $('[data-toggle="tooltip"]').tooltip();


</script>
<script type="text/javascript">
    $(window).load(function() {
        $(".loader").fadeOut("slow");
    });



</script>
<script>
    //BTC
    function call_btc_aed_new()
    {
        $('#image_change').empty(); $('#coin_name').empty(); $('#coin_volume').empty(); $('#coin_low').empty();
        $('#coin_high').empty(); $('#coin_price').empty(); $('#coin_24hr').empty();

        $('#image_change').append("<img style='height:50px;width:50px;' src='<?php echo e(url('/')); ?>/assets/themes/limitless/images/icon/btc.png'>");
        $('#coin_name').append('BTC/AED');
        $('#coin_volume').append('<?php echo number_format($eth_vol_btc,2); ?>');
        $('#coin_low').append('<?php echo number_format($btc_aed_low,2); ?>');
        $('#coin_high').append('<?php echo number_format($btc_aed_high,2); ?>');
        $('#coin_price').append('<?php echo number_format($btc_aed_last,2); ?> ETH');
        $('#coin_24hr').append('<?php echo number_format($eth_24hr_btc,2); ?> %');
    }

    function call_ltc_btc()
    {
        $('#image_change').empty(); $('#coin_name').empty(); $('#coin_volume').empty(); $('#coin_low').empty();
        $('#coin_high').empty(); $('#coin_price').empty(); $('#coin_24hr').empty();
        $('#image_change').append("<img style='height:50px;width:50px;' src='<?php echo e(url('/')); ?>/assets/themes/limitless/images/icon/btc.png'>");
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
        $('#image_change').append("<img style='height:50px;width:50px;' src='<?php echo e(url('/')); ?>/assets/themes/limitless/images/icon/btc.png'>");
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
        $('#image_change').append("<img style='height:50px;width:50px;' src='<?php echo e(url('/')); ?>/assets/themes/limitless/images/icon/btc.png'>");
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
        $('#image_change').append("<img style='height:50px;width:50px;' src='<?php echo e(url('/')); ?>/assets/themes/limitless/images/icon/ltc.png'>");
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
        $('#image_change').append("<img style='height:50px;width:50px;' src='<?php echo e(url('/')); ?>/assets/themes/limitless/images/icon/ltc.png'>");
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
        $('#image_change').append("<img style='height:50px;width:50px;' src='<?php echo e(url('/')); ?>/assets/themes/limitless/images/icon/ltc.png'>");
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
        $('#image_change').append("<img style='height:50px;width:50px;' src='<?php echo e(url('/')); ?>/assets/themes/limitless/images/icon/ltc.png'>");
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
        $('#image_change').append("<img style='height:50px;width:50px;' src='<?php echo e(url('/')); ?>/assets/themes/limitless/images/icon/xrp.png'>");
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
        $('#image_change').append("<img style='height:50px;width:50px;' src='<?php echo e(url('/')); ?>/assets/themes/limitless/images/icon/xrp.png'>");
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
        $('#image_change').append("<img style='height:50px;width:50px;' src='<?php echo e(url('/')); ?>/assets/themes/limitless/images/icon/xrp.png'>");
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
        $('#image_change').append("<img style='height:50px;width:50px;' src='<?php echo e(url('/')); ?>/assets/themes/limitless/images/icon/xrp.png'>");
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
        $('#image_change').append("<img style='height:50px;width:50px;' src='<?php echo e(url('/')); ?>/assets/themes/limitless/images/icon/eth.png'>");
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
        $('#image_change').empty();  $('#image_change').append("<img style='height:50px;width:50px;' src='<?php echo e(url('/')); ?>/assets/themes/limitless/images/icon/eth.png'>");
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
        $('#image_change').append("<img style='height:50px;width:50px;' src='<?php echo e(url('/')); ?>/assets/themes/limitless/images/icon/eth.png'>");
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
        $('#image_change').append("<img style='height:50px;width:50px;' src='<?php echo e(url('/')); ?>/assets/themes/limitless/images/icon/eth.png'>");
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
        $('#image_change').append("<img style='height:50px;width:50px;' src='<?php echo e(url('/')); ?>/assets/themes/limitless/images/icon/aed.png'>");
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
        $('#image_change').append("<img style='height:50px;width:50px;' src='<?php echo e(url('/')); ?>/assets/themes/limitless/images/icon/aed.png'>");
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
        $('#image_change').append("<img style='height:50px;width:50px;' src='<?php echo e(url('/')); ?>/assets/themes/limitless/images/icon/aed.png'>");
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
        $('#image_change').append("<img style='height:50px;width:50px;' src='<?php echo e(url('/')); ?>/assets/themes/limitless/images/icon/aed.png'>");
        $('#coin_name').append('XRP/AED');
        $('#coin_volume').append('-');
        $('#coin_low').append('<?php echo number_format($xrp_low_aed,2); ?>');
        $('#coin_high').append('<?php echo number_format($xrp_high_aed,2); ?>');
        $('#coin_price').append('<?php echo number_format($xrp_last_aed,2); ?> XRP');
        $('#coin_24hr').append('<?php echo number_format($xrp_24hr_aed,2); ?> %');
    }

</script>

<script src="<?php echo e(asset('candle/js/highstock.js')); ?>"></script>
<script src="<?php echo e(asset('candle/js/exporting.js')); ?>"></script>
<script src="<?php echo e(asset('candle/js/btc_chart_head.js')); ?>"></script>

<script type="text/javascript">

    $(document).ready( function(){
        call_all('<?php echo e($coinuse); ?>');
    });

    function loadcharts(coin, cur ,widthc) {
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
            $('#loader').hide();

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
                    height: widthc,
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


        });
    }


    //  setInterval(coindeta, 1000000000000000)


    function call_all(coin) {

        callshoket(coin);
        liveorders(coin);
        tradehistory(coin)
        loadcharts(coin, 'AED', 500);

       /* var type_coin = $('#coin').val();
        if (type_coin == "LTC") {
            swal('alert?', 'LTC will be add in exchange later , for now it when disabled', 'question');
        }*/

        //Add currency for dynamic charts
        $('#coin').val(coin);
        $('#currency').val('AED');
        $('.coinnames').html(coin);

        $('#message').empty();

        $('#slash_coin').empty();
        $('#slash_coin').append(coin+'/AED');

        $('#fees_coin').empty();
        $('#fees_coin').append('<b>'+coin+'</b>');

        $('#fees_coin1').empty();
        $('#fees_coin1').append('<b>'+coin+'</b>');



        $('#coinname').empty();
        $('#coinname').append('Amount '+coin);

        $('#coin_use').val(coin);
        $('#chartcontainer').empty();

        $('#order_coin').empty();
        $('#order_coin').append(coin+' /AED');

        var coinx = coin.toLowerCase();

        $('#image_change').empty();$('#image_change').append("<img style='height:50px;width:50px;' src='<?php echo e(url('/')); ?>/assets/themes/limitless/images/icon/"+coinx+".png'>");

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

        // data();
        // loadcharts(coin, 'AED');

        $('#order_full').empty();
        $('#order_middle').empty();
        $('#full_block').empty();
        $('#sell_full_coin').empty();
        $('#buy_full_coin').empty();

        $.ajax({ url:'<?php echo e(url('')); ?>/exchange/order_middle1/'+coin,  type: 'get',
            success: function(response) {  $('#order_middle').append(response);  }  });

        $.ajax({ url:'<?php echo e(url('')); ?>/exchange/order_full1/'+coin, type: 'get',
            success: function(response) {  $('#order_full').append(response);  }   });

        $.ajax({ url:'<?php echo e(url('')); ?>/exchange/order_full_block1/'+coin, type: 'get',
            success: function(response) {  $('#full_block').append(response);  }  });

        $.ajax({ url:'<?php echo e(url('')); ?>/exchange/buy_full_coin1/'+coin, type: 'get',
            success: function(response) {  $('#buy_full_coin').append(response);  }  });

        $.ajax({ url:'<?php echo e(url('')); ?>/exchange/sell_full_coin1/'+coin, type: 'get',
            success: function(response) {  $('#sell_full_coin').append(response);  }  });

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

        var bfees = '<?php echo e($buy_fees); ?>';
        var sfees = '<?php echo e($sell_fees); ?>';

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

        bbalance = "<?php echo e($aed_balance); ?>";
        if(coin_name == 'BTC')
        {    sbalance = "<?php echo e($btc_balance); ?>";   }
        else if(coin_name == 'LTC')
        {    sbalance = "<?php echo e($ltc_balance); ?>";   }
        else if(coin_name == 'XRP')
        {    sbalance =  "<?php echo e($xrp_balance); ?>";   }
        else if(coin_name == 'ETH')
        {    sbalance = "<?php echo e($eth_balance); ?>";   }
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
            data:{ final_aed:final_aed, buy_fees:buy_fees, sell_fees:sell_fees, type:type, usd_amount:usd_amount, coin_amount:coin_amount, order_type:order_type,coin_name:coin_name,_token:"<?php echo e(csrf_token()); ?>"},
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
            url: '<?php echo e(url('')); ?>/exchange/call_order_middle',
            type: 'post',
            data:{ option:option,_token:"<?php echo e(csrf_token()); ?>"},
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
            url: '<?php echo e(url('')); ?>/exchange/call_order_full',
            type: 'post',
            data:{ option:option,_token:"<?php echo e(csrf_token()); ?>"},
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
            url: '<?php echo e(url('')); ?>/exchange/order_full',
            type: 'post',
            data:{ option:option,_token:"<?php echo e(csrf_token()); ?>"},
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
            url: '<?php echo e(url('')); ?>/exchange/order_middle',
            type: 'post',
            data:{ option:option,_token:"<?php echo e(csrf_token()); ?>"},
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
        $('#approx_usd').append('≈ '+multiply.toFixed(4));
        $('#final_aed').val(multiply.toFixed(4));

        var bfees = '<?php echo e($buy_fees); ?>';
        var sfees = '<?php echo e($sell_fees); ?>';
        var aed_amount = $('#final_aed').val();

        var final_buy_fees = parseFloat(aed_amount) * parseFloat(bfees) / 100;  if(isNaN(final_buy_fees)){  final_buy_fees=0; }
        $('#buy_fees').val(final_buy_fees);

        var final_sell_fees = parseFloat(aed_amount) * parseFloat(sfees) / 100; if(isNaN(final_sell_fees)){  final_sell_fees=0; }
        $('#sell_fees').val(final_sell_fees);
        var coin_name = $('#coin_use').val();

        var pay_total = parseFloat(aed_amount)+parseFloat(final_buy_fees); if(isNaN(pay_total)){  pay_total=0; }
        var rec_total = parseFloat(aed_amount)-parseFloat(final_sell_fees); if(isNaN(rec_total)){  rec_total=0; }

        $("#pay_div").empty(); $("#pay_div").append(pay_total.toFixed(2));
        $("#rec_div").empty(); $("#rec_div").append(rec_total.toFixed(2));

        var bbalance = 0;
        var sbalance = 0;

        bbalance = "<?php echo e($aed_balance); ?>";
        if(coin_name == 'BTC')
        {    sbalance = "<?php echo e($btc_balance); ?>";   }
        else if(coin_name == 'LTC')
        {    sbalance = "<?php echo e($ltc_balance); ?>";   }
        else if(coin_name == 'XRP')
        {    sbalance =  "<?php echo e($xrp_balance); ?>";   }
        else if(coin_name == 'ETH')
        {    sbalance = "<?php echo e($eth_balance); ?>";   }
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


    $(".card-header-right .full-card").on('click', function() {
        var $this = $(this);
        var port = $($this.parents('.card'));
        port.toggleClass("full-card");
        $(this).toggleClass("icofont-resize");
    });
</script>


<!-- expand script js start here -->
<script>
    function toggleFullScreen() {
        if ((document.fullScreenElement && document.fullScreenElement !== null) ||
            (!document.mozFullScreen && !document.webkitIsFullScreen)) {
            if (document.documentElement.requestFullScreen) {
                document.documentElement.requestFullScreen();
            } else if (document.documentElement.mozRequestFullScreen) {
                document.documentElement.mozRequestFullScreen();
            } else if (document.documentElement.webkitRequestFullScreen) {
                document.documentElement.webkitRequestFullScreen(Element.ALLOW_KEYBOARD_INPUT);
            }
        } else {
            if (document.cancelFullScreen) {
                document.cancelFullScreen();
            } else if (document.mozCancelFullScreen) {
                document.mozCancelFullScreen();
            } else if (document.webkitCancelFullScreen) {
                document.webkitCancelFullScreen();
            }
        }
        /*$(".expand-chart").hide();
        $(".expand-chart").toggleClass("expand-full");
         $(".expand-chart-button").html("Minimize");
         var btntext = $(".expand-chart-button").text();
         if(btntext == "Minimize"){
             $(".expand-chart-button").html("Expand");
         }
        data();
*/

    }
    $(".expand-chart-button").on('click', function() {
        var heightw = $( window ).height();
        if ($(this).text() == "Expand"){
            $(this).text("Minimize");
            $(".market-depth-sec").children().removeClass("container");
            $(".market-depth-sec").children().addClass("container-fluid");
            loadcharts($('#coin_use').val(), 'AED' , heightw);
        }
        else{
            $(this).text("Expand");
            $(".market-depth-sec").children().addClass("container");
            $(".market-depth-sec").children().removeClass("container-fluid");
            loadcharts($('#coin_use').val(), 'AED' ,500);
        }

    });


</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.1.1/socket.io.js"></script>




<script>

    function setvalue(aed_amount,coin_amount){
        $('#usd_amount').val(aed_amount);
        $('#coin_amount').val(coin_amount);

        document.getElementById("buy_button").disabled = false;
        document.getElementById("sell_button").disabled = false;


        var buy_fees =<?php echo e($buy_fees); ?>;
        var sell_fees =<?php echo e($sell_fees); ?>;
        $('#counter').val(aed_amount);
        $('#counter1').val(coin_amount);
        $('#buy_fees ').val((((aed_amount*coin_amount)*buy_fees)/100).toFixed(4));
        $('#sell_fees ').val((((aed_amount*coin_amount)*sell_fees)/100).toFixed(4));
        $('#approx_usd').html('≈ '+(aed_amount*coin_amount).toFixed(4));
        $('#pay_div').html((((aed_amount*coin_amount)*buy_fees/100)+(aed_amount*coin_amount)).toFixed(4))
        $('#rec_div').html((((aed_amount*coin_amount)*sell_fees/100)-(aed_amount*coin_amount)).toFixed(4))
    }

    function cancel_order_user(id,order_id) {
        $.ajax({
            /* the route pointing to the post function */
            url: '<?php echo e(url('cancelorder')); ?>',
            type: 'POST',
            /* send the csrf-token and the input to the controller */
            data: {_token: '<?php echo e(csrf_token()); ?>',id:id,order_id:order_id},
            dataType: 'JSON',
            /* remind that 'data' is the response of the AjaxController */
            success: function (data) {
                swal('alert?',data.reason,'question');
                $("#order_cancal"+id).hide();
            }
        });
    }


    function buy_order(){

        var USD = $('#usd_amount').val();
        var BTC = $('#coin_amount').val();
        var type = $('#coin').val();
        var order_type = $('#order_type').val();

        $.ajax({
            /* the route pointing to the post function */
            url: '<?php echo e(url(('placeordersbuy'))); ?>',
            type: 'POST',
            /* send the csrf-token and the input to the controller */
            data: {_token: '<?php echo e(csrf_token()); ?>',USD: USD, COIN: BTC ,type:type,order_type:order_type},
            dataType: 'JSON',
            async:true,
            /* remind that 'data' is the response of the AjaxController */
            success: function (data) {

                if(data.reason == "order place successfully")
                {
                    swal('alert?', data.reason, 'question');
                    window.location = "<?php echo e(url('dashboard-exchange',$coinuse)); ?>";
                }
                if(data.reason == "insufficient balance")
                {
                    swal('alert?', data.reason, 'question');
                    window.location = "<?php echo e(url('dashboard-exchange',$coinuse)); ?>";
                }
                if (data.reason.__all__.includes("account balance")) {

                    swal('alert?', 'invalid amount enter', 'question');
                }
                else if (data.reason.__all__) {
                    var error = data.reason.__all__;
                    if(error.indexOf('account balance') >= -1)
                    swal('alert?', 'invalid amount enter', 'question');
                        else
                    swal('alert?', data.reason, 'question');
                }
                else {
                    swal('alert?', data.reason, 'question');
                    window.location = "<?php echo e(url('dashboard-exchange',$coinuse)); ?>";

                }

            }
        });
    }
    function sell_order(){

        var USD = $('#usd_amount').val();
        var BTC = $('#coin_amount').val();
        var type = $('#coin').val();
        var order_type = $('#order_type').val();

        $.ajax({
            /* the route pointing to the post function */
            url: '<?php echo e(url(('placeordersell'))); ?>',
            type: 'POST',
            /* send the csrf-token and the input to the controller */
            data: {_token: '<?php echo e(csrf_token()); ?>',USD: USD, COIN: BTC ,type:type,order_type:order_type},
            dataType: 'JSON',
            async:true,

            /* remind that 'data' is the response of the AjaxController */
            success: function (data) {

                if(data.reason == "order place successfully")
                {swal('alert?', data.reason, 'question');
                    window.location = "<?php echo e(url('dashboard-exchange',$coinuse)); ?>";
                }
                if(data.reason == "insufficient balance")
                {
                    swal('alert?', data.reason, 'question');
                    window.location = "<?php echo e(url('dashboard-exchange',$coinuse)); ?>";
                }
                else if (data.reason.__all__) {
                    var error = data.reason.__all__;
                    if(error.indexOf('account balance') >= -1)
                        swal('alert?', 'invalid amount enter', 'question');
                    else
                        swal('alert?', data.reason, 'question');

                }
                else if (data.reason.__all__) {
                    swal('alert?', data.reason.__all__, 'question');
                    window.location = "<?php echo e(url('dashboard-exchange',$coinuse)); ?>";
                }
                else if (data.reason.limit_price) {
                    swal('alert?', data.reason.limit_price, 'question');
                    window.location = "<?php echo e(url('dashboard-exchange',$coinuse)); ?>";
                }
                else {
                    swal('alert?', data.reason, 'question');
                    window.location = "<?php echo e(url('dashboard-exchange',$coinuse)); ?>";

                }
            }
        });
    }
    document.getElementById("buy_button").disabled = true;
    document.getElementById("sell_button").disabled = true;
    $('.coinnames').html('BTC');

</script>

<script>
    function tradehistory(coin) {
        $.get('<?php echo e(url('treadehistory')); ?>'+'/'+coin, function(response){
            $("#Trades_Block").html(response);

            var $el = $("#typecall");
            function anim() {
                var st = $el.scrollTop();
                var sb = $el.prop("scrollHeight")-$el.innerHeight();
                $el.animate({scrollTop: st<sb/2 ? sb : 0}, 4000, anim);
            }
            function stop(){
                $el.stop();
            }
            anim();
            $el.hover(stop, anim);
        });
    }

    function liveorders(currentcoin) {
        if (currentcoin == "BTC") {
            currrent = "live_orders";
        }
        else if (currentcoin == "ETH") {
            currrent = "live_orders_ethusd";
        }
        else if (currentcoin == "XRP") {
            currrent = "live_orders_xrpusd";
        }
        else if (currentcoin == "LTC") {
            currrent = "live_orders_ltcusd";
        }



        var placeholder = $('#live_trade');
        var pusher = new Pusher('de504dc5763aeef9ff52');
        console.log(pusher);


        ordersChannelnew = pusher.subscribe(currrent);



            $.each(['order_created', 'order_changed', 'order_deleted'], function (eventIndex, eventName) {

                ordersChannelnew.bind(eventName, function (data) {
                    if ($('#live_trade tr').length > 21) {
                        $('#live_trade tr:first-child').remove();
                    }
                    placeholder.append('<tr><td>' + eventName + '</td><td> ' + data.amount + '  </td><td> ' + parseFloat((data.price * <?php echo e($aed_rate); ?>)).toFixed(4) + ' AED ' + ((data.order_type == 0) ? 'BUY' : 'SELL') + '</td></tr>');
                });
            });

    };

    function isNumber(evt) {
        evt = (evt) ? evt : window.event;
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (  charCode > 31 && ( charCode < 46 || charCode > 57)) {
            document.getElementById("buy_button").disabled = true;
            document.getElementById("sell_button").disabled = true;
            return false;
        }
        else {
            if(charCode == 47){
                document.getElementById("buy_button").disabled = true;
                document.getElementById("sell_button").disabled = true;
                return false;
            }
            return true;

        }
    }

</script>



</body>
</html>