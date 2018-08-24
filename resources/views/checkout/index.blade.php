@extends('layouts.master')
@section('title')
     2Checkout Demo
@endsection
@section('content')
    <div class="panel panel-white">
        <div class="panel-heading">
            <h6 class="panel-title"> 2Checkout</h6>

            <div class="heading-elements">

            </div>
        </div>
        <div class="panel-body ">


                  <div class="col-lg-12">
                                        <div class="personalDtlForm">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control cust_fld" placeholder="First Name">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control cust_fld" placeholder="Last Name">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-5">
                                                    <div class="form-group">
                                                        <div class="customSelect">
                                                            <select class="form-control cust_fld">
                                                                <option selected="" disabled="">Date of Birth</option>
                                                                <option>1</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <div class="customSelect">
                                                            <select class="form-control cust_fld">
                                                                <option selected="" disabled="">MM</option>
                                                                <option>1</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <div class="customSelect">
                                                            <select class="form-control cust_fld">
                                                                <option selected="" disabled="">YY</option>
                                                                <option>1</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control cust_fld" placeholder="Street Address 1">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control cust_fld" placeholder="Street Address 2">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control cust_fld" placeholder="City">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control cust_fld" placeholder="State">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control cust_fld" placeholder="Postcode">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control cust_fld" placeholder="Country">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="act_btns withdrw_btc">
                                                <button type="submit" class="btn btn-default btn-xs send_rec"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" preserveAspectRatio="xMidYMid" width="13" height="13" viewBox="0 0 13 13">
                                                    <path fill="#92a8c0" d="M12.658,12.664 C12.453,12.866 12.145,13.000 11.820,13.000 L10.212,13.000 L2.788,13.000 L1.180,13.000 C0.855,13.000 0.564,12.866 0.342,12.664 C0.137,12.463 -0.000,12.161 -0.000,11.842 L-0.000,1.157 C-0.000,0.839 0.137,0.553 0.342,0.335 C0.564,0.134 0.855,-0.000 1.180,-0.000 L2.788,-0.000 L9.801,-0.000 L10.212,-0.000 C10.314,-0.000 10.400,0.033 10.468,0.101 L12.897,2.482 C12.966,2.550 13.000,2.633 13.000,2.734 L13.000,11.859 C13.000,12.178 12.863,12.463 12.658,12.664 ZM3.130,12.312 L9.853,12.312 L9.853,9.192 C9.853,9.142 9.835,9.108 9.801,9.075 C9.767,9.041 9.733,9.024 9.682,9.024 L3.301,9.024 C3.250,9.024 3.216,9.041 3.181,9.075 C3.147,9.108 3.130,9.142 3.130,9.192 L3.130,12.312 ZM9.870,0.755 C9.870,0.738 9.870,0.721 9.853,0.721 C9.835,0.721 9.835,0.704 9.818,0.704 L3.147,0.704 L3.147,4.663 C3.147,4.747 3.181,4.814 3.233,4.864 C3.284,4.915 3.353,4.948 3.438,4.948 L9.579,4.948 C9.664,4.948 9.733,4.915 9.784,4.864 C9.835,4.814 9.870,4.747 9.870,4.663 L9.870,0.755 ZM12.264,2.868 L10.554,1.191 L10.554,4.663 C10.554,4.932 10.434,5.183 10.263,5.351 C10.075,5.535 9.835,5.636 9.562,5.636 L3.438,5.636 C3.164,5.636 2.908,5.519 2.737,5.351 C2.549,5.166 2.446,4.932 2.446,4.663 L2.446,0.704 L1.197,0.704 C1.078,0.704 0.958,0.755 0.872,0.839 C0.787,0.922 0.735,1.040 0.735,1.157 L0.735,11.859 C0.735,11.977 0.787,12.094 0.872,12.178 C0.958,12.262 1.078,12.312 1.197,12.312 L2.429,12.312 L2.429,9.192 C2.429,8.957 2.532,8.739 2.685,8.588 C2.839,8.437 3.062,8.337 3.301,8.337 L9.682,8.337 C9.921,8.337 10.143,8.437 10.297,8.588 C10.451,8.739 10.554,8.957 10.554,9.192 L10.554,12.312 L11.803,12.312 C11.922,12.312 12.042,12.262 12.128,12.178 C12.213,12.094 12.264,11.977 12.264,11.859 L12.264,2.868 ZM9.100,4.412 L7.389,4.412 C7.304,4.412 7.235,4.344 7.235,4.261 L7.235,2.583 C7.235,2.499 7.304,2.432 7.389,2.432 L9.100,2.432 C9.185,2.432 9.254,2.499 9.254,2.583 L9.254,4.261 C9.254,4.344 9.185,4.412 9.100,4.412 ZM4.481,9.628 L8.501,9.628 C8.689,9.628 8.860,9.779 8.860,9.981 C8.860,10.165 8.706,10.333 8.501,10.333 L4.481,10.333 C4.293,10.333 4.122,10.182 4.122,9.981 C4.122,9.796 4.276,9.628 4.481,9.628 ZM4.481,11.004 L8.501,11.004 C8.689,11.004 8.860,11.155 8.860,11.356 C8.860,11.541 8.706,11.708 8.501,11.708 L4.481,11.708 C4.293,11.708 4.122,11.557 4.122,11.356 C4.122,11.172 4.276,11.004 4.481,11.004 Z" class="cls-1"/>
                                                </svg> Save</button>
                                            </div>
                                        </div>
                                    </div>


            <div class="table-responsive">
                <table id="data-table" class="table table-striped table-condensed table-hover">
                    <thead>
              
                    </thead>
                    <tbody>
                  
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
            "order": [[6, "desc"]],
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
