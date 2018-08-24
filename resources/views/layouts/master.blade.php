<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> @yield('title')</title>
    <!-- Tell the browser to be responsive to screen width -->





    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet"
          type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/themes/limitless/css/icons/icomoon/styles.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="{{ asset('assets/themes/limitless/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/themes/limitless/css/core.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/themes/limitless/css/components.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/themes/limitless/css/colors.css') }}">
    <!--  New added css -->
    <link rel="stylesheet" href="{{ asset('assets/themes/limitless/css/jquery.mCustomScrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/themes/limitless/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/themes/limitless/css/style2.css') }}">
    <!-- End new Added CSS -->

    <link rel="stylesheet" href="{{ asset('assets/style2.css') }}">
    <link rel="stylesheet" href="{{asset('assets/font/materialdesignicons-webfont.woff')}}">
    <link rel="stylesheet" href="{{asset('assets/font/materialdesignicons-webfont.woff2')}}">
    <link rel="stylesheet" href="{{asset('assets/font/materialdesignicons-webfont.ttf')}}">

    <link rel="stylesheet" href="{{ asset('assets/style2.css') }}">
    <link rel="stylesheet" href="{{asset('font/materialdesignicons-webfont.woff')}}">
    <link rel="stylesheet" href="{{asset('font/materialdesignicons-webfont.woff2')}}">
    <link rel="stylesheet" href="{{asset('font/materialdesignicons-webfont.ttf')}}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/2.4.85/fonts/materialdesignicons-webfont.woff">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/2.4.85/fonts/materialdesignicons-webfont.woff2">



    <link href="{{ asset('assets/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/plugins/bootstrap-toastr/toastr.min.css') }}" rel="stylesheet" type="text/css"/>
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
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

    <![endif]-->
    {{--Start Page header level scripts--}}
    @yield('page-header-scripts')
    {{--End Page level scripts--}}
</head>
  <body>
    <header class="headerSection">
      <div class="headerTopSection">
          <div class="container-fluid">
            <div class="row">
              <div class="col-xs-6 col-sm-5">
                <div class="logo">
                  <a href="{{url('dashboard-exchange')}}"><svg  xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="136px" height="18px">
                    <path fill-rule="evenodd"  fill="rgb(65, 147, 224)"  d="M135.341,13.079 L135.341,16.000 L125.459,16.000 L125.459,1.837 L134.981,1.837 L134.981,4.738 L128.760,4.738 L128.760,7.398 L134.641,7.398 L134.641,10.139 L128.760,10.139 L128.760,13.079 L135.341,13.079 ZM115.260,16.000 L109.979,16.000 L109.979,1.837 L115.100,1.837 C119.121,1.837 123.202,3.517 123.202,8.878 C123.202,13.860 119.161,16.000 115.260,16.000 ZM115.020,4.758 L113.320,4.758 L113.320,13.039 L114.940,13.039 C117.381,13.039 119.641,12.039 119.641,8.878 C119.641,5.698 117.381,4.758 115.020,4.758 ZM103.901,13.219 L98.420,13.219 L97.380,16.000 L93.722,16.000 L93.659,16.000 L89.721,16.000 L86.661,10.379 L85.500,10.379 L85.500,16.000 L82.140,16.000 L82.140,1.837 L87.541,1.837 C90.261,1.837 92.962,2.877 92.962,6.118 C92.962,8.018 91.842,9.379 90.021,9.939 L93.685,15.939 L99.600,1.837 L102.921,1.837 L108.802,16.000 L105.002,16.000 L103.901,13.219 ZM87.301,4.598 L85.480,4.598 L85.480,7.898 L87.101,7.898 C88.201,7.898 89.581,7.618 89.581,6.178 C89.581,4.858 88.321,4.598 87.301,4.598 ZM101.201,5.618 L99.400,10.479 L102.961,10.479 L101.201,5.618 ZM76.581,16.000 L73.160,16.000 L73.160,4.758 L69.160,4.758 L69.160,2.292 L64.021,9.999 L64.021,16.000 L60.601,16.000 L60.601,9.999 L55.280,1.837 L59.420,1.837 L62.441,7.078 L65.462,1.837 L69.160,1.837 L69.463,1.837 L80.582,1.837 L80.582,4.758 L76.581,4.758 L76.581,16.000 ZM53.362,16.000 L52.262,13.219 L46.781,13.219 L45.741,16.000 L42.020,16.000 L47.961,1.837 L51.282,1.837 L57.163,16.000 L53.362,16.000 ZM49.561,5.618 L47.761,10.479 L51.322,10.479 L49.561,5.618 ZM41.503,11.879 C41.503,14.960 38.802,16.000 36.102,16.000 L30.460,16.000 L30.460,1.837 L36.102,1.837 C38.302,1.837 40.923,2.617 40.923,5.478 C40.923,7.038 39.982,8.078 38.602,8.538 L38.602,8.578 C40.222,8.858 41.503,10.019 41.503,11.879 ZM35.441,4.558 L33.761,4.558 L33.761,7.478 L35.601,7.478 C36.882,7.478 37.622,6.938 37.622,5.938 C37.622,4.978 36.882,4.558 35.441,4.558 ZM35.661,9.999 L33.761,9.999 L33.761,13.239 L35.681,13.239 C36.762,13.239 38.082,12.939 38.082,11.559 C38.082,10.379 37.122,9.999 35.661,9.999 ZM18.188,17.576 C17.911,17.875 17.595,18.000 17.288,18.000 C16.278,18.000 15.365,16.647 16.272,15.668 L16.589,15.327 C15.259,15.233 13.979,14.896 12.796,14.130 C11.704,13.423 10.824,12.468 10.048,11.436 C9.776,11.074 9.516,10.703 9.264,10.329 C8.973,9.894 8.694,9.451 8.412,9.009 C7.819,8.078 7.214,7.157 6.446,6.352 C5.198,5.044 3.605,4.604 1.874,4.604 C1.689,4.604 1.503,4.609 1.315,4.619 C1.287,4.620 1.259,4.621 1.232,4.621 C-0.431,4.621 -0.395,2.008 1.315,1.921 C1.510,1.911 1.702,1.906 1.891,1.906 C5.500,1.906 8.028,3.695 10.049,6.581 C10.137,6.707 10.225,6.832 10.311,6.962 C10.762,7.641 11.187,8.336 11.640,9.009 C12.108,9.704 12.607,10.376 13.198,10.983 C14.237,12.051 15.422,12.490 16.721,12.614 C16.639,12.515 16.559,12.414 16.476,12.316 C16.001,11.754 15.921,10.962 16.476,10.408 C16.729,10.157 17.106,10.015 17.477,10.015 C17.822,10.015 18.162,10.137 18.391,10.408 C19.124,11.276 19.824,12.169 20.557,13.037 C21.034,13.515 21.217,14.309 20.626,14.946 L18.188,17.576 ZM18.391,7.609 C17.915,8.172 16.964,8.096 16.475,7.609 C15.921,7.056 16.001,6.264 16.475,5.702 C16.559,5.603 16.639,5.502 16.721,5.404 C15.421,5.528 14.237,5.967 13.198,7.035 C12.787,7.458 12.421,7.913 12.078,8.385 C11.891,8.101 11.705,7.812 11.517,7.518 C11.319,7.208 11.114,6.886 10.904,6.571 C10.774,6.374 10.641,6.185 10.508,5.999 C11.170,5.194 11.913,4.459 12.796,3.887 C13.979,3.122 15.259,2.785 16.589,2.691 L16.272,2.349 C15.090,1.073 17.001,-0.839 18.188,0.442 L20.626,3.072 C21.217,3.709 21.034,4.503 20.557,4.981 C19.824,5.848 19.124,6.742 18.391,7.609 ZM1.315,13.399 C3.261,13.497 5.064,13.113 6.446,11.665 C7.032,11.051 7.524,10.368 7.988,9.665 C8.210,10.013 8.438,10.371 8.673,10.722 C8.960,11.149 9.273,11.592 9.611,12.032 C7.554,14.709 4.971,16.281 1.315,16.096 C-0.423,16.008 -0.432,13.310 1.315,13.399 Z"/>
                  </svg></a>
                </div>
              </div>
              <div class="col-xs-6 col-sm-7">
                <div class="headerTopRightCol">
                  <div class="navbar-avatar-dd dropdown">
                    <span class="dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                      <span class="userName">{{ Sentinel::getUser()->first_name }} {{ Sentinel::getUser()->last_name }}</span>
                      <span class="avtarImg">
                        @if(Sentinel::getUser()->profile_pic=='')
                        <img src="{{ asset('assets/themes/limitless/images/user-image.jpg') }}" alt="..." class="img-preview">
                        @else
                         <img src="{{ asset('assets/profile/'.Sentinel::getUser()->profile_pic) }}" alt="..." class="img-preview">
                        @endif
                      </span>
                      <span class="rightTglIcon">
                        <span class="tglLine"></span>
                        <span class="tglLine"></span>
                        <span class="tglLine"></span>
                      </span>
                    </span>
                    <ul class="dropdown-menu dropdown-menu-right ddStle" aria-labelledby="dropdownMenu1">
                      <li><a href="{{ url('user/profile') }}"><span class="ddIcon"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="12px" height="16px">
                        <path fill-rule="evenodd"  fill="rgb(206, 206, 206)" d="M11.999,13.902 C12.000,13.652 12.001,13.866 11.999,13.902 ZM11.999,14.194 C11.999,14.194 11.115,16.000 6.000,16.000 C0.884,16.000 0.001,14.194 0.001,14.194 C0.001,13.984 0.000,13.864 0.000,13.799 C0.001,13.834 0.004,13.818 0.009,13.519 C0.077,9.853 0.591,8.797 4.260,8.125 C4.260,8.125 4.783,8.800 6.000,8.800 C7.217,8.800 7.739,8.125 7.739,8.125 C11.449,8.804 11.933,9.877 11.992,13.641 C11.996,13.882 11.998,13.923 11.999,13.902 C11.999,13.966 11.999,14.060 11.999,14.194 ZM6.000,7.825 C4.245,7.825 2.823,6.073 2.823,3.913 C2.823,1.752 3.290,-0.000 6.000,-0.000 C8.709,-0.000 9.176,1.752 9.176,3.913 C9.176,6.073 7.754,7.825 6.000,7.825 Z"/>
                      </svg></span> <span class="ddText">{{trans_choice('general.profile',1)}}</span></a></li>
                      <li><a href="javascript:void(0)"><span class="ddIcon"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="15px" height="16px">
                        <path fill-rule="evenodd"  fill="rgb(206, 206, 206)" d="M12.546,8.637 L12.546,12.736 C12.546,13.116 12.243,13.438 11.867,13.424 C11.492,13.424 11.189,13.116 11.189,12.736 L11.189,8.637 C11.189,8.256 11.492,7.949 11.867,7.949 C12.243,7.949 12.546,8.256 12.546,8.637 ZM14.899,10.950 C14.884,10.964 14.870,10.979 14.856,10.994 C14.798,11.521 14.552,12.004 14.191,12.370 C14.177,12.384 14.148,12.413 14.134,12.428 L14.134,12.487 L14.134,14.199 C14.134,14.434 14.119,14.639 14.061,14.814 C14.004,14.990 13.932,15.136 13.816,15.268 C13.701,15.400 13.556,15.502 13.397,15.561 C13.282,15.605 13.152,15.634 13.008,15.634 L12.863,15.634 L8.965,15.634 C8.850,15.854 8.633,16.000 8.373,16.000 L6.670,16.000 C6.294,16.000 5.991,15.693 5.991,15.312 C5.991,14.931 6.294,14.624 6.670,14.624 L8.388,14.624 C8.633,14.624 8.864,14.770 8.980,14.990 L12.878,14.990 L12.892,14.990 C12.993,15.005 13.094,14.990 13.166,14.961 C13.239,14.931 13.296,14.887 13.340,14.844 C13.397,14.785 13.426,14.712 13.455,14.609 C13.484,14.492 13.498,14.360 13.498,14.199 L13.498,12.867 C13.397,12.911 13.282,12.955 13.181,12.984 C13.195,12.897 13.210,12.823 13.210,12.736 L13.210,8.637 C13.210,8.549 13.195,8.461 13.181,8.388 C13.571,8.505 13.932,8.725 14.206,9.003 C14.235,9.032 14.264,9.061 14.292,9.091 L14.292,7.861 C14.292,7.451 14.264,7.056 14.191,6.661 C14.119,6.265 14.018,5.885 13.888,5.504 C13.744,5.138 13.585,4.772 13.383,4.421 C13.181,4.069 12.964,3.747 12.704,3.440 C12.676,3.411 12.661,3.381 12.647,3.352 C12.473,3.381 12.286,3.323 12.141,3.177 C10.871,1.888 9.196,1.230 7.522,1.230 C5.847,1.230 4.172,1.888 2.902,3.177 C2.757,3.323 2.570,3.381 2.368,3.352 C2.353,3.381 2.324,3.411 2.310,3.440 C2.050,3.747 1.833,4.069 1.631,4.421 C1.429,4.758 1.256,5.123 1.126,5.504 C0.996,5.870 0.895,6.265 0.823,6.661 C0.751,7.056 0.722,7.466 0.722,7.861 L0.722,9.076 C0.751,9.047 0.780,9.017 0.808,8.988 C1.097,8.695 1.444,8.490 1.833,8.373 C1.819,8.461 1.805,8.534 1.805,8.622 L1.805,12.721 C1.805,12.809 1.819,12.897 1.833,12.970 C1.444,12.853 1.083,12.633 0.808,12.355 C0.462,11.989 0.217,11.521 0.144,10.979 C0.130,10.964 0.115,10.950 0.101,10.935 C0.043,10.862 -0.000,10.774 -0.000,10.672 L-0.000,7.846 C-0.000,7.407 0.043,6.968 0.115,6.529 C0.202,6.090 0.318,5.665 0.462,5.241 C0.621,4.831 0.808,4.421 1.025,4.040 C1.242,3.660 1.487,3.294 1.776,2.957 C1.805,2.913 1.848,2.884 1.877,2.869 C1.833,2.664 1.877,2.459 2.036,2.298 C3.551,0.761 5.544,-0.000 7.522,-0.000 C9.499,-0.000 11.492,0.776 13.008,2.313 C13.152,2.474 13.210,2.679 13.166,2.884 C13.210,2.913 13.239,2.942 13.267,2.972 C13.542,3.308 13.802,3.674 14.018,4.055 C14.249,4.435 14.437,4.831 14.581,5.255 C14.726,5.665 14.841,6.104 14.884,6.543 C14.957,6.968 15.000,7.422 15.000,7.861 L15.000,10.686 C15.000,10.789 14.971,10.876 14.899,10.950 ZM3.176,7.963 C3.551,7.963 3.855,8.271 3.855,8.651 L3.855,12.750 C3.855,13.131 3.551,13.438 3.176,13.438 C2.801,13.438 2.498,13.116 2.498,12.750 L2.498,8.651 C2.498,8.271 2.801,7.963 3.176,7.963 Z"/>
                      </svg></span> <span class="ddText">Contact Support</span></a></li>
                      <li><a href="{{ url('logout') }}"><span class="ddIcon"><svg  xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="22px" height="16px">
                        <path fill-rule="evenodd"  fill="rgb(206, 206, 206)" d="M13.820,16.000 C11.098,16.000 8.563,14.682 7.037,12.473 C6.728,12.026 6.849,11.418 7.306,11.116 C7.764,10.813 8.385,10.931 8.695,11.379 C9.848,13.047 11.764,14.044 13.820,14.044 C17.228,14.044 20.000,11.333 20.000,8.000 C20.000,4.667 17.228,1.956 13.820,1.956 C11.758,1.956 9.838,2.957 8.686,4.633 C8.378,5.082 7.757,5.201 7.299,4.900 C6.840,4.598 6.718,3.991 7.026,3.542 C8.551,1.324 11.090,-0.000 13.820,-0.000 C18.330,-0.000 22.000,3.589 22.000,8.000 C22.000,12.411 18.330,16.000 13.820,16.000 ZM3.414,7.022 L15.000,7.022 C15.552,7.022 16.000,7.460 16.000,8.000 C16.000,8.540 15.552,8.978 15.000,8.978 L3.414,8.978 L4.707,10.242 C5.097,10.624 5.097,11.243 4.707,11.625 C4.512,11.816 4.256,11.912 4.000,11.912 C3.744,11.912 3.488,11.816 3.293,11.625 L0.293,8.692 C0.270,8.669 0.248,8.645 0.227,8.621 C0.222,8.615 0.218,8.608 0.213,8.602 C0.198,8.583 0.183,8.564 0.169,8.544 C0.165,8.538 0.162,8.532 0.158,8.526 C0.144,8.505 0.131,8.484 0.118,8.461 C0.116,8.457 0.114,8.453 0.112,8.448 C0.099,8.424 0.087,8.400 0.076,8.375 C0.075,8.372 0.074,8.369 0.073,8.366 C0.062,8.339 0.052,8.312 0.043,8.285 C0.042,8.282 0.042,8.278 0.041,8.275 C0.033,8.248 0.025,8.221 0.020,8.192 C0.018,8.184 0.017,8.176 0.016,8.168 C0.012,8.145 0.007,8.121 0.005,8.098 C0.002,8.065 -0.000,8.033 -0.000,8.000 C-0.000,7.967 0.002,7.935 0.005,7.902 C0.007,7.879 0.011,7.856 0.016,7.833 C0.017,7.824 0.018,7.816 0.020,7.807 C0.025,7.780 0.033,7.752 0.041,7.725 C0.042,7.722 0.042,7.718 0.043,7.715 C0.052,7.687 0.062,7.661 0.073,7.634 C0.074,7.631 0.075,7.628 0.076,7.625 C0.087,7.600 0.099,7.576 0.112,7.552 C0.114,7.547 0.116,7.543 0.118,7.538 C0.130,7.516 0.144,7.495 0.158,7.474 C0.162,7.468 0.165,7.462 0.169,7.456 C0.183,7.436 0.198,7.417 0.213,7.398 C0.218,7.392 0.222,7.385 0.227,7.379 C0.248,7.355 0.270,7.331 0.293,7.308 L3.293,4.374 C3.683,3.992 4.317,3.992 4.707,4.374 C5.098,4.756 5.098,5.376 4.707,5.758 L3.414,7.022 Z"/>
                      </svg></span> <span class="ddText">{{trans_choice('general.logout',1)}}</span></a></li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
      </div>
      <div class="orderTriggerMain">
        <div class="orderTrigger">
          <span>ORDERS</span>
          <span class="orderTglIcon">
            <svg class="orderTglIcon" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="20px" height="20px">
              <path fill-rule="evenodd" fill="rgb(143, 163, 183)" d="M19.067,6.356 L3.100,6.356 L6.090,9.351 C6.444,9.707 6.444,10.282 6.090,10.638 C5.912,10.815 5.680,10.904 5.448,10.904 C5.215,10.904 4.983,10.815 4.806,10.638 L0.266,6.090 C-0.089,5.735 -0.089,5.159 0.266,4.803 L4.806,0.255 C5.160,-0.100 5.735,-0.100 6.090,0.255 C6.444,0.611 6.444,1.187 6.090,1.542 L3.100,4.537 L19.067,4.537 C19.569,4.537 19.975,4.944 19.975,5.447 C19.975,5.949 19.569,6.356 19.067,6.356 ZM0.908,13.633 L16.875,13.633 L13.885,10.638 C13.531,10.282 13.531,9.706 13.885,9.351 C14.240,8.996 14.815,8.996 15.169,9.351 L19.710,13.899 C20.064,14.254 20.064,14.830 19.710,15.186 L15.169,19.733 C14.992,19.911 14.760,20.000 14.527,20.000 C14.295,20.000 14.063,19.911 13.885,19.734 C13.531,19.378 13.531,18.802 13.885,18.447 L16.875,15.452 L0.908,15.452 C0.406,15.452 -0.000,15.045 -0.000,14.542 C-0.000,14.040 0.406,13.633 0.908,13.633 Z"></path>
            </svg>
          </span>
        </div>
      </div>
      <div class="navSection">
        <nav class="navbar navbar-default">
          <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header navbar-toggle-left">
              <button type="button" class="navbar-toggle navTglStyle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar top-bar"></span>
                <span class="icon-bar middle-bar"></span>
                <span class="icon-bar bottom-bar"></span>
              </button>
              <span class="navMenuTag">MENU</span>
            </div>
            <?php
                $usd = \App\Models\TradeCurrency::where('default_currency', 1)->first();
                $btc = \App\Models\TradeCurrency::where('network', "bitcoin")->first();
                $dogecoin = \App\Models\TradeCurrency::where('network', "dogecoin")->first();
                $ltc = \App\Models\TradeCurrency::where('network', "litecoin")->first();
                $xrp = \App\Models\TradeCurrency::where('network', "ripple")->first();
                $eth = \App\Models\TradeCurrency::where('network', "ethereum")->first();
            ?>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
              <ul class="nav navbar-nav navStyle">
                @if(Sentinel::inRole('client'))
                @include('left_menu.client')
                @else
                    @include('left_menu.admin')
                @endif
              </ul>
            </div><!-- /.navbar-collapse -->
          </div><!-- /.container -->
        </nav>
      </div>

    </header>


    <!--
    <section>
      <div class="sidebarContent mCustomScrollbar">
        <div class="sideBarTitle"><h4>ORDERS</h4></div>
        <div class="sidebarOptions">
          <?php

                            $current_btc = \App\Models\OrderBook::where('order_type', 'ask')->where('network',
                                'bitcoin')->where('status', 'done')->orderBy('updated_at', 'desc')->first();
                            if (!empty($current_btc)) {
                                $current_btc = $current_btc->amount;
                            } else {
                                $current_btc = 0;
                            }
                            $current_dogecoin = \App\Models\OrderBook::where('order_type', 'ask')->where('network',
                                'dogecoin')->where('status', 'done')->orderBy('updated_at', 'desc')->first();
                            if (!empty($current_dogecoin)) {
                                $current_dogecoin = $current_dogecoin->amount;
                            } else {
                                $current_dogecoin = 0;
                            }
                            $current_ltc = \App\Models\OrderBook::where('order_type', 'ask')->where('network',
                                'litecoin')->where('status', 'done')->orderBy('updated_at', 'desc')->first();
                            if (!empty($current_ltc)) {
                                $current_ltc = $current_ltc->amount;
                            } else {
                                $current_ltc = 0;
                            }
                            $current_xrp = \App\Models\OrderBook::where('order_type', 'ask')->where('network',
                                'ripple')->where('status', 'done')->orderBy('updated_at', 'desc')->first();
                            if (!empty($current_xrp)) {
                                $current_xrp = $current_xrp->amount;
                            } else {
                                $current_xrp = 0;
                            }
                            $current_eth = \App\Models\OrderBook::where('order_type', 'ask')->where('network',
                                'ethereum')->where('status', 'done')->orderBy('updated_at', 'desc')->first();
                            if (!empty($current_eth)) {
                                $current_eth = $current_eth->amount;
                            } else {
                                $current_eth = 0;
                            }
                ?>
          <ul>
            <li><a href="{{url('market/data?market=btcusd')}}"><span>{{number_format($current_btc,2)}}</span>{{$btc->xml_code}}/{{$usd->xml_code}}</a></li>
            <li><a href="{{url('market/data?market=ltcusd')}}"><span>{{number_format($current_ltc,2)}}</span>{{$ltc->xml_code}}/{{$usd->xml_code}}</a></li>
            <li><a href="{{url('market/data?market=dogecoinusd')}}"><span>{{number_format($current_dogecoin,2)}}</span>{{$dogecoin->xml_code}}/{{$usd->xml_code}}</a></li>
            <li><a href="{{url('market/data?market=xrpusd')}}"><span>{{number_format($current_xrp,2)}}</span>{{$xrp->xml_code}}/{{$usd->xml_code}}</a></li>
            <li><a href="{{url('market/data?market=ethusd')}}"><span>{{number_format($current_eth,2)}}</span>{{$eth->xml_code}}/{{$usd->xml_code}}</a></li>
          </ul>
        </div>
      </div>
    </section>

    -->
    <div class="content">
                @if (!empty(\App\Models\Setting::where('setting_key','announcement')->first()->setting_value) && Sentinel::inRole('client'))
                    <div class="row">
                        <div class="col-md-12">
                            <div class="alert alert-{{\App\Models\Setting::where('setting_key','announcement_type')->first()->setting_value}}">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;
                                </button>
                                {!! \App\Models\Setting::where('setting_key','announcement')->first()->setting_value !!}
                            </div>
                        </div>
                    </div>
                @endif
                <section class="">
                    @if(Session::has('flash_notification.message'))
                        <script>toastr.{{ Session::get('flash_notification.level') }}('{{ Session::get("flash_notification.message") }}', 'Response Status')</script>
                    @endif
                    @if (isset($msg))
                        <div class="alert alert-success">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            {{ $msg }}
                        </div>
                    @endif
                    @if (isset($error))
                        <div class="alert alert-error">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            {{ $error }}
                        </div>
                    @endif
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
<!--- Add content -->
    @yield('content')
  </section>
</div>
    
          <div class="footerSection">
            <div class="container">
              <div class="row">
                <div class="col-md-4">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="footerLogo">
                        <a href="{{url('dashboard-exchange')}}"><svg  xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="136px" height="18px">
                          <path fill-rule="evenodd"  fill="rgb(65, 147, 224)" d="M135.341,13.079 L135.341,16.000 L125.459,16.000 L125.459,1.837 L134.981,1.837 L134.981,4.738 L128.760,4.738 L128.760,7.398 L134.641,7.398 L134.641,10.139 L128.760,10.139 L128.760,13.079 L135.341,13.079 ZM115.260,16.000 L109.979,16.000 L109.979,1.837 L115.100,1.837 C119.121,1.837 123.202,3.517 123.202,8.878 C123.202,13.860 119.161,16.000 115.260,16.000 ZM115.020,4.758 L113.320,4.758 L113.320,13.039 L114.940,13.039 C117.381,13.039 119.641,12.039 119.641,8.878 C119.641,5.698 117.381,4.758 115.020,4.758 ZM103.901,13.219 L98.420,13.219 L97.380,16.000 L93.722,16.000 L93.659,16.000 L89.721,16.000 L86.661,10.379 L85.500,10.379 L85.500,16.000 L82.140,16.000 L82.140,1.837 L87.541,1.837 C90.261,1.837 92.962,2.877 92.962,6.118 C92.962,8.018 91.842,9.379 90.021,9.939 L93.685,15.939 L99.600,1.837 L102.921,1.837 L108.802,16.000 L105.002,16.000 L103.901,13.219 ZM87.301,4.598 L85.480,4.598 L85.480,7.898 L87.101,7.898 C88.201,7.898 89.581,7.618 89.581,6.178 C89.581,4.858 88.321,4.598 87.301,4.598 ZM101.201,5.618 L99.400,10.479 L102.961,10.479 L101.201,5.618 ZM76.581,16.000 L73.160,16.000 L73.160,4.758 L69.160,4.758 L69.160,2.292 L64.021,9.999 L64.021,16.000 L60.601,16.000 L60.601,9.999 L55.280,1.837 L59.420,1.837 L62.441,7.078 L65.462,1.837 L69.160,1.837 L69.463,1.837 L80.582,1.837 L80.582,4.758 L76.581,4.758 L76.581,16.000 ZM53.362,16.000 L52.262,13.219 L46.781,13.219 L45.741,16.000 L42.020,16.000 L47.961,1.837 L51.282,1.837 L57.163,16.000 L53.362,16.000 ZM49.561,5.618 L47.761,10.479 L51.322,10.479 L49.561,5.618 ZM41.503,11.879 C41.503,14.960 38.802,16.000 36.102,16.000 L30.460,16.000 L30.460,1.837 L36.102,1.837 C38.302,1.837 40.923,2.617 40.923,5.478 C40.923,7.038 39.982,8.078 38.602,8.538 L38.602,8.578 C40.222,8.858 41.503,10.019 41.503,11.879 ZM35.441,4.558 L33.761,4.558 L33.761,7.478 L35.601,7.478 C36.882,7.478 37.622,6.938 37.622,5.938 C37.622,4.978 36.882,4.558 35.441,4.558 ZM35.661,9.999 L33.761,9.999 L33.761,13.239 L35.681,13.239 C36.762,13.239 38.082,12.939 38.082,11.559 C38.082,10.379 37.122,9.999 35.661,9.999 ZM18.188,17.576 C17.911,17.875 17.595,18.000 17.288,18.000 C16.278,18.000 15.365,16.647 16.272,15.668 L16.589,15.327 C15.259,15.233 13.979,14.896 12.796,14.130 C11.704,13.423 10.824,12.468 10.048,11.436 C9.776,11.074 9.516,10.703 9.264,10.329 C8.973,9.894 8.694,9.451 8.412,9.009 C7.819,8.078 7.214,7.157 6.446,6.352 C5.198,5.044 3.605,4.604 1.874,4.604 C1.689,4.604 1.503,4.609 1.315,4.619 C1.287,4.620 1.259,4.621 1.232,4.621 C-0.431,4.621 -0.395,2.008 1.315,1.921 C1.510,1.911 1.702,1.906 1.891,1.906 C5.500,1.906 8.028,3.695 10.049,6.581 C10.137,6.707 10.225,6.832 10.311,6.962 C10.762,7.641 11.187,8.336 11.640,9.009 C12.108,9.704 12.607,10.376 13.198,10.983 C14.237,12.051 15.422,12.490 16.721,12.614 C16.639,12.515 16.559,12.414 16.476,12.316 C16.001,11.754 15.921,10.962 16.476,10.408 C16.729,10.157 17.106,10.015 17.477,10.015 C17.822,10.015 18.162,10.137 18.391,10.408 C19.124,11.276 19.824,12.169 20.557,13.037 C21.034,13.515 21.217,14.309 20.626,14.946 L18.188,17.576 ZM18.391,7.609 C17.915,8.172 16.964,8.096 16.475,7.609 C15.921,7.056 16.001,6.264 16.475,5.702 C16.559,5.603 16.639,5.502 16.721,5.404 C15.421,5.528 14.237,5.967 13.198,7.035 C12.787,7.458 12.421,7.913 12.078,8.385 C11.891,8.101 11.705,7.812 11.517,7.518 C11.319,7.208 11.114,6.886 10.904,6.571 C10.774,6.374 10.641,6.185 10.508,5.999 C11.170,5.194 11.913,4.459 12.796,3.887 C13.979,3.122 15.259,2.785 16.589,2.691 L16.272,2.349 C15.090,1.073 17.001,-0.839 18.188,0.442 L20.626,3.072 C21.217,3.709 21.034,4.503 20.557,4.981 C19.824,5.848 19.124,6.742 18.391,7.609 ZM1.315,13.399 C3.261,13.497 5.064,13.113 6.446,11.665 C7.032,11.051 7.524,10.368 7.988,9.665 C8.210,10.013 8.438,10.371 8.673,10.722 C8.960,11.149 9.273,11.592 9.611,12.032 C7.554,14.709 4.971,16.281 1.315,16.096 C-0.423,16.008 -0.432,13.310 1.315,13.399 Z"/>
                        </svg></a>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="socialLinks">
                        <ul>
                          <li><a href="javascript:void(0)"><svg class="socialIcon" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="8px" height="14px">
                            <path fill-rule="evenodd"  fill="rgb(190, 202, 213)" d="M7.261,0.003 L5.451,-0.000 C3.418,-0.000 2.104,1.352 2.104,3.445 L2.104,5.034 L0.285,5.034 C0.127,5.034 0.000,5.162 0.000,5.320 L0.000,7.621 C0.000,7.779 0.128,7.907 0.285,7.907 L2.104,7.907 L2.104,13.715 C2.104,13.872 2.232,14.000 2.389,14.000 L4.763,14.000 C4.920,14.000 5.047,13.872 5.047,13.715 L5.047,7.907 L7.175,7.907 C7.332,7.907 7.459,7.779 7.459,7.621 L7.460,5.320 C7.460,5.244 7.430,5.171 7.377,5.118 C7.324,5.064 7.251,5.034 7.176,5.034 L5.048,5.034 L5.048,3.687 C5.048,3.040 5.201,2.711 6.042,2.711 L7.261,2.711 C7.418,2.711 7.545,2.583 7.545,2.425 L7.545,0.288 C7.545,0.131 7.418,0.003 7.261,0.003 Z"/>
                          </svg></a></li>
                          <li><a href="javascript:void(0)"><svg class="socialIcon"  xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="15px" height="14px">
                            <path fill-rule="evenodd"  fill="rgb(190, 202, 213)" d="M2.526,-0.001 L13.121,-0.001 C14.127,-0.001 14.950,0.731 14.950,1.796 L14.950,12.203 C14.950,13.269 14.127,14.000 13.121,14.000 L2.526,14.000 C1.519,14.000 0.696,13.269 0.696,12.203 L0.696,1.796 C0.696,0.731 1.519,-0.001 2.526,-0.001 L2.526,-0.001 ZM11.079,1.555 C10.726,1.555 10.438,1.838 10.438,2.185 L10.438,3.694 C10.438,4.041 10.726,4.324 11.079,4.324 L12.691,4.324 C13.043,4.324 13.332,4.041 13.332,3.694 L13.332,2.185 C13.332,1.838 13.043,1.555 12.691,1.555 L11.079,1.555 L11.079,1.555 ZM13.339,5.920 L12.084,5.920 C12.203,6.301 12.267,6.704 12.267,7.121 C12.267,9.450 10.284,11.338 7.837,11.338 C5.390,11.338 3.406,9.450 3.406,7.121 C3.406,6.704 3.470,6.301 3.589,5.920 L2.280,5.920 L2.280,11.835 C2.280,12.141 2.535,12.391 2.847,12.391 L12.773,12.391 C13.084,12.391 13.339,12.141 13.339,11.835 L13.339,5.920 L13.339,5.920 ZM7.836,4.245 C6.256,4.245 4.974,5.465 4.974,6.970 C4.974,8.474 6.256,9.694 7.836,9.694 C9.417,9.694 10.699,8.474 10.699,6.970 C10.699,5.465 9.418,4.245 7.836,4.245 Z"/>
                          </svg></a></li>
                          <li><a href="javascript:void(0)"><svg class="socialIcon"  xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="15px" height="14px">
                            <path fill-rule="evenodd"  fill="rgb(190, 202, 213)" d="M14.992,8.735 C14.988,7.694 14.984,6.942 14.457,6.280 C13.859,5.531 12.938,5.404 12.191,5.383 C12.316,4.859 12.353,4.279 12.295,3.652 C12.279,1.562 10.678,0.060 8.455,0.001 L8.423,0.000 L5.024,0.003 L4.988,0.003 C3.666,0.003 2.621,0.386 1.882,1.141 C1.424,1.609 0.817,2.425 0.752,3.745 L0.750,9.069 C0.743,9.170 0.753,9.271 0.752,9.375 C0.752,10.890 1.002,11.980 1.781,12.786 C2.560,13.591 3.712,14.000 5.205,14.000 C5.237,14.000 5.270,14.000 5.302,13.999 L10.495,13.999 L10.507,13.999 C11.839,13.989 12.964,13.562 13.761,12.766 C14.557,11.971 14.985,10.838 15.000,9.491 C14.999,9.491 14.993,8.948 14.992,8.735 ZM5.300,2.839 L8.204,2.836 C8.888,2.847 9.435,3.442 9.424,4.106 C9.413,4.764 8.860,5.244 8.185,5.244 C8.178,5.244 5.260,5.246 5.260,5.246 C4.576,5.235 4.030,4.688 4.041,4.023 C4.052,3.359 4.614,2.833 5.300,2.839 ZM10.759,10.760 L4.950,10.760 C4.266,10.760 3.711,10.221 3.711,9.556 C3.711,8.892 4.266,8.353 4.950,8.353 L10.759,8.353 C11.443,8.353 11.998,8.892 11.998,9.556 C11.998,10.221 11.443,10.760 10.759,10.760 Z"/>
                          </svg></a></li>
                        </ul>
                      </div>
                    </div>

                  </div>
                </div>
                <div class="col-md-8">
                  <div class="row">
                    <div class="col-sm-6 col-lg-7">
                      <div class="footerLinks">
                        <ul>
                          <li><a href="javascript:void(0)">Press</a></li>
                          <li><a href="javascript:void(0)">Legal and Privacy</a></li>
                          <li><a href="javascript:void(0)">Support</a></li>
                          <li><a href="javascript:void(0)">Contact Us</a></li>
                        </ul>
                      </div>
                    </div>
                    <div class="col-sm-6 col-lg-5">
                      <div class="copyright"><p>Copyright © {{ date("Y") }} by <a href="{{ \App\Models\Setting::where('setting_key','company_website')->first()->setting_value }}" target="_blank">{{ \App\Models\Setting::where('setting_key','company_name')->first()->setting_value }}</a></p></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        

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

        {{--<script src="{{ asset('assets/themes/limitless/js/plugins/loaders/pace.min.js') }}"></script>--}}
        {{--<script src="{{ asset('assets/themes/limitless/js/plugins/loaders/blockui.min.js') }}"></script>--}}
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

</script>
      </body>
    </html>