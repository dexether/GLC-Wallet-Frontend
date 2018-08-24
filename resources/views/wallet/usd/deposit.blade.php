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
                {!! Form::open(array('url' => url('wallet/usd/deposit'), 'method' => 'post', 'id' => 'deposit-form',"enctype"=>"multipart/form-data")) !!}

                <div class="panel-body ">
                    <div class="form-group">
                        {!! Form::label('deposit_method_id',trans_choice('general.method',1),array('class'=>'')) !!}
                        {!! Form::select('deposit_method_id',$payment_gateways,null, array('class' => 'form-control','placeholder'=>trans_choice('general.select',1),'id'=>'deposit_method_id','required'=>'required')) !!}
                    </div>
                    <div class="form-group" id="notesDiv">

                    </div>
                    <div style="display: none" id="manualMethod">
                        <div class="form-group">
                            {!! Form::label('user_bank_account_id',trans_choice('general.bank',1)." ".trans_choice('general.account',1),array('class'=>'')) !!}
                            {!! Form::select('user_bank_account_id',$bank_accounts,null, array('class' => 'form-control ', 'placeholder'=>"",'id'=>'user_bank_account_id')) !!}
                        </div>
                    </div>
                    <div id="paypalMethod" style="display: none;">
                        <input name="rm" value="2" type="hidden">
                        <input name="cmd" value="_xclick" type="hidden">
                        <input name="currency_code"
                               value="{{ $usd->xml_code }}"
                               type="hidden">
                        <input name="quantity" value="1" type="hidden">
                        <input name="business"
                               value=""
                               type="hidden" id="paypal_email">
                        <input name="return" value="{{ url('wallet/usd/deposit/done') }}"
                               type="hidden">
                        <input name="cancel_return"
                               value="{{ url('wallet/usd') }}"
                               type="hidden">
                        <input name="notify_url"
                               value="{{ url('wallet/usd/deposit/paypal/ipn') }}" type="hidden">
                        <input name="custom" value="" type="hidden">
                        <input name="item_name" value="Deposit" type="hidden">
                        <input name="user_id" value="{{ Sentinel::getUser()->id }}" type="hidden">
                        <input name="item_number" value="{{ Sentinel::getUser()->id }}" type="hidden">
                    </div>
                    <div class="form-group">
                        {!! Form::label('amount',trans_choice('general.amount',1),array('class'=>'')) !!}
                        {!! Form::number('amount',null, array('class' => 'form-control', 'required'=>"required",'id'=>'amount')) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('fee',trans_choice('general.fee',2),array('class'=>'')) !!}
                        {!! Form::number('fee',0.00, array('class' => 'form-control', 'readonly'=>"readonly",'id'=>'fee')) !!}
                    </div>

                    <div class="row" style="display: none" id="stripeForm">
                        <input type="hidden" id="stripe_secret_key">
                        <input type="hidden" id="stripe_publishable_key">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <label for="cardNumber">CARD NUMBER</label>
                                        <div class="input-group">
                                            <input
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
                                <div class="col-xs-7 col-md-7">
                                    <div class="form-group">
                                        <label for="cardExpiry"><span
                                                    class="hidden-xs">EXPIRATION</span><span
                                                    class="visible-xs-inline">EXP</span> DATE</label>
                                        <input
                                                type="tel"
                                                class="form-control"
                                                name="cardExpiry"
                                                placeholder="MM / YY"
                                                autocomplete="cc-exp"
                                                required
                                        />
                                    </div>
                                </div>
                                <div class="col-xs-5 col-md-5 pull-right">
                                    <div class="form-group">
                                        <label for="cardCVC">CV CODE</label>
                                        <input
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
                                class="btn btn-primary pull-right" id="submit_form">{{trans_choice('general.deposit',1)}}</button>
                    </div>
                </div>
                {!! Form::close() !!}
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
    <script>
        $("#deposit_method_id").change(function (e) {
            var id = $("#deposit_method_id").val();
            //make ajax calls

            $.ajax({
                type: 'GET',
                url: '{{url('wallet/get_gateway_info?id=')}}' + id,
                dataType: 'json',
                success: function (data) {
                    if (data.success === 1) {
                        $("#notesDiv").html(data.notes);
                        if (data.system === 0) {
                            $("#stripeForm").hide();
                            $("#manualMethod").show();
                            $("#user_bank_account_id").attr("required", "required");

                            $("#deposit-form").attr("action", "{{url('wallet/usd/deposit/manual')}}");
                            $("#submit_form").removeClass("subscribe");
                            $("#deposit-form").removeClass("subscribe");

                            $("input[name=cardNumber]").removeAttr("required");
                            $("input[name=cardCVC]").removeAttr("required");
                            $("input[name=cardExpiry]").removeAttr("required");
                        } else {
                            $("#stripeForm").hide();
                            $("#manualMethod").hide();
                            $("#user_bank_account_id").removeAttr("required");
                            $("#submit_form").removeClass("subscribe");
                            $("#deposit-form").removeClass("subscribe");
                            $("input[name=cardNumber]").removeAttr("required");
                            $("input[name=cardCVC]").removeAttr("required");
                            $("input[name=cardExpiry]").removeAttr("required");
                            if (data.name === "Paypal") {
                                //paypal information
                                $('#deposit-form').attr('action', "https://www.paypal.com/cgi-bin/webscr");
                                $("#paypal_email").val(data.paypal_email);
                                $("#submit_form").removeClass("subscribe");
                            }
                            if (data.name === "Stripe") {
                                //paypal information
                                $("input[name=cardNumber]").attr("required", "required");
                                $("input[name=cardCVC]").attr("required", "required");
                                $("input[name=cardExpiry]").attr("required", "required");
                                $("#stripeForm").show();
                                $('#deposit-form').attr('action', "");
                                $("#submit_form").addClass("subscribe");
                                $("#deposit-form").addClass("stripe-form");
                                $("#stripe_publishable_key").val(data.stripe_publishable_key);
                                var $form = $('.stripe-form');
                                $form.find('.subscribe').on('click', payWithStripe);
                                /* Fancy restrictive input formatting via jQuery.payment library*/
                                $('input[name=cardNumber]').payment('formatCardNumber');
                                $('input[name=cardCVC]').payment('formatCardCVC');
                                $('input[name=cardExpiry]').payment('formatCardExpiry');

                                /* Form validation using Stripe client-side validation helpers */
                                jQuery.validator.addMethod("cardNumber", function (value, element) {
                                    return this.optional(element) || Stripe.card.validateCardNumber(value);
                                }, "Please specify a valid credit card number.");

                                jQuery.validator.addMethod("cardExpiry", function (value, element) {
                                    /* Parsing month/year uses jQuery.payment library */
                                    value = $.payment.cardExpiryVal(value);
                                    return this.optional(element) || Stripe.card.validateExpiry(value.month, value.year);
                                }, "Invalid expiration date.");

                                jQuery.validator.addMethod("cardCVC", function (value, element) {
                                    return this.optional(element) || Stripe.card.validateCVC(value);
                                }, "Invalid CVC.");

                                validator = $form.validate({
                                    rules: {
                                        amount: {
                                            required: true,
                                        },
                                        cardNumber: {
                                            required: true,
                                            cardNumber: true
                                        },
                                        cardExpiry: {
                                            required: true,
                                            cardExpiry: true
                                        },
                                        cardCVC: {
                                            required: true,
                                            cardCVC: true
                                        }
                                    },
                                    highlight: function (element) {
                                        $(element).closest('.form-control').removeClass('success').addClass('error');
                                    },
                                    unhighlight: function (element) {
                                        $(element).closest('.form-control').removeClass('error').addClass('success');
                                    },
                                    errorPlacement: function (error, element) {
                                        $(element).closest('.form-group').append(error);
                                    }
                                });

                                paymentFormReady = function () {
                                    if ($form.find('[name=cardNumber]').hasClass("success") &&
                                        $form.find('[name=cardExpiry]').hasClass("success") &&
                                        $form.find('[name=cardCVC]').val().length > 1) {
                                        return true;
                                    } else {
                                        return false;
                                    }
                                }

                                $form.find('.subscribe').prop('disabled', true);
                                var readyInterval = setInterval(function () {
                                    if (paymentFormReady()) {
                                        $form.find('.subscribe').prop('disabled', false);
                                        clearInterval(readyInterval);
                                    }
                                }, 250);
                                /* If you're using Stripe for payments */
                                function payWithStripe(e) {
                                    e.preventDefault();

                                    /* Abort if invalid form data */
                                    if (!validator.form()) {
                                        return;
                                    }

                                    /* Visual feedback */
                                    $form.find('.subscribe').html('Validating <i class="fa fa-spinner fa-pulse"></i>').prop('disabled', true);

                                    var PublishableKey = $("#stripe_publishable_key").val(); // Replace with your API publishable key
                                    Stripe.setPublishableKey(PublishableKey);

                                    /* Create token */
                                    var expiry = $form.find('[name=cardExpiry]').payment('cardExpiryVal');
                                    var ccData = {
                                        number: $form.find('[name=cardNumber]').val().replace(/\s/g, ''),
                                        cvc: $form.find('[name=cardCVC]').val(),
                                        exp_month: expiry.month,
                                        exp_year: expiry.year
                                    };

                                    Stripe.card.createToken(ccData, function stripeResponseHandler(status, response) {
                                        if (response.error) {
                                            /* Visual feedback */
                                            $form.find('.subscribe').html('Try again').prop('disabled', false);
                                            /* Show Stripe errors on the form */
                                            $form.find('.payment-errors').text(response.error.message);
                                            $form.find('.payment-errors').closest('.row').show();
                                        } else {
                                            /* Visual feedback */
                                            $form.find('.subscribe').html('Processing <i class="fa fa-spinner fa-pulse"></i>');
                                            /* Hide Stripe errors on the form */
                                            $form.find('.payment-errors').closest('.row').hide();
                                            $form.find('.payment-errors').text("");
                                            // response contains id and card, which contains additional card details
                                            console.log(response.id);
                                            console.log(response.card);
                                            var token = response.id;
                                            // AJAX - you would send 'token' to your server here.
                                            $.post('{{url('wallet/usd/deposit/stripe')}}', {
                                                token: token,
                                                _token:'{{ csrf_token() }}',
                                                amount: $('#amount').val(),
                                                stripe_id: $('#deposit_method_id').val()
                                            })
                                            // Assign handlers immediately after making the request,
                                                .done(function (data, textStatus, jqXHR) {
                                                    $form.find('.subscribe').html('Payment successful <i class="fa fa-check"></i>');
                                                    window.location = "{{url('wallet/usd/deposit/done')}}"
                                                })
                                                .fail(function (jqXHR, textStatus, errorThrown) {
                                                    $form.find('.subscribe').html('There was a problem').removeClass('success').addClass('error');
                                                    /* Show Stripe errors on the form */
                                                    $form.find('.payment-errors').text('Try refreshing the page and trying again.');
                                                    $form.find('.payment-errors').closest('.row').show();
                                                });
                                        }
                                    });
                                }
                            }
                        }
                    } else {
                        swal({
                            title: '{{trans_choice('general.error',1)}}',
                            text: '{{trans_choice('general.error_occurred',1)}}',
                            type: 'warning',
                            showCancelButton: false,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: '{{trans_choice('general.ok',1)}}',
                            cancelButtonText: '{{trans_choice('general.cancel',1)}}'
                        })
                    }
                }
                ,
                error: function (e) {
                    swal({
                        title: '{{trans_choice('general.error',1)}}',
                        text: '{{trans_choice('general.error_occurred',1)}}',
                        type: 'warning',
                        showCancelButton: false,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: '{{trans_choice('general.ok',1)}}',
                        cancelButtonText: '{{trans_choice('general.cancel',1)}}'
                    })
                }
            });
        });




    </script>
@endsection
