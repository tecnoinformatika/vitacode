$(document).ready(function() {

    var msgJsJson = $('#msg_js').text();
    var msgJs = JSON.parse(msgJsJson);

    //count qty in header
    jQuery.countQty = function() {
        var cartRs = sessionStorage.getItem('cart');
        var qty = 0;
        if (cartRs != null && cartRs != '') {
            var cartRsObj = JSON.parse(cartRs);
            $.each(cartRsObj, function(index, value) {
                qty += value.qty
            });
        }
        $('#cart-count').text(qty);
    };

    //reload cart dropdown
    jQuery.reloadCartDropdown = function() {
        var cartRs = sessionStorage.getItem('cart');
        var cartRsObj = {};
        if (cartRs != null && cartRs != '') {
            cartRsObj = JSON.parse(cartRs);
        }
        $.request('onReloadCartDropdown', {
            data: cartRsObj,
            update: { 'Cart::dropdown' : '#cart-dropdown'}
        });
    };

    $.countQty();
    $.reloadCartDropdown();

    //add or update cart
    jQuery.addOrUpdateCart = function(thisDiv, qtyAdd, updateQty) {
        var productId = thisDiv.attr('attr-product-id');
        var qtyOrigin = thisDiv.attr('attr-qty');
        var cart = sessionStorage.getItem('cart');
        var cartObject = {};
        if (cart != null && cart != '') {
            cartObject = JSON.parse(cart);
        }
        var itemDetail = {};
        itemDetail.name = thisDiv.attr('attr-name');
        itemDetail.image = thisDiv.attr('attr-image');
        itemDetail.price = thisDiv.attr('attr-price');
        itemDetail.qty = qtyAdd;//number product customer buy
        itemDetail.qty_origin = qtyOrigin;//quantity in stock
        itemDetail.qty_order = thisDiv.attr('attr-qty-order');//quantity that ordered
        itemDetail.id = productId;
        itemDetail.slug = thisDiv.attr('attr-slug');
        itemDetail.weight = thisDiv.attr('attr-weight');
        itemDetail.weight_id = thisDiv.attr('attr-weight-id');
        var msg = '';
        if (productId in cartObject) {
            var itemInCart = cartObject[productId];
            itemInCart.qty = itemInCart.qty + 1;
            if (updateQty == true) {
                msg = 'You\'ve just update your cart successfully';
                itemInCart.qty = qtyAdd;
            } else {
                //msg = 'You\'ve just added one item successfully';
                $('#modalConfirmCart').modal();
            }
            cartObject[productId] = itemInCart;
        } else {
            cartObject[productId] = itemDetail;
            $('#modalConfirmCart').modal();
        }
        sessionStorage.setItem('cart', JSON.stringify(cartObject));
        $.notify(msg, msgJs.add_item_success);
        $.countQty();
        $.reloadCartDropdown();
    };

    //add or update cart in detail page
    jQuery.addOrUpdateInDetail = function(qty, qtyOrder, thisDiv) {
        var qtyInput = $('#qty-input').val();
        if (parseInt(qtyInput) + parseInt(qtyOrder) > qty && qty > 0) {//if qty = 0 => not manage stock
            $.notify(msgJs.qty_not_enough);
        } else {
            $.addOrUpdateCart(thisDiv, parseInt(qtyInput));
        }
    };

    //handle event click to buy product
    jQuery.buyNow = function(thisDiv, isDetail) {
        var qty = thisDiv.attr('attr-qty');
        var qtyOrder = thisDiv.attr('attr-qty-order');
        var productId = thisDiv.attr('attr-product-id');
        var cart = sessionStorage.getItem('cart');
        var cartObject = {};
        if (cart != null && cart != '') {
            cartObject = JSON.parse(cart);
        }
        if (productId in cartObject) { // if product already in cart
            var itemInCart = cartObject[productId];
            var qtyInCart = itemInCart.qty;
            if (parseInt(qtyInCart) + parseInt(qtyOrder) >= qty && qty > 0) {//if qty = 0 => not manage stock
                $.notify(msgJs.qty_not_enough);
            } else {
                if (isDetail == false) {
                    $.addOrUpdateCart(thisDiv, 1);
                } else {
                    $.addOrUpdateInDetail(qty, qtyOrder, thisDiv);
                }
            }
        } else {//if product not in cart yet
            if (isDetail == false) {//if not in detail page
                $.addOrUpdateCart(thisDiv, 1);
            } else {
                $.addOrUpdateInDetail(qty, qtyOrder, thisDiv);
            }
        }
    };

    //buy now in list
    $('.buy-now').click(function() {
        $.buyNow($(this), false);
    });

    //buy now in detail
    $('.buy-now-detail').click(function() {
        $.buyNow($(this), true);
    });

    //delete cart item
    jQuery.deleteItem = function(productId) {
        var cartRs = sessionStorage.getItem('cart');
        var cartRsObj = JSON.parse(cartRs);
        delete cartRsObj[productId];
        sessionStorage.setItem('cart', JSON.stringify(cartRsObj));
        $.countQty();
        $.reloadCartDropdown();
    };

    $(document).on('click', '.cart-remove-item', function() {
        if (confirm('Are you sure delete this item ?')) {
            var productId = $(this).attr('attr-product-id');
            $.deleteItem(productId);
        }
    });

    $(document).on('click', '.view-now', function() {
        var slug = $(this).attr('attr-slug');
        var baseUrl = document.location.origin;
        document.location.href = baseUrl + '/' + slug;
    });

    var currentUrl = window.location.href;

    jQuery.ajaxCart = function() {
        var cartRs = sessionStorage.getItem('cart');
        var cartRsObj = JSON.parse(cartRs);
        $.request('onAjaxCart', {
            data: cartRsObj,
            update: { 'Cart::ajaxCart' : '#cart-div'}
        });
    };

    if (currentUrl.match(/cart/)) {//if page cart
        $.ajaxCart();
    }

    $(document).on('click', '.cart-remove-item-detail', function() {
        if (confirm('Are you sure delete this item ?')) {
            var productId = $(this).attr('attr-product-id');
            $.deleteItem(productId);
            $.ajaxCart();
        }
    });

    //catch keypress event - enter when search product
    $(document).on('keypress', '.cart-qty', function(e) {
        if(e.which == 13){
            e.preventDefault();//Enter key pressed
            var productId = $(this).attr('attr-product-id');
            var qtyInput = $(this).val();
            var qtyOrigin = $(this).attr('attr-qty');//quantity in stock
            var qtyOrder = $(this).attr('attr-qty-order');//quantity was ordered
            var cartRs = sessionStorage.getItem('cart');
            var cartRsObj = JSON.parse(cartRs);
            var item = cartRsObj[productId];
            var qty = item.qty;//number product customer buy
            if (parseInt(qtyInput) + parseInt(qtyOrder) > parseInt(qtyOrigin) && qtyOrigin > 0) {//if qty = 0 => not manage stock
                $.notify(msgJs.qty_not_enough);
            } else {
                console.log(qtyInput);
                $.addOrUpdateCart( $(this), parseInt(qtyInput), true);
                $.ajaxCart();
            }
        }
    });

    //display modal to add user address - billing and shipping
    $('.modal-add-user-address').click(function() {
        $('.span-add-address').show();
        $('.span-update-address').hide();
        $('#form-user-address')[0].reset();
        $('#modalAddress').modal();

    });


});