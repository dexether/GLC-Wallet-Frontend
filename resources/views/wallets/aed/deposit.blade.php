@extends('layouts.master')
@section('title')
    {{trans_choice('general.deposit',1)}}   {{$usd->name}}
@endsection
@section('content')
    <style>
        /* CSS for Credit Card Payment form */
        .credit-card-box .panel-title {
            display: inline;
            font-weight: bold;
        }

        .credit-card-box .form-control.error {
            border-color: red;
            outline: 0;
            box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(255, 0, 0, 0.6);
        }

        .credit-card-box label.error {
            font-weight: bold;
            color: red;
            padding: 2px 8px;
            margin-top: 2px;
        }

        .credit-card-box .payment-errors {
            font-weight: bold;
            color: red;
            padding: 2px 8px;
            margin-top: 2px;
        }

        .credit-card-box label {
            display: block;
        }

        /* The old "center div vertically" hack */
        .credit-card-box .display-table {
            display: table;
        }

        .credit-card-box .display-tr {
            display: table-row;
        }

        .credit-card-box .display-td {
            display: table-cell;
            vertical-align: middle;
            width: 50%;
        }

        /* Just looks nicer */
        .credit-card-box .panel-heading img {
            min-width: 180px;
        }
    </style>

    <div class="pageContent wallets">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="panel panel-white2">
                        <div class="panel-body2">
                            @include('left_menu.client_balance')
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="panel panel-white2">
                        <div class="panel-heading">
                            <h6 class="panel-title"> {{trans_choice('general.deposit',1)}}   {{$usd->name}}</h6>

                            <div class="heading-elements">

                            </div>
                        </div>


                        {{--                {!! Form::open(array('url' => url('wallet/usd/deposit'),'id'=>"myCCForm", 'method' => 'post', 'id' => 'myCCForm',"enctype"=>"multipart/form-data")) !!}--}}
                        <form id="myCCForm" action="{{url('wallets/aed/deposit')}}" method="post">
                            {{csrf_field()}}
                            <input id="token" name="token" type="hidden" value="">
                            <div class="panel-body ">
                                {{--<div class="form-group">--}}
                                {{--{!! Form::label('deposit_method_id',trans_choice('general.method',1),array('class'=>'')) !!}--}}
                                {{--{!! Form::select('deposit_method_id',$payment_gateways,null, array('class' => 'form-control','placeholder'=>trans_choice('general.select',1),'id'=>'deposit_method_id','required'=>'required')) !!}--}}
                                {{--</div>--}}
                                <div class="form-group" id="notesDiv">

                                </div>
                                <div style="display: none" id="manualMethod">
                                    {{--<div class="form-group">
                                        {!! Form::label('user_bank_account_id',trans_choice('general.bank',1)." ".trans_choice('general.account',1),array('class'=>'')) !!}
                                        {!! Form::select('user_bank_account_id',$bank_accounts,null, array('class' => 'form-control ', 'placeholder'=>"",'id'=>'user_bank_account_id')) !!}
                                    </div>--}}
                                </div>

                                <div class="form-group">
                                    {!! Form::label('amount',trans_choice('general.amount',1),array('class'=>'')) !!}
                                    {!! Form::number('amount',null, array('class' => 'form-control', 'required'=>"required",'id'=>'amount' ,'autofocus'=>'autofocus')) !!}
                                </div>
                                {{--<div class="form-group">
                                    {!! Form::label('fee',trans_choice('general.fee',2),array('class'=>'')) !!}
                                    {!! Form::number('fee',0.00, array('class' => 'form-control', 'readonly'=>"readonly",'id'=>'fee')) !!}
                                </div>--}}


                                <div class="row">
                                    <input type="hidden" id="stripe_secret_key">
                                    <input type="hidden" id="stripe_publishable_key">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <div class="form-group">
                                                    <label for="cardNumber">CARD NUMBER</label>
                                                    <div class="input-group">
                                                        <input id="ccNo"
                                                               type="tel"
                                                               class="form-control"
                                                               name="cardNumber"
                                                               placeholder="Valid Card Number"
                                                               autocomplete="cc-number"
                                                               required autofocus
                                                        />
                                                        <span class="input-group-addon"><i
                                                                    class="fa fa-credit-card"></i></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-6 col-md-6">
                                                <div class="form-group">
                                                    <label for="cardExpiry"><span
                                                                class="hidden-xs">EXPIRATION</span><span
                                                                class="visible-xs-inline">EXP</span> DATE</label>
                                                    <input id="expMonth"
                                                           type="tel"
                                                           class="form-control"
                                                           name="cardExpiry"
                                                           placeholder="MM"
                                                           autocomplete="cc-exp"
                                                           required
                                                    />
                                                </div>
                                            </div>
                                            <div class="col-xs-6 col-md-6">
                                                <div class="form-group">
                                                    <label for="cardExpiry"><span
                                                                class="hidden-xs">EXPIRATION</span><span
                                                                class="visible-xs-inline">EXP</span> DATE</label>
                                                    <input id="expYear"
                                                           type="tel"
                                                           class="form-control"
                                                           name="cardExpiry"
                                                           placeholder="YYYY"
                                                           autocomplete="cc-exp"
                                                           required
                                                    />
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-md-12 ">
                                                <div class="form-group">
                                                    <label for="cardCVC">CV CODE</label>
                                                    <input id="cvv"
                                                           type="tel"
                                                           class="form-control"
                                                           name="cardCVC"
                                                           placeholder="CVC"
                                                           autocomplete="cc-csc"
                                                           required
                                                    />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row" style="display:none;">
                                            <div class="col-xs-12">
                                                <p class="payment-errors"></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-footer">
                                <div class="heading-elements">
                                    <button type="submit"
                                            class="btn btn-primary pull-right"
                                            id="submit_form">{{trans_choice('general.deposit',1)}}</button>
                                </div>
                            </div>
                        {!! Form::close() !!}


                    </div>
                </div>
                <!-- /.box -->
            </div>
        </div>
    </div>
    </div>
@endsection
@section('footer-scripts')
    <script type="text/javascript"
            src="https://cdnjs.cloudflare.com/ajax/libs/jquery.payment/1.2.3/jquery.payment.min.js"></script>
    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>

    <script src="https://www.2checkout.com/checkout/api/2co.min.js"></script>

    <script>
        // Called when token created successfully.
        var successCallback = function (data) {
            var myForm = document.getElementById('myCCForm');
            myForm.token.value = data.response.token.token;
//        prompt("Copy token to clipboard: Ctrl+C, Enter", data.response.token.token);
            myForm.token.value = data.response.token.token;
//
//        // IMPORTANT: Here we call `submit()` on the form element directly instead of using jQuery to prevent and infinite token request loop.
            myForm.submit();
        };

        // Called when token creation fails.
        var errorCallback = function (data) {
            // Retry the token request if ajax call fails
            if (data.errorCode === 200) {
                tokenRequest();
            } else {
//                alert(data.errorMsg);
                swal({
                    title: "Something go wrong !",
                    text: data.errorMsg,
                    icon: "warning",
                });
            }
        };

        var tokenRequest = function () {
            // Setup token request arguments
            var args = {
                sellerId: "{{$payment->supplier_id}}",
                publishableKey: "{{$payment->stripe_publishable_key}}",
                ccNo: $("#ccNo").val(),
                cvv: $("#cvv").val(),
                expMonth: $("#expMonth").val(),
                expYear: $("#expYear").val()
            };

            // Make the token request
            TCO.requestToken(successCallback, errorCallback, args);
        };

        $(function () {
            // Pull in the public encryption key for our environment
            TCO.loadPubKey('{{$payment->type}}');

            $("#myCCForm").submit(function (e) {
                // Call our token request function
                tokenRequest();

                // Prevent form from submitting
                return false;
            });
        });
    </script>
@endsection
