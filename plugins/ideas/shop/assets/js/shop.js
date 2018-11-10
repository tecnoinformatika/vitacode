$(document).ready(function() {

    var SUCCESS = 1;
    var FAIL = 0;

    var ENABLE = 1;
    var DISABLE = 0;

    var PRODUCT_TYPE_SIMPLE = 1;

    //string to slug with field #...name
    var arrayControllerSlugUpdate = ['Filter', 'Category', 'Products', 'FilterOption'];
    for (var i=0; i<arrayControllerSlugUpdate.length; i++) {
        $('#Form-field-'+arrayControllerSlugUpdate[i]+'-name').stringToSlug({
            getPut: '#Form-field-'+arrayControllerSlugUpdate[i]+'-slug'
        });
    }

    $('#Form-field-Config-name').stringToSlug({
        getPut: '#Form-field-Config-slug',
        space: '_'
    });

    $('#Form-field-Theme-name').stringToSlug({
        getPut: '#Form-field-Theme-slug',
        space: '_'
    });

    var currentUrl = window.location.href;

    /**
     * SHIPPING
     */

    jQuery.showShippingType = function(arrayIdHide, arrayIdShow) {
        var prefixForm = 'Form-field-Ship-';
        for (var i=0; i<arrayIdHide.length; i++) {
            $('#'+ prefixForm + arrayIdHide[i]).parent().hide();
        }
        for (var y=0; y<arrayIdShow.length; y++) {
            $('#'+ prefixForm + arrayIdShow[y]).parent().show();
        }
    };

    jQuery.displayShippingTypeField = function(type) {
        var TYPE_PRICE = 1;
        var TYPE_GEO = 2;
        var TYPE_WEIGHT_BASED = 3;
        var TYPE_PER_ITEM = 4;
        var TYPE_GEO_WEIGHT_BASED = 5;
        if (type == TYPE_PRICE) {
            $.showShippingType(['weight_based', 'geo_zone_id', 'weight_type', 'above_price'], ['cost']);
        }
        if (type == TYPE_GEO) {
            $.showShippingType(['above_price', 'weight_based', 'weight_type'], ['geo_zone_id', 'cost']);
        }
        if (type == TYPE_WEIGHT_BASED) {
            $.showShippingType(['above_price', 'geo_zone_id', 'cost'], ['weight_based', 'weight_type']);
        }
        if (type == TYPE_PER_ITEM) {
            $.showShippingType(['above_price', 'geo_zone_id', 'weight_based', 'weight_type'], ['cost']);
        }
        if (type == TYPE_GEO_WEIGHT_BASED) {
            $.showShippingType(['above_price', 'cost'], ['geo_zone_id', 'weight_based', 'weight_type']);
        }
    };

    $.changeShippingType = function() {
        $('#Form-field-Ship-type-group').change(function(){
            var type = $('#Form-field-Ship-type').val();
            $.displayShippingTypeField(type);
        });
    };

    //shipping create
    if (currentUrl.match(/ship/) && currentUrl.match(/create/)) {
        $('#Form-field-Ship-above_price').parent().hide();
        $('#Form-field-Ship-geo_zone_id').parent().hide();
        $('#Form-field-Ship-weight_based').parent().hide();
        $('#Form-field-Ship-weight_type').parent().hide();
        $.changeShippingType();
    }

    //shipping edit
    if (currentUrl.match(/ship/) && currentUrl.match(/update/)) {
        var typeDiv = $('#Form-field-Ship-type');
        //typeDiv.attr("disabled", "disabled");
        var type = typeDiv.val();
        //alert(type);
        $.displayShippingTypeField(type);
        $.changeShippingType();
    }

    /**
     * END SHIPPING
     */

    /**
     * FILTER OPTION
     */
    var TYPE_COLOR = 1;
    var TYPE_LABEL = 2;
    var TYPE_IMAGE = 3;
    var fieldOptionValue = $('#Form-field-FilterOption-option_value');

    jQuery.changeTypeValueForFilterOption = function(type) {
        var imageContent = $('.find-button');
        var spectrumDiv = $('.sp-replacer');
        if (type == TYPE_COLOR) {
            imageContent.hide();
            fieldOptionValue.val('').hide();
            fieldOptionValue.spectrum({
                preferredFormat: "hex"//to return hex
            });
        }
        if (type == TYPE_LABEL) {
            spectrumDiv.remove();
            imageContent.hide();
            fieldOptionValue.show();
        }
        if (type == TYPE_IMAGE) {
            fieldOptionValue.val('').hide();
            spectrumDiv.remove();
            var divImage = '<a href="javascript::void(0)" class="find-button"' +
                ' onclick="openMediaFinder(this, \'Form-field-FilterOption-option_value\')">'+
                '<span class="find-button-icon oc-icon-image"></span>'+
                '</a>';
            fieldOptionValue.after(divImage);
        }
    };

    /**
     * handle event change type of option and upload image
     */
    jQuery.handleFormFilterOption = function() {
        $('#Form-field-FilterOption-filter_type').change(function() {
            var type = $(this).val();
            $.changeTypeValueForFilterOption(type);
        });
    };

    //filter option create
    if (currentUrl.match(/filteroption/) && currentUrl.match(/create/)) {
        //initial assign for color picker
        fieldOptionValue.spectrum({
            preferredFormat: "hex"//to return hex
        });
        $.handleFormFilterOption();
    }

    //filter option edit
    if (currentUrl.match(/filteroption/) && currentUrl.match(/update/)) {
        $.handleFormFilterOption();
        //check initial
        var typeCurrent = $('#Form-field-FilterOption-filter_type').val();
        if (typeCurrent == TYPE_COLOR) {
            fieldOptionValue.spectrum({
                preferredFormat: "hex",//to return hex
                color: fieldOptionValue.val()
            });
        }
        if (typeCurrent == TYPE_IMAGE) {
            fieldOptionValue.hide();
            var divImage = '<a href="javascript::void(0)" class="find-button"' +
                ' onclick="openMediaFinder(this, \'Form-field-FilterOption-option_value\')">'+
                '<img src="'+ baseUrl + '/storage/app/media' +fieldOptionValue.val() + '" >'+
                '</a>';
            fieldOptionValue.after(divImage);
        }
    }
    /**
     * END FILTER OPTION
     */


    //create tax class
    $.addMultiSelectCheckbox('tax-rate-select', function() {
        //check when update product
        if(document.getElementById("tax_rule_update") !== null) {
            var tax = $('#tax_rule_update').val();
            var selectedValues = tax.split(',');//selectedValues is array
            $("#tax-rate-select").val(selectedValues).trigger("change");
        }
    });

    //create product
    $.addMultiSelectCheckbox('category-select', function() {
        //check when update product
        if(document.getElementById("cat_update") !== null) {
            var cat = $('#cat_update').val();
            var selectedValues = cat.split(',');//selectedValues is array
            $("#category-select").val(selectedValues).trigger("change");
        }
    });


    /* Validate product category */
    if (currentUrl.match(/products/) && currentUrl.match(/create/) ||
        currentUrl.match(/products/) && currentUrl.match(/update/) ) {
        $('#Form-field-Products-product_type-group').hide();
        $('.loading-indicator-container button').click(function() {
            var category = $('#category-select').val();
            if (category == undefined) {
                $.displayFlashMsg('You have to choose a category', 'error');
            }
            var variantJson = $('#variant_json').val();
            if (variantJson == '' || variantJson == '[]') {
                $.displayFlashMsg('You have to create at leas 1 variant', 'error');
            }
        });
        //downloadable product
        $('#Form-field-Products-_link').click(function() {
            openMediaFinderForDownloadableProduct('Form-field-Products-_link');
        });
    }

    /*PRODUCT CONFIGURABLE*/
    $('#filter-choose').hide();
    $('#new-products').click(function(e) {
        e.preventDefault();
        var isCreateSimpleProductDefault = $('#is_create_simple_product_default').val();
        if (isCreateSimpleProductDefault == ENABLE) {//just create simple product default
            var url = $('#new-products').attr('href');
            window.location.href = url + '?type='+PRODUCT_TYPE_SIMPLE;
        } else {//choose product type
            $('#modalChooseType').modal();
        }

    });

    $('#choose-configurable').click(function() {
        $('#filter-choose').show();
        $('#button-choose').hide();
    });

    $('#back-to-choose').click(function() {
        $('#filter-choose').hide();
        $('#button-choose').show();
    });

    $('#choose-filter-configurable').click(function() {
        var adminUrl = $('#admin_url').val();
        var filterArray = [];
        $('.filter-choose').each(function() {
            if ($(this).is(':checked')) {
                filterArray.push($(this).val());
            }
        });
        if (filterArray.length == 0) {
            $.displayFlashMsg('You have to choose a filter', 'error');
        } else {
            var filterUrl = '';
            for (var i=0; i<filterArray.length; i++) {
                filterUrl += 'filter[]='+filterArray[i]+'&';
            }
            filterUrl = filterUrl.substring(0, filterUrl.length-1);//remove last character '&'
            window.location.href = adminUrl + '/ideas/shop/products/create?type=2&' + filterUrl;
        }
    });
    /*END PRODUCT CONFIGURABLE*/

    /*THEME*/
    /*Display field base by choose theme type*/
    jQuery.showOnlyOne = function(chose, classHide) {
        $('.'+classHide).each(function(index) {
            if ($(this).attr("id") == chose) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    };
    jQuery.displayThemeType = function(type) {
        var typeArray = ['','text', 'image'];
        var divId = 'theme-'+typeArray[type];
        $.showOnlyOne(divId, 'theme_value');
    };
    jQuery.changeThemeType = function() {
        $('#Form-field-Theme-type').change(function() {
            var type = $(this).val();
            $.displayThemeType(type);
        });
    };
    jQuery.addThemeImage = function(imageIndex) {
        var adminUrl = $('#admin_url').val();
        $.ajax({
            url: adminUrl + '/ideas/shop/theme/addimage',
            type: 'POST',
            dataType: 'html',
            data: {index: imageIndex},
            success: function(data) {
                $('#theme-image-div').append(data);
            }
        });
    };
    if (currentUrl.match(/theme/) && currentUrl.match(/create/) ||
        currentUrl.match(/theme/) && currentUrl.match(/update/)) {
        $.showOnlyOne('theme-text', 'theme_value');
        $.changeThemeType();
        $('.loading-indicator-container button').click(function() {
            var i = 1;
            $('.image_order').each(function() {
                $(this).val(i);
                i++;
            })
        })
    }
    if (currentUrl.match(/theme/) && currentUrl.match(/create/)) {
        $.addThemeImage(1);//initial theme image
    }

    if (currentUrl.match(/theme/) && currentUrl.match(/update/)) {
        var typeEdit = $('#Form-field-Theme-type').val();
        $.displayThemeType(typeEdit);
        $.changeThemeType();
    }
    $(document).on('click', '.image-finder', function() {
        var imageIndex = $(this).closest('.theme-image-item').attr('attr-image-index');
        openMediaFinder($(this), 'theme-image-'+imageIndex);
    });
    jQuery.reindexToAssignImage = function() {
        //reindex theme image to assign image
        var i=1;
        $('.theme-image-index').each(function() {
            $(this).attr('id', 'theme-image-'+i);
        })
    };
    $('#add-image').click(function() {
        var lengthCurrent = $('.theme-image-item').length;
        $.addThemeImage(parseInt(lengthCurrent) + 1);
        $.reindexToAssignImage();
    });
    $('#theme-image-div').sortable('enable');//just use for <ul><li></li></ul>
    $(document).on('click', '.image-trash', function() {
        $(this).parent().parent().remove();
        $.reindexToAssignImage();
    });
    /*END THEME*/

    jQuery.select2Autocomplete = function(selectDiv, url) {
        $(selectDiv).select2({
            ajax: {
                url: url,
                method: "post",
                dataType: 'json',
                delay: 0,
                data: function (params) {
                    return {
                        q: params.term, // search term
                        page: params.page
                    };
                },
                processResults: function (data, params) {
                    return {
                        results: $.map(data, function(obj) {
                            return { id: obj.id, text: obj.text};
                        })
                    };
                },
                cache: true
            },
            escapeMarkup: function (markup) {
                return markup;
            }, // let our custom formatter work
            minimumInputLength: 2
        });
    }

    jQuery.generateString = function(num) {
        var text = "";
        var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz123456789";
        for (var i = 0; i < num; i++)
            text += possible.charAt(Math.floor(Math.random() * possible.length));
        return text;
    };

    /*COUPON*/
    if (currentUrl.match(/coupon/) && currentUrl.match(/create/) ||
        currentUrl.match(/coupon/) && currentUrl.match(/update/) ) {
        var adminUrl = $('#admin_url').val();
        var categorySearchUrl = adminUrl+"/ideas/shop/coupon/searchcategory";
        var productSearchUrl = adminUrl+"/ideas/shop/coupon/searchproduct";
        $.select2Autocomplete('#category-search', categorySearchUrl);
        $.select2Autocomplete('#product-search', productSearchUrl);

        //add refresh coupon code
        $('#Form-field-Coupon-code-group').after('<i class="icon-refresh" id="refresh-coupon"></i>');
        $(document).on('click', '#refresh-coupon', function() {
            var couponPrefix = $('#coupon_prefix').val();
            var couponLengthRandom = $('#coupon_length_random').val();
            var randomString = $.generateString(couponLengthRandom);
            var randomCode = couponPrefix + randomString;
            $('#Form-field-Coupon-code').val(randomCode);
        });
    }
    //assign product and category coupon when update coupon
    if (currentUrl.match(/coupon/) && currentUrl.match(/update/)) {
        var categoryStr = $('#category_update').val();
        var categoryArray = categoryStr.split(',');
        var productStr = $('#product_update').val();
        var productArray = productStr.split(',');
        $('#category-search').val(categoryArray).trigger('change');
        $('#product-search').val(productArray).trigger('change');
    }
    /* END COUPON */

    /*hide config is_default*/
    if (currentUrl.match(/config/)) {
        $('#Form-field-Config-is_default').hide();
    }

    /*hide delete document*/
    if (currentUrl.match(/document/)) {
        $('.oc-icon-trash-o').hide();
    }

    //Send download link when customer buy downloadable product
    $('#send-download-link').click(function() {
        var params = {};
        params.email = $(this).attr('attr-email');
        params.productId = $(this).attr('attr-product-id');
        params.link = $(this).attr('attr-link');
        $('#layout-body').waitMe({color: '#5bc0de'});
        $.request('onSendDownloadLink', {
            data: params,
            success: function(res) {
                if (res == SUCCESS) {
                    $.displayFlashMsg('Send mail successful', 'success');
                } else {
                    $.displayFlashMsg('Send mail fail', 'error');
                }
                $('#layout-body').waitMe('hide');
            }
        });
    });

    //disable add review
    if (currentUrl.match(/review/) && currentUrl.match(/index/)) {
        $('#new-review').hide();
    }

    /**
     * Assign html for return order
     */
    jQuery.assignHtmlForReturnOrder = function(productObj) {
        var html = '<table class="table-bordered table-order">';
        html += '<thead>';
        html += '<tr>';
        html += '<th width="60%">Name</th>';
        html += '<th width="20%" style="text-align: center">Check</th>';
        html += '<th width="20%" style="text-align: center">Qty reverse</th>';
        html += '</tr>';
        html += '</thead>';
        html += '<tbody>';
        for (var i=0; i<productObj.length;i++) {
            html += '<tr>';
            html += '<td width="60%">'+productObj[i].name+'</td>';
            html += '<td width="20%" style="text-align: center">';
            html += '<div class="checkbox custom-checkbox" id="checkbox-product-div-'+productObj[i].product_id+'">'+
                '<input name="checkbox" class="checkbox-return-product" value="'+productObj[i].product_id+'"' +
                ' type="checkbox" id="checkbox-product-'+productObj[i].product_id+'" checked/>'+
                '<label for="checkbox-product-'+productObj[i].product_id+'"></label>'+
                '</div>';
            html += '</td>';
            html += '<td width="20%" style="text-align: center">';
            html += '<div class="checkbox custom-checkbox" id="checkbox-qty-reverse-div-'+productObj[i].product_id+'">'+
                '<input name="checkbox" class="checkbox-qty-reverse" value="'+productObj[i].product_id+'"' +
                ' type="checkbox" id="checkbox-qty-reverse-'+productObj[i].product_id+'" checked/>'+
                '<label for="checkbox-qty-reverse-'+productObj[i].product_id+'"></label>'+
                '</div>';
            html += '</td>';
            html += '</tr>';
        }
        html += '</tbody>';
        html += '</table>';
        $('#product-return').html(html);
    };

    /**
     * Return product
     */
    $('#btn-return-product').click(function() {
        var productData = $('#product-data').text();
        var productObj = JSON.parse(productData);
        $.assignHtmlForReturnOrder(productObj);
        $.request('onCheckProductIsReturned', {
            data: productObj,
            success: function(res) {
                var productIdArray = res.productIdArray;
                var productIdArrayReturned = res.productIdArrayReturned;
                for (var i=0; i<productIdArrayReturned.length; i++) {
                    $('#checkbox-product-div-'+productIdArrayReturned[i]).empty().html('<span class="btn-returned">Returned</span>');
                    $('#checkbox-qty-reverse-'+productIdArrayReturned[i]).attr('disabled', true);
                }
                if (productIdArray.length == productIdArrayReturned.length) {
                    $('#create-order-return').hide();
                }
                $('#modalReturnProduct').modal();
            }
        });

    });

    $('#create-order-return').click(function() {
        var orderData = $('#order-data').text();
        var productData = $('#product-data').text();
        var orderObj = JSON.parse(orderData);
        var productObj = JSON.parse(productData);
        var productChecked = [];
        var qtyReverse = [];
        $('.checkbox-return-product').each(function() {
           if ($(this).is(':checked')) {
               productChecked.push($(this).val());
           }
        });
        $('.checkbox-qty-reverse').each(function() {
            if ($(this).is(':checked')) {
                qtyReverse.push($(this).val());
            }
        });
        if (productChecked.length == 0) {
            $.displayFlashMsg('You have to choose at least one product', 'error');
        } else {
            var params = {};
            params.order = orderObj;
            params.product = productObj;
            params.product_checked = productChecked;
            params.qty_reverse = qtyReverse;
            params.reason_id = $('#reason-return-order').val();
            $.request('onCreateOrderReturn', {
                data: params,
                success: function(res) {
                    $('#modalReturnProduct').modal('hide');
                    if (res.result == SUCCESS) {
                        $.displayFlashMsg('Create order return successful', 'success')
                    }
                }
            });
        }
    });

    //hide add new for order return
    if (currentUrl.match(/orderreturn/)) {
        $('#new-orderreturn').hide();
        $('.oc-icon-trash-o ').hide();
    }

    if (currentUrl.match(/order/) && currentUrl.match(/update/)) {
        $('.btn-not-paid, .btn-paid').click(function() {
            var params = {};
            params.id = $(this).attr('attr-order-id');
            params.payment_status = $(this).attr('attr-status-change');
            $.alertable.confirm('You change your payment status ?', params).then(function() {
                $.request('onChangePaymentStatus', {
                    data: params,
                    success: function() {
                        location.reload();
                    }
                });
            });
        });
    }

    //Update config default
    $('#update-config-default').click(function() {
        $('#layout-body').waitMe({color: '#1f99dc'});
    })
});
