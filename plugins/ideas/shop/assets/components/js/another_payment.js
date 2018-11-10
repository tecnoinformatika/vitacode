$(document).ready(function() {


    //call event beforeSaveOrder
    $(document).on('beforeSaveOrder', function(e, params) {
        console.log(params);
        console.log(params.params);
        //do something
        $('#checkout-div').waitMe({color: '#3c66c6'});
        $.saveOrder(params.params);
    });

    //call event afterSaveOrder
    $(document).on('afterSaveOrder', function(e, params) {
        console.log(params);
        console.log(params.params);
        console.log(params.orderId);
        //do something
        //delete cart
        var baseUrl = window.location.origin;
        sessionStorage.setItem('cart', '');
        window.location.href = baseUrl+'/'+$('#checkout_ok_url').val();

    });


});
