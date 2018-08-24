<li class="@if(Request::is('dashboard')) active @endif"><a href="{{ url('dashboard') }}"> <svg class="navIcon"  xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="19px" height="15px">
                  <path fill-rule="evenodd"  fill="rgb(60, 144, 223)"  d="M17.390,14.672 C17.249,14.883 17.014,15.000 16.773,15.000 C16.665,15.000 16.557,14.977 16.454,14.928 L14.896,14.191 C14.526,14.016 14.368,13.576 14.545,13.209 C14.721,12.841 15.164,12.685 15.534,12.860 L16.490,13.313 C17.163,12.123 17.516,10.795 17.516,9.435 C17.516,8.294 17.278,7.194 16.810,6.163 C16.641,5.792 16.807,5.356 17.181,5.188 C17.554,5.021 17.994,5.186 18.163,5.557 C18.718,6.779 19.000,8.084 19.000,9.435 C19.000,11.297 18.443,13.108 17.390,14.672 ZM11.074,10.998 C10.640,11.430 10.070,11.645 9.500,11.645 C8.930,11.645 8.360,11.430 7.926,10.998 C7.057,10.136 7.057,8.733 7.926,7.871 C8.524,7.277 14.095,3.496 15.205,2.745 C15.500,2.545 15.896,2.582 16.148,2.832 C16.400,3.083 16.437,3.476 16.236,3.769 C15.479,4.872 11.673,10.404 11.074,10.998 ZM8.975,8.914 C8.686,9.201 8.686,9.669 8.975,9.956 C9.264,10.243 9.735,10.243 10.025,9.956 C10.255,9.725 11.382,8.155 12.735,6.222 C10.789,7.565 9.208,8.685 8.975,8.914 ZM12.794,2.175 C11.982,1.811 11.126,1.587 10.242,1.507 L10.242,2.617 C10.242,3.024 9.910,3.354 9.500,3.354 C9.090,3.354 8.758,3.024 8.758,2.617 L8.758,1.508 C6.179,1.744 3.950,3.199 2.661,5.286 L3.698,5.780 C4.068,5.956 4.223,6.396 4.046,6.763 C3.919,7.027 3.653,7.181 3.376,7.181 C3.269,7.181 3.159,7.158 3.056,7.109 L2.006,6.609 C1.669,7.487 1.484,8.440 1.484,9.435 C1.484,10.793 1.836,12.119 2.506,13.307 L3.423,12.863 C3.791,12.685 4.235,12.837 4.415,13.202 C4.595,13.568 4.442,14.010 4.073,14.188 L2.552,14.925 C2.448,14.976 2.337,15.000 2.227,15.000 C1.986,15.000 1.751,14.883 1.609,14.672 C0.557,13.108 -0.000,11.297 -0.000,9.435 C-0.000,6.915 0.988,4.545 2.782,2.763 C4.577,0.981 6.962,-0.000 9.500,-0.000 C10.860,-0.000 12.174,0.280 13.405,0.831 C13.779,0.999 13.945,1.436 13.776,1.807 C13.607,2.178 13.168,2.343 12.794,2.175 Z"/>
                </svg> <span class="navText">{{trans_choice('general.dashboard',1)}}</span></a></li>
                <li class="@if(Request::is('wallets/*')) active @endif"><a href="{{ url('wallets/btc') }}"> <svg  class="navIcon"  xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="19px" height="19px">
                  <path fill-rule="evenodd"  fill="rgb(143, 163, 183)" d="M17.144,19.000 L15.158,19.000 C15.152,19.000 15.146,19.000 15.141,19.000 L1.855,19.000 C0.832,19.000 -0.000,18.168 -0.000,17.145 L-0.000,6.994 C-0.000,6.984 0.001,6.973 0.001,6.963 C0.001,6.943 -0.000,6.922 -0.000,6.902 C-0.000,6.042 0.699,5.343 1.559,5.343 L2.468,5.343 L3.826,0.275 C3.879,0.077 4.083,-0.041 4.281,0.012 L9.644,1.450 L10.985,0.108 C11.130,-0.036 11.365,-0.036 11.510,0.108 L16.744,5.343 L17.144,5.343 C18.168,5.343 19.000,6.175 19.000,7.198 L19.000,17.144 C19.000,18.167 18.168,19.000 17.144,19.000 ZM1.559,6.085 C1.108,6.085 0.742,6.451 0.742,6.902 C0.742,7.352 1.108,7.718 1.559,7.718 L1.832,7.718 L2.269,6.085 L1.559,6.085 ZM4.447,0.825 L2.600,7.718 L3.097,7.718 L4.395,2.874 C4.448,2.676 4.651,2.559 4.849,2.612 C5.048,2.665 5.256,2.638 5.434,2.535 C5.612,2.432 5.740,2.266 5.793,2.067 C5.819,1.972 5.881,1.891 5.966,1.842 C6.051,1.793 6.152,1.779 6.248,1.805 L8.646,2.448 L9.038,2.056 L4.447,0.825 ZM4.045,7.049 L5.616,5.477 L8.040,3.053 L6.370,2.606 C6.238,2.842 6.045,3.039 5.805,3.178 C5.565,3.316 5.297,3.385 5.028,3.381 L4.045,7.049 ZM11.247,0.896 L10.017,2.126 C10.017,2.126 10.017,2.126 10.017,2.126 L4.437,7.706 L5.116,7.706 L10.178,2.644 C10.323,2.499 10.558,2.499 10.703,2.644 C11.003,2.945 11.492,2.945 11.792,2.644 C11.937,2.499 12.172,2.499 12.317,2.644 L14.352,4.679 C14.497,4.824 14.497,5.059 14.352,5.204 C14.051,5.504 14.051,5.993 14.352,6.293 C14.497,6.438 14.497,6.673 14.352,6.818 L13.464,7.706 L14.143,7.706 L16.100,5.748 L11.247,0.896 ZM8.925,6.312 C9.772,6.312 10.482,6.910 10.655,7.706 L12.414,7.706 L13.597,6.523 C13.314,6.048 13.314,5.449 13.597,4.974 L12.022,3.399 C11.547,3.682 10.948,3.682 10.473,3.399 L6.166,7.706 L7.195,7.706 C7.368,6.910 8.078,6.312 8.925,6.312 ZM7.968,7.706 L9.882,7.706 C9.731,7.325 9.359,7.054 8.925,7.054 C8.491,7.054 8.119,7.325 7.968,7.706 ZM18.258,7.198 C18.258,6.585 17.758,6.085 17.144,6.085 L16.813,6.085 L15.179,7.719 C16.185,7.740 16.996,8.563 16.996,9.573 L16.996,11.052 L17.378,11.052 C17.863,11.052 18.258,10.658 18.258,10.173 L18.258,7.198 ZM18.258,11.534 C18.004,11.698 17.702,11.794 17.378,11.794 L13.571,11.794 C13.366,11.794 13.199,11.628 13.199,11.423 C13.199,11.218 13.366,11.052 13.571,11.052 L16.254,11.052 L16.254,9.573 C16.254,8.960 15.754,8.460 15.141,8.460 L1.559,8.460 C1.259,8.460 0.980,8.375 0.742,8.229 L0.742,17.145 C0.742,17.733 1.202,18.217 1.781,18.255 L1.781,14.079 C1.781,13.874 1.947,13.708 2.152,13.708 C2.357,13.708 2.523,13.874 2.523,14.079 L2.523,18.258 L15.158,18.258 C15.764,18.249 16.254,17.753 16.254,17.145 L16.254,15.654 L9.426,15.654 C8.157,15.654 7.125,14.621 7.125,13.353 C7.125,12.084 8.157,11.052 9.426,11.052 L10.550,11.052 C10.755,11.052 10.922,11.218 10.922,11.423 C10.922,11.628 10.755,11.794 10.550,11.794 L9.426,11.794 C8.566,11.794 7.867,12.493 7.867,13.353 C7.867,14.212 8.566,14.911 9.426,14.911 L17.219,14.911 C17.792,14.911 18.258,14.445 18.258,13.872 L18.258,11.534 ZM18.258,15.318 C17.965,15.529 17.606,15.654 17.219,15.654 L16.996,15.654 L16.996,17.145 C16.996,17.562 16.858,17.947 16.624,18.257 L17.144,18.257 C17.758,18.257 18.258,17.758 18.258,17.144 L18.258,15.318 ZM12.128,11.794 C12.030,11.794 11.934,11.754 11.865,11.685 C11.796,11.616 11.757,11.520 11.757,11.423 C11.757,11.325 11.796,11.229 11.865,11.161 C11.934,11.091 12.030,11.052 12.128,11.052 C12.225,11.052 12.321,11.091 12.390,11.161 C12.459,11.229 12.499,11.325 12.499,11.423 C12.499,11.520 12.459,11.616 12.390,11.685 C12.321,11.754 12.225,11.794 12.128,11.794 ZM2.152,13.003 C2.055,13.003 1.959,12.963 1.890,12.894 C1.821,12.825 1.781,12.729 1.781,12.631 C1.781,12.534 1.821,12.438 1.890,12.369 C1.959,12.300 2.055,12.260 2.152,12.260 C2.250,12.260 2.346,12.300 2.415,12.369 C2.484,12.438 2.523,12.534 2.523,12.631 C2.523,12.729 2.484,12.825 2.415,12.894 C2.346,12.963 2.250,13.003 2.152,13.003 ZM9.411,14.320 C8.879,14.320 8.447,13.887 8.447,13.355 C8.447,12.823 8.879,12.390 9.411,12.390 C9.943,12.390 10.376,12.823 10.376,13.355 C10.376,13.887 9.943,14.320 9.411,14.320 ZM9.411,13.133 C9.289,13.133 9.189,13.232 9.189,13.355 C9.189,13.478 9.289,13.578 9.411,13.578 C9.534,13.578 9.634,13.478 9.634,13.355 C9.634,13.232 9.534,13.133 9.411,13.133 Z"/>
                </svg> <span class="navText">{{trans_choice('general.wallet',2)}}</span></a></li>
                <li class="@if(Request::is('trade/*')) active @endif"><a href="{{ url('trade/data') }}"> <svg  class="navIcon"  xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="20px" height="20px">
                  <path fill-rule="evenodd"  fill="rgb(143, 163, 183)"  d="M19.067,6.356 L3.100,6.356 L6.090,9.351 C6.444,9.707 6.444,10.282 6.090,10.638 C5.912,10.815 5.680,10.904 5.448,10.904 C5.215,10.904 4.983,10.815 4.806,10.638 L0.266,6.090 C-0.089,5.735 -0.089,5.159 0.266,4.803 L4.806,0.255 C5.160,-0.100 5.735,-0.100 6.090,0.255 C6.444,0.611 6.444,1.187 6.090,1.542 L3.100,4.537 L19.067,4.537 C19.569,4.537 19.975,4.944 19.975,5.447 C19.975,5.949 19.569,6.356 19.067,6.356 ZM0.908,13.633 L16.875,13.633 L13.885,10.638 C13.531,10.282 13.531,9.706 13.885,9.351 C14.240,8.996 14.815,8.996 15.169,9.351 L19.710,13.899 C20.064,14.254 20.064,14.830 19.710,15.186 L15.169,19.733 C14.992,19.911 14.760,20.000 14.527,20.000 C14.295,20.000 14.063,19.911 13.885,19.734 C13.531,19.378 13.531,18.802 13.885,18.447 L16.875,15.452 L0.908,15.452 C0.406,15.452 -0.000,15.045 -0.000,14.542 C-0.000,14.040 0.406,13.633 0.908,13.633 Z"/>
                </svg> <span class="navText">{{trans_choice('general.buy_sell',1)}}</span></a></li>
                <li class="@if(Request::is('dashboard-exchange/*')) active @endif"><a href="{{ url('dashboard-exchange') }}" target="_blank"> <svg  class="navIcon"  xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="21px" height="21px">
                  <path fill-rule="evenodd"  fill="rgb(143, 163, 183)"  d="M19.493,15.463 L20.386,16.353 C20.547,16.514 20.609,16.750 20.546,16.969 C20.483,17.188 20.306,17.356 20.083,17.408 L17.073,18.105 C17.026,18.116 16.978,18.122 16.930,18.122 C16.765,18.122 16.605,18.057 16.485,17.938 C16.332,17.785 16.268,17.563 16.317,17.352 L17.017,14.352 C17.069,14.130 17.237,13.953 17.457,13.891 C17.677,13.828 17.914,13.889 18.075,14.050 L18.576,14.549 C20.541,11.170 20.006,6.865 17.185,4.054 C17.169,4.037 17.153,4.020 17.139,4.002 C16.922,3.731 16.966,3.336 17.237,3.120 C17.493,2.916 17.858,2.943 18.082,3.172 C19.748,4.836 20.772,7.040 20.966,9.380 C21.143,11.518 20.621,13.658 19.493,15.463 ZM17.987,15.737 L17.773,16.655 L18.694,16.441 L17.987,15.737 ZM10.889,21.000 C8.089,21.000 5.811,18.729 5.811,15.938 C5.811,13.147 8.089,10.876 10.889,10.876 C13.690,10.876 15.968,13.146 15.968,15.938 C15.968,18.729 13.690,21.000 10.889,21.000 ZM10.889,12.131 C8.783,12.131 7.070,13.838 7.070,15.938 C7.070,18.037 8.783,19.745 10.889,19.745 C12.996,19.745 14.709,18.037 14.709,15.938 C14.709,13.838 12.996,12.131 10.889,12.131 ZM11.970,14.587 C11.828,14.454 11.594,14.295 11.286,14.295 C11.020,14.295 10.771,14.418 10.569,14.623 L11.010,14.623 C11.358,14.623 11.640,14.904 11.640,15.250 C11.640,15.597 11.358,15.878 11.010,15.878 L10.073,15.878 C10.072,15.898 10.071,15.918 10.071,15.938 C10.071,16.001 10.074,16.063 10.080,16.124 L11.010,16.124 C11.358,16.124 11.640,16.405 11.640,16.751 C11.640,17.098 11.358,17.379 11.010,17.379 L10.713,17.379 C10.885,17.507 11.081,17.580 11.286,17.580 C11.594,17.580 11.828,17.422 11.970,17.289 C12.224,17.052 12.622,17.064 12.860,17.317 C13.098,17.570 13.085,17.967 12.831,18.204 C12.396,18.611 11.847,18.835 11.286,18.835 C10.370,18.835 9.569,18.248 9.141,17.379 L8.946,17.379 C8.599,17.379 8.317,17.098 8.317,16.751 C8.317,16.448 8.532,16.195 8.819,16.137 C8.815,16.071 8.812,16.005 8.812,15.938 C8.812,15.913 8.813,15.888 8.814,15.864 C8.530,15.803 8.317,15.552 8.317,15.250 C8.317,14.904 8.599,14.623 8.946,14.623 L9.083,14.623 C9.493,13.685 10.326,13.040 11.286,13.040 C11.847,13.040 12.396,13.265 12.831,13.672 C13.085,13.909 13.098,14.306 12.860,14.558 C12.622,14.811 12.224,14.824 11.970,14.587 ZM10.889,10.124 C8.089,10.124 5.811,7.853 5.811,5.062 C5.811,2.271 8.089,-0.000 10.889,-0.000 C13.690,-0.000 15.968,2.271 15.968,5.062 C15.968,7.853 13.690,10.124 10.889,10.124 ZM10.889,1.255 C8.783,1.255 7.070,2.963 7.070,5.062 C7.070,7.161 8.783,8.869 10.889,8.869 C12.996,8.869 14.709,7.161 14.709,5.062 C14.709,2.963 12.995,1.255 10.889,1.255 ZM11.735,4.003 L10.889,4.003 C10.770,4.003 10.673,4.100 10.673,4.219 C10.673,4.338 10.770,4.435 10.889,4.435 C11.703,4.435 12.365,5.094 12.365,5.905 C12.365,6.492 12.018,6.999 11.519,7.235 L11.519,7.474 C11.519,7.821 11.237,8.102 10.889,8.102 C10.542,8.102 10.260,7.821 10.260,7.474 L10.260,7.376 L10.043,7.376 C9.696,7.376 9.414,7.095 9.414,6.749 C9.414,6.402 9.696,6.121 10.043,6.121 L10.889,6.121 C11.009,6.121 11.106,6.024 11.106,5.905 C11.106,5.786 11.009,5.690 10.889,5.690 C10.076,5.690 9.414,5.030 9.414,4.219 C9.414,3.632 9.760,3.125 10.260,2.889 L10.260,2.650 C10.260,2.303 10.542,2.023 10.889,2.023 C11.237,2.023 11.519,2.303 11.519,2.650 L11.519,2.748 L11.735,2.748 C12.083,2.748 12.365,3.029 12.365,3.376 C12.365,3.722 12.083,4.003 11.735,4.003 ZM3.543,7.110 C3.486,7.126 3.427,7.134 3.370,7.134 C3.205,7.134 3.044,7.069 2.925,6.950 L2.424,6.451 C0.459,9.830 0.994,14.135 3.815,16.947 C3.844,16.976 3.870,17.008 3.893,17.042 C4.086,17.331 4.008,17.720 3.719,17.913 C3.612,17.984 3.490,18.018 3.370,18.018 C3.202,18.018 3.036,17.951 2.915,17.825 C1.251,16.161 0.228,13.958 0.034,11.620 C-0.143,9.482 0.379,7.343 1.507,5.537 L0.614,4.647 C0.453,4.486 0.391,4.250 0.454,4.031 C0.517,3.812 0.694,3.644 0.917,3.592 L3.927,2.895 C4.139,2.846 4.361,2.909 4.515,3.062 C4.668,3.216 4.732,3.437 4.683,3.648 L3.983,6.648 C3.931,6.870 3.762,7.047 3.543,7.110 ZM2.306,4.559 L3.013,5.264 L3.227,4.345 L2.306,4.559 Z"/>
                </svg> <span class="navText">Trading Exchange</span></a></li>

                {{--<li class="@if(Request::is('user_bank_account/*')) active @endif"><a href="{{ url('user_bank_account/data') }}"> <svg  class="navIcon"  xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="17px">--}}
                  {{--<path fill-rule="evenodd"  fill="rgb(143, 163, 183)" d="M16.538,4.938 C16.453,5.107 16.281,5.213 16.093,5.213 L14.890,5.213 L11.611,8.499 L13.359,10.248 C14.616,9.801 16.035,10.106 16.986,11.057 C18.022,12.093 18.292,13.684 17.659,15.016 C17.511,15.327 17.099,15.398 16.856,15.154 L15.723,14.013 L15.011,14.013 L15.011,14.725 L16.151,15.858 C16.395,16.101 16.325,16.513 16.014,16.661 C15.534,16.889 15.020,17.000 14.511,17.000 C13.607,17.000 12.718,16.651 12.056,15.988 C11.105,15.037 10.799,13.618 11.246,12.361 L10.890,12.005 C10.839,12.079 10.781,12.149 10.716,12.214 C10.250,12.681 9.563,12.768 9.018,12.508 L6.561,15.765 C5.436,17.265 3.236,17.426 1.905,16.095 C0.577,14.766 0.732,12.566 2.236,11.438 L5.492,8.981 C5.230,8.426 5.327,7.742 5.785,7.283 C5.851,7.218 5.921,7.160 5.995,7.109 L5.639,6.754 C4.382,7.201 2.963,6.895 2.012,5.944 C0.976,4.908 0.706,3.317 1.339,1.985 C1.486,1.676 1.894,1.604 2.138,1.843 L3.272,2.955 L3.954,2.955 L3.954,2.273 L2.842,1.139 C2.603,0.894 2.675,0.487 2.984,0.340 C4.316,-0.293 5.907,-0.023 6.942,1.013 C7.893,1.964 8.199,3.383 7.752,4.640 L9.495,6.384 L12.753,3.110 L12.753,1.906 C12.753,1.717 12.860,1.544 13.030,1.460 L15.871,0.051 C16.063,-0.044 16.294,-0.006 16.445,0.145 L17.854,1.554 C18.005,1.706 18.043,1.938 17.947,2.130 L16.538,4.938 ZM10.716,10.101 C10.921,10.306 11.058,10.560 11.119,10.836 C11.141,10.852 11.163,10.870 11.184,10.890 L12.185,11.891 C12.334,12.040 12.373,12.267 12.283,12.457 C11.830,13.410 12.022,14.546 12.760,15.284 C13.317,15.841 14.101,16.087 14.861,15.980 L14.162,15.285 C14.068,15.192 14.015,15.065 14.015,14.932 L14.015,13.515 C14.015,13.240 14.238,13.017 14.513,13.017 L15.930,13.017 C16.062,13.017 16.190,13.070 16.283,13.164 L16.978,13.863 C17.085,13.103 16.839,12.319 16.282,11.762 C15.544,11.024 14.408,10.832 13.455,11.285 C13.265,11.375 13.038,11.336 12.889,11.187 L10.907,9.204 L10.364,9.749 L10.716,10.101 ZM9.307,11.510 C9.502,11.705 9.817,11.705 10.012,11.510 C10.206,11.316 10.206,11.000 10.012,10.806 L7.194,7.988 C7.000,7.794 6.684,7.794 6.490,7.988 C6.296,8.182 6.296,8.498 6.490,8.692 L9.307,11.510 ZM2.835,12.234 C1.814,12.999 1.709,14.490 2.610,15.390 C3.510,16.291 5.001,16.186 5.765,15.166 L8.255,11.866 L6.133,9.745 L2.835,12.234 ZM6.813,5.110 C6.664,4.961 6.625,4.734 6.715,4.544 C7.168,3.591 6.976,2.456 6.238,1.717 C5.678,1.157 4.888,0.911 4.124,1.023 L4.807,1.721 C4.899,1.814 4.950,1.939 4.950,2.069 L4.950,3.453 C4.950,3.728 4.727,3.951 4.452,3.951 L3.068,3.951 C2.938,3.951 2.813,3.900 2.720,3.809 L2.022,3.125 C1.910,3.890 2.156,4.679 2.716,5.239 C3.454,5.978 4.590,6.170 5.542,5.717 C5.733,5.626 5.960,5.665 6.109,5.814 C7.203,6.909 7.128,6.829 7.165,6.882 C7.434,6.941 7.690,7.074 7.899,7.283 L8.250,7.635 L8.793,7.090 L6.813,5.110 ZM15.993,1.103 L13.749,2.215 L13.749,3.315 C13.749,3.447 13.697,3.573 13.604,3.667 C13.428,3.843 9.240,8.053 8.955,8.340 L9.659,9.044 L14.331,4.363 C14.425,4.269 14.552,4.217 14.684,4.217 L15.785,4.217 L16.895,2.004 L15.993,1.103 ZM6.132,12.573 L4.018,14.686 C3.824,14.881 3.508,14.881 3.314,14.686 C3.120,14.491 3.120,14.176 3.314,13.982 L5.427,11.868 C5.622,11.674 5.937,11.674 6.132,11.868 C6.326,12.063 6.326,12.378 6.132,12.573 Z"/>--}}
                {{--</svg> <span class="navText">Bank Details</span></a></li>--}}

                <li class="@if(Request::is('setting/*')) active @endif"><a href="{{ url('setting/data') }}"> <svg  class="navIcon"  xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="17px">
                  <path fill-rule="evenodd"  fill="rgb(143, 163, 183)" d="M16.538,4.938 C16.453,5.107 16.281,5.213 16.093,5.213 L14.890,5.213 L11.611,8.499 L13.359,10.248 C14.616,9.801 16.035,10.106 16.986,11.057 C18.022,12.093 18.292,13.684 17.659,15.016 C17.511,15.327 17.099,15.398 16.856,15.154 L15.723,14.013 L15.011,14.013 L15.011,14.725 L16.151,15.858 C16.395,16.101 16.325,16.513 16.014,16.661 C15.534,16.889 15.020,17.000 14.511,17.000 C13.607,17.000 12.718,16.651 12.056,15.988 C11.105,15.037 10.799,13.618 11.246,12.361 L10.890,12.005 C10.839,12.079 10.781,12.149 10.716,12.214 C10.250,12.681 9.563,12.768 9.018,12.508 L6.561,15.765 C5.436,17.265 3.236,17.426 1.905,16.095 C0.577,14.766 0.732,12.566 2.236,11.438 L5.492,8.981 C5.230,8.426 5.327,7.742 5.785,7.283 C5.851,7.218 5.921,7.160 5.995,7.109 L5.639,6.754 C4.382,7.201 2.963,6.895 2.012,5.944 C0.976,4.908 0.706,3.317 1.339,1.985 C1.486,1.676 1.894,1.604 2.138,1.843 L3.272,2.955 L3.954,2.955 L3.954,2.273 L2.842,1.139 C2.603,0.894 2.675,0.487 2.984,0.340 C4.316,-0.293 5.907,-0.023 6.942,1.013 C7.893,1.964 8.199,3.383 7.752,4.640 L9.495,6.384 L12.753,3.110 L12.753,1.906 C12.753,1.717 12.860,1.544 13.030,1.460 L15.871,0.051 C16.063,-0.044 16.294,-0.006 16.445,0.145 L17.854,1.554 C18.005,1.706 18.043,1.938 17.947,2.130 L16.538,4.938 ZM10.716,10.101 C10.921,10.306 11.058,10.560 11.119,10.836 C11.141,10.852 11.163,10.870 11.184,10.890 L12.185,11.891 C12.334,12.040 12.373,12.267 12.283,12.457 C11.830,13.410 12.022,14.546 12.760,15.284 C13.317,15.841 14.101,16.087 14.861,15.980 L14.162,15.285 C14.068,15.192 14.015,15.065 14.015,14.932 L14.015,13.515 C14.015,13.240 14.238,13.017 14.513,13.017 L15.930,13.017 C16.062,13.017 16.190,13.070 16.283,13.164 L16.978,13.863 C17.085,13.103 16.839,12.319 16.282,11.762 C15.544,11.024 14.408,10.832 13.455,11.285 C13.265,11.375 13.038,11.336 12.889,11.187 L10.907,9.204 L10.364,9.749 L10.716,10.101 ZM9.307,11.510 C9.502,11.705 9.817,11.705 10.012,11.510 C10.206,11.316 10.206,11.000 10.012,10.806 L7.194,7.988 C7.000,7.794 6.684,7.794 6.490,7.988 C6.296,8.182 6.296,8.498 6.490,8.692 L9.307,11.510 ZM2.835,12.234 C1.814,12.999 1.709,14.490 2.610,15.390 C3.510,16.291 5.001,16.186 5.765,15.166 L8.255,11.866 L6.133,9.745 L2.835,12.234 ZM6.813,5.110 C6.664,4.961 6.625,4.734 6.715,4.544 C7.168,3.591 6.976,2.456 6.238,1.717 C5.678,1.157 4.888,0.911 4.124,1.023 L4.807,1.721 C4.899,1.814 4.950,1.939 4.950,2.069 L4.950,3.453 C4.950,3.728 4.727,3.951 4.452,3.951 L3.068,3.951 C2.938,3.951 2.813,3.900 2.720,3.809 L2.022,3.125 C1.910,3.890 2.156,4.679 2.716,5.239 C3.454,5.978 4.590,6.170 5.542,5.717 C5.733,5.626 5.960,5.665 6.109,5.814 C7.203,6.909 7.128,6.829 7.165,6.882 C7.434,6.941 7.690,7.074 7.899,7.283 L8.250,7.635 L8.793,7.090 L6.813,5.110 ZM15.993,1.103 L13.749,2.215 L13.749,3.315 C13.749,3.447 13.697,3.573 13.604,3.667 C13.428,3.843 9.240,8.053 8.955,8.340 L9.659,9.044 L14.331,4.363 C14.425,4.269 14.552,4.217 14.684,4.217 L15.785,4.217 L16.895,2.004 L15.993,1.103 ZM6.132,12.573 L4.018,14.686 C3.824,14.881 3.508,14.881 3.314,14.686 C3.120,14.491 3.120,14.176 3.314,13.982 L5.427,11.868 C5.622,11.674 5.937,11.674 6.132,11.868 C6.326,12.063 6.326,12.378 6.132,12.573 Z"/>
                </svg> <span class="navText">Settings</span></a></li>

<!-- 
                     <li class="@if(Request::is('checkout/*')) active @endif"><a href="{{ url('checkout') }}"> <svg  class="navIcon"  xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="17px">
                  <path fill-rule="evenodd"  fill="rgb(143, 163, 183)" d="M16.538,4.938 C16.453,5.107 16.281,5.213 16.093,5.213 L14.890,5.213 L11.611,8.499 L13.359,10.248 C14.616,9.801 16.035,10.106 16.986,11.057 C18.022,12.093 18.292,13.684 17.659,15.016 C17.511,15.327 17.099,15.398 16.856,15.154 L15.723,14.013 L15.011,14.013 L15.011,14.725 L16.151,15.858 C16.395,16.101 16.325,16.513 16.014,16.661 C15.534,16.889 15.020,17.000 14.511,17.000 C13.607,17.000 12.718,16.651 12.056,15.988 C11.105,15.037 10.799,13.618 11.246,12.361 L10.890,12.005 C10.839,12.079 10.781,12.149 10.716,12.214 C10.250,12.681 9.563,12.768 9.018,12.508 L6.561,15.765 C5.436,17.265 3.236,17.426 1.905,16.095 C0.577,14.766 0.732,12.566 2.236,11.438 L5.492,8.981 C5.230,8.426 5.327,7.742 5.785,7.283 C5.851,7.218 5.921,7.160 5.995,7.109 L5.639,6.754 C4.382,7.201 2.963,6.895 2.012,5.944 C0.976,4.908 0.706,3.317 1.339,1.985 C1.486,1.676 1.894,1.604 2.138,1.843 L3.272,2.955 L3.954,2.955 L3.954,2.273 L2.842,1.139 C2.603,0.894 2.675,0.487 2.984,0.340 C4.316,-0.293 5.907,-0.023 6.942,1.013 C7.893,1.964 8.199,3.383 7.752,4.640 L9.495,6.384 L12.753,3.110 L12.753,1.906 C12.753,1.717 12.860,1.544 13.030,1.460 L15.871,0.051 C16.063,-0.044 16.294,-0.006 16.445,0.145 L17.854,1.554 C18.005,1.706 18.043,1.938 17.947,2.130 L16.538,4.938 ZM10.716,10.101 C10.921,10.306 11.058,10.560 11.119,10.836 C11.141,10.852 11.163,10.870 11.184,10.890 L12.185,11.891 C12.334,12.040 12.373,12.267 12.283,12.457 C11.830,13.410 12.022,14.546 12.760,15.284 C13.317,15.841 14.101,16.087 14.861,15.980 L14.162,15.285 C14.068,15.192 14.015,15.065 14.015,14.932 L14.015,13.515 C14.015,13.240 14.238,13.017 14.513,13.017 L15.930,13.017 C16.062,13.017 16.190,13.070 16.283,13.164 L16.978,13.863 C17.085,13.103 16.839,12.319 16.282,11.762 C15.544,11.024 14.408,10.832 13.455,11.285 C13.265,11.375 13.038,11.336 12.889,11.187 L10.907,9.204 L10.364,9.749 L10.716,10.101 ZM9.307,11.510 C9.502,11.705 9.817,11.705 10.012,11.510 C10.206,11.316 10.206,11.000 10.012,10.806 L7.194,7.988 C7.000,7.794 6.684,7.794 6.490,7.988 C6.296,8.182 6.296,8.498 6.490,8.692 L9.307,11.510 ZM2.835,12.234 C1.814,12.999 1.709,14.490 2.610,15.390 C3.510,16.291 5.001,16.186 5.765,15.166 L8.255,11.866 L6.133,9.745 L2.835,12.234 ZM6.813,5.110 C6.664,4.961 6.625,4.734 6.715,4.544 C7.168,3.591 6.976,2.456 6.238,1.717 C5.678,1.157 4.888,0.911 4.124,1.023 L4.807,1.721 C4.899,1.814 4.950,1.939 4.950,2.069 L4.950,3.453 C4.950,3.728 4.727,3.951 4.452,3.951 L3.068,3.951 C2.938,3.951 2.813,3.900 2.720,3.809 L2.022,3.125 C1.910,3.890 2.156,4.679 2.716,5.239 C3.454,5.978 4.590,6.170 5.542,5.717 C5.733,5.626 5.960,5.665 6.109,5.814 C7.203,6.909 7.128,6.829 7.165,6.882 C7.434,6.941 7.690,7.074 7.899,7.283 L8.250,7.635 L8.793,7.090 L6.813,5.110 ZM15.993,1.103 L13.749,2.215 L13.749,3.315 C13.749,3.447 13.697,3.573 13.604,3.667 C13.428,3.843 9.240,8.053 8.955,8.340 L9.659,9.044 L14.331,4.363 C14.425,4.269 14.552,4.217 14.684,4.217 L15.785,4.217 L16.895,2.004 L15.993,1.103 ZM6.132,12.573 L4.018,14.686 C3.824,14.881 3.508,14.881 3.314,14.686 C3.120,14.491 3.120,14.176 3.314,13.982 L5.427,11.868 C5.622,11.674 5.937,11.674 6.132,11.868 C6.326,12.063 6.326,12.378 6.132,12.573 Z"/>
                </svg> <span class="navText">2Checkout</span></a></li> -->