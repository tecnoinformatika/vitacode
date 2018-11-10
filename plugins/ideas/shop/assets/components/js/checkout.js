/**
 * Calculate separate ship and coupon based on totalPrice
 * then assign to div #ship-money and #coupon-reduce
 * finally: $.assignTotalPriceSpanDiv()
 * (tax : calculate before add-to-cart event)
 */
//find closest number
function closest (num, arr) {
    var mid;
    var lo = 0;
    var hi = arr.length - 1;
    while (hi - lo > 1) {
        mid = Math.floor ((lo + hi) / 2);
        if (arr[mid] < num) {
            lo = mid;
        } else {
            hi = mid;
        }
    }
//    if (num - arr[lo] <= arr[hi] - num) {
//        return arr[lo];
//    }
//    return arr[hi];
    return arr[lo];
}

//function anotherPaymentMethod(paymentMethodId, params) {
//
//}

//generate random string
function generateRandomString(length) {
    var text = "";
    var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz123456789";
    for (var i = 0; i < parseInt(length); i++)
        text += possible.charAt(Math.floor(Math.random() * possible.length));
    return text;
}


$(document).ready(function() {

    var baseUrl = window.location.origin;

    var TYPE_PRICE = 1;
    var TYPE_GEO = 2;
    var TYPE_WEIGHT_BASED = 3;
    var TYPE_PER_ITEM = 4;
    var TYPE_GEO_WEIGHT_BASED = 5;

    var WEIGHT_TYPE_FIXED = 1;
    var WEIGHT_TYPE_RATE = 2;

    var totalPriceSpanDiv = 'total-price-span';
    var totalPriceHiddenDiv = 'total-price-hidden';
    var shipMoneyDiv = 'ship-money';
    var couponReduceDiv = 'coupon-reduce';

    var CASH_ON_DELIVERY = 1;
    var PAYPAL = 2;
    var STRIPE = 3;

    var SAVE_ORDER_FAIL = 0;

    var waitMeColor = '#3c66c6';

    var currentUrl = window.location.href;

    var IS_LOGIN = 1;
    var NOT_LOGIN = 0;

    var SUCCESS = 1;
    var FAIL = 0;

    var msgJsJson = $('#msg_js').text();
    var msgJs = JSON.parse(msgJsJson);

    jQuery.validateDynamic = function(callback) {
        //add dynamic validate class
        $.validator.addClassRules({
            dynamic_email: {
                email: true
            },
            dynamic_required: {
                required: true
            },
            dynamic_number: {
                number: true
            },
            dynamic_equal: {
                equalTo: "#password"
            },
            dynamic_min: {//don't use 'min' here, use 'minlength'
                minlength: function(element) {
                    return $(element).attr('attr-min');
                }
            }
        });
        if (typeof callback == 'function') { // make sure the callback is a function
            callback.call(this);
        }
    };

    jQuery.ajaxCartCheckout = function() {
        var cartRs = sessionStorage.getItem('cart');
        var cartRsObj = JSON.parse(cartRs);
        $.request('onAjaxCart', {
            data: cartRsObj,
            update: { 'Checkout::ajaxCartCheckout' : '#ajax-cart-checkout'}
        });
    };

    if (currentUrl.match(/checkout/)) {//if page cart
        $.ajaxCartCheckout();
    }

    jQuery.getTotalPriceFinal = function() {
        var totalPrice = $('#'+totalPriceHiddenDiv).val();
        var couponMoney = parseFloat($('#'+couponReduceDiv).text());
        var priceShip = parseFloat($('#'+shipMoneyDiv).text());
        var total = parseFloat(totalPrice) + priceShip - couponMoney;
        return total;
    }

    jQuery.assignTotalPriceSpanDiv = function() {
        var total = $.getTotalPriceFinal();
        $('#'+totalPriceSpanDiv).text(total);
    };

    jQuery.calculateShipPrice = function(thisDiv) {
        var type = thisDiv.attr('attr-type');
        var cost = thisDiv.attr('attr-cost');
        var priceShip = 0;
        if (type == TYPE_PRICE || type == TYPE_GEO) {
            priceShip = parseFloat(cost);
        }
        if (type == TYPE_PER_ITEM) {
            var qtyTotal = $('#qty-total-hidden').val();
            priceShip = parseFloat(cost) * qtyTotal;
        }
        if (type == TYPE_WEIGHT_BASED || type == TYPE_GEO_WEIGHT_BASED) {
            var weightTotal = $('#weight-total').text();
            var weightBased = thisDiv.attr('attr-weight-base');
            var weightType = thisDiv.attr('attr-weight-type');
            var weightTotalCeil = parseInt(Math.ceil(weightTotal));
            if (weightType == WEIGHT_TYPE_FIXED) {//fixed
                var weightRateFix = weightBased.split(':');
                var eachUnit = parseInt(weightRateFix[0]);
                var unitPrice = parseFloat(weightRateFix[1]);
                priceShip = (weightTotalCeil / eachUnit) * unitPrice;
            } else {//rate
                var weightRateRate = weightBased.split(',');
                var weightRateArray = [];
                var weightRateArrayIndex = [];
                for (var i=0; i<weightRateRate.length; i++) {
                    var weightRateSplit = weightRateRate[i].split(':');
                    weightRateArray[weightRateSplit[0]] = weightRateSplit[1];
                    weightRateArrayIndex.push(weightRateSplit[0]);
                }
                //find closet lowest in array
                var indexClosest = closest(weightTotalCeil, weightRateArrayIndex);
                priceShip = weightRateArray[indexClosest];
            }
        }
        $('#'+shipMoneyDiv).text(priceShip);
        var symbol = $('#symbol').val();
        var symbolPosition = $('#symbol_position').val();
        var symbolPositionBefore = $('#symbol_position_before').val();
        var textShippingCost = '';
        if (symbolPosition == symbolPositionBefore) {
            textShippingCost = symbol + ' ' + priceShip;
        } else {
            textShippingCost = priceShip + ' ' + symbol;
        }
        $('#shipping-cost').text(textShippingCost);
        $.assignTotalPriceSpanDiv();
    };

    /**
     * Choose shipping method
     */
    $('.shipping-method-type').click(function() {
        $.calculateShipPrice($(this))
    });

    //Handle coupon code
    $(document).on('click', '#apply-coupon', function() {
        var coupon = $('#coupon_code').val();
        var cartRs = sessionStorage.getItem('cart');
        var cartRsObj = JSON.parse(cartRs);
        var totalPrice = $('#'+totalPriceHiddenDiv).val();
        var params = {};
        params.cart = cartRsObj;
        params.coupon = coupon;
        params.totalPrice = totalPrice;
        $.request('onCheckCoupon', {
            data: params,
            success: function(res) {
                if (res.rs == false) {
                    $.notify(res.error);
                } else {
                    $('#'+couponReduceDiv).text(totalPrice - res.discount_price);
                    $('#coupon_id').val(res.coupon_id);
                    $.assignTotalPriceSpanDiv();
                }
            }
        });
    });

    //Checkout by paypal
    jQuery.checkoutPaypal = function(params, orderId) {
        var urlSuccessInput = $('#url_success');
        var numberRandom = generateRandomString(10);
        numberRandom = numberRandom + '_' + orderId;
        sessionStorage.setItem('token_paypal', numberRandom);
        sessionStorage.setItem('order_info', params);
        var urlSuccess = urlSuccessInput.val();
        urlSuccessInput.val(urlSuccess+'?token='+numberRandom);
        var cartRs = sessionStorage.getItem('cart');
        var cartObj = JSON.parse(cartRs);
        var nameItems = '';
        $.each(cartObj, function(index, value){
            nameItems += value.name+' x '+value.qty+', ';
        });
        nameItems = nameItems.substring(0, nameItems.length - 2);//remove last ', '
        //assign paypal information to checkout
        $('#paypal_item_name').val('Order Id : '+ orderId);
        $('#paypal_item_qty').val($('#qty-total-hidden').val());
        $('#total_amount_paypal').val($.getTotalPriceFinal());
        $('#currency_code_paypal').val($('#currency_code').text());
        $('#paypal_method_form').submit();
    };

    //checkout stripe
    jQuery.checkoutStripe = function(params) {
        var handler = StripeCheckout.configure({
            key: $('#stripe_publish').val(),//public key
            image: 'https://stripe.com/img/documentation/checkout/marketplace.png',
            locale: 'auto',
            token: function(token) {
                var tokenVar = token.id;
                $.request('onCheckOutStripe', {
                    data: { tokenVar: tokenVar, params: params},
                    beforeSend : function() {
                        //don't use 'closed' event on handler.open()
                        $('#checkout-div').waitMe({color: waitMeColor});
                    },
                    success: function(res) {
                        $('#checkout-div').waitMe('hide');
                        if (res == SUCCESS) {
                            sessionStorage.setItem('cart', '');
                            window.location.href = baseUrl+'/'+$('#checkout_ok_url').val();
                        } else {
                            $.notify(res);
                        }
                    }
                });
            }
        });
        var isLogin = $('input[name="is_login"]').val();
        var customerEmail = '';
        if (isLogin == IS_LOGIN) {
            customerEmail = $('#logged_in_email').val();
        } else {
            customerEmail = $('#billing_email').val();
        }
        handler.open({
            name: msgJs.checkout_stripe,
            description: msgJs.checkout_stripe_gateway,
            amount: $.getTotalPriceFinal() * 100,
            currency: $('#currency_code').text(),
            email: customerEmail,
            image: $('#stripe_logo').val()
        });
    };


    //Save order
    jQuery.saveOrder = function(params) {
        $.request('onSaveOrder', {
            data: params,
            success: function(orderId) {
                if (orderId != SAVE_ORDER_FAIL) {
                    if (params.payment_method_id == CASH_ON_DELIVERY) {
                        sessionStorage.setItem('cart', '');
                        window.location.href = baseUrl+'/'+$('#checkout_ok_url').val();
                        return;
                    }
                    if (params.payment_method_id == PAYPAL) {
                        $.checkoutPaypal(params, orderId);
                        sessionStorage.setItem('cart', '');
                        return;
                    }
                    // create hook for after save order  for another payment
                    $(document).trigger( "afterSaveOrder", {params:params, orderId:orderId} );
                } else {
                    window.location.href = baseUrl+'/'+$('#checkout_fail_url').val();
                }
            }
        });
    };

    $('#use_same_address_not_login').click(function() {
        var ShippingAddRequired = [
            'shipping_first_name', 'shipping_last_name', 'shipping_email', 'shipping_phone', 'shipping_address'
        ];
        if (!$(this).is(':checked')) {
            $('#guest-shipping-detail').removeClass('class-hidden');
            //add validate to shipping address when user not login
            $.each(ShippingAddRequired, function(index, value) {
                $('#'+value).addClass('dynamic_required')
            });
            $('#shipping_email').addClass('dynamic_email');
        } else {
            $('#guest-shipping-detail').addClass('class-hidden');
            //remove validate to shipping address when user not login
            $.each(ShippingAddRequired, function(index, value) {
                $('#'+value).removeClass('dynamic_required')
            });
            $('#shipping_email').removeClass('dynamic_email');
        }
    });

    //checkout
    $('#checkout-button').click(function() {
        if (!$('#payment_agree').is(':checked')) {
           $.notify(msgJs.have_to_agree_privacy_policy);
           return;
        }
        if (!$('#confirm_agree').is(':checked')) {
           $.notify(msgJs.have_to_agree_term);
           return;
        }
        var paymentMethodId = $('input[name="payment_method"]:checked').val();
        if (paymentMethodId == undefined) {
            $.notify(msgJs.have_to_choose_a_payment_method);
        } else {
            var isLogin = $('input[name="is_login"]').val();
            var params = {};
            if (isLogin == IS_LOGIN) {
                //if login
                var addressBilling = $('input[name="user_address_billing"]:checked').val();
                var addressShipping = 0;
                if (!$('input[name="use_same_address"]').is(':checked')) {
                    addressShipping = $('input[name="user_address_ship"]:checked').val();
                } else {
                    addressShipping = addressBilling;
                }

                if (addressBilling == undefined || addressShipping == undefined) {
                    $.notify(msgJs.have_billing_address);
                    return;
                }
                params.address_billing = addressBilling;
                params.address_shipping = addressShipping;
            } else {
                //if not login
                //add validate to billing address
                var billingAddRequired = [
                    'billing_first_name', 'billing_last_name', 'billing_email', 'billing_phone', 'billing_address'
                ];
                $.each(billingAddRequired, function(index, value) {
                    $('#'+value).addClass('dynamic_required')
                });
                $('#billing_email').addClass('dynamic_email');
                var form = $('#form-payment-not-login');
                var isValid = false;
                $.validateDynamic(function() {
                    form.validate();//init validate
                    if (form.valid()) {
                        isValid = true;
                    }
                });
                if (isValid == false) {
                    $.notify(msgJs.have_to_fill_address);
                    return;
                }
            }
            params.user_id = $('#user_id').val();
            params.shipping_cost = parseFloat($('#'+shipMoneyDiv).text());
            params.total = $.getTotalPriceFinal();
            params.order_status_id = 1;
            var cartRs = sessionStorage.getItem('cart');
            params.cart = JSON.parse(cartRs);
            params.payment_method_id = paymentMethodId;
            params.form_payment_not_login = $('#form-payment-not-login').serializeArray();
            params.shipping_rule_id = $('input[name="shipping_rule"]:checked').attr('attr-id');
            params.currency_code = $('#currency_code').text();
            params.coupon_id = $('#coupon_id').val();
            params.coupon_total = $('#coupon-reduce').text();
            params.comment = $('#comment').val();
            sessionStorage.setItem('orderParams', JSON.stringify(params));
            //just save order if it not stripe checkout
            if (params.payment_method_id == STRIPE) {
                $.checkoutStripe(params);
            } else if (params.payment_method_id == CASH_ON_DELIVERY
                || params.payment_method_id == PAYPAL) {
                $('#checkout-div').waitMe({color: waitMeColor});
                $.saveOrder(params);
            } else {
                // create hook for before save order for another payment
                $(document).trigger( "beforeSaveOrder", {params:params} );
            }

        }

    });

    //paypal success
    if (document.getElementById('paypal_success') !== null) {
        var tokenPaypal = sessionStorage.getItem('token_paypal');
        sessionStorage.setItem('token_paypal', 0);//reset to 0
        var paypalTokenGet = $('#paypal_token').text();
        if (tokenPaypal == paypalTokenGet) {//save order
            $.request('onPaypalSuccess', {
                data: {token:tokenPaypal}
            });
        } else {
            document.location.href = baseUrl+'/paypal/cancel';
        }
    }


});
