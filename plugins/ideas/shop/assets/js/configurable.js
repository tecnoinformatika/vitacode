/**
 * ADD AND EDIT VARIANT FOR CONFIGURABLE PRODUCT
 */
$(document).ready(function() {
    var currentUrl = window.location.href;
    var baseUrl = window.location.origin;
    var VALID = 1;
    var INVALID = 0;
    var variantValidateDiv = $('#variant_validate');
    var variantJsonDiv = $('#variant_json');
    var imageVariantDiv = $('#variant-featured-image');

    //GET VARIANT DATA TO SAVE AND UPDATE
    jQuery.getVariantData = function() {
        var objVariant = {};
        objVariant.qty = $('#qty_variant').val();
        objVariant.price = $('#price_variant').val();
        objVariant.featured_image = $('#featured_image_variant').val();
        var gallery = [];
        $('.gallery-variant-image').each(function() {
            gallery.push($(this).text());
        });
        objVariant.gallery = gallery;
        var selectVariant = [];
        var selectVariantLabel = [];
        $('.filter-option-config').each(function() {
            selectVariant.push($(this).val());
            selectVariantLabel.push($(this).find('option:selected').text());
        });
        var filterIdArray = [];
        $('.filter-id').each(function() {
            filterIdArray.push($(this).val());
        });
        objVariant.str_filter_id = filterIdArray.join();
        objVariant.str_filter_option_id = selectVariant.join();
        objVariant.str_variant_label = selectVariantLabel.join();
        objVariant.id_update = $('#variant-id-update').val();
        return objVariant;
    };

    //ADD VARIANT HTML
    jQuery.variantHtml = function(objVariant, variantIndex, action) {
        var html = '';
        if (action == 'create') {
            html += '<div class="single-variant" id="single-variant-'+variantIndex+'" >';
        }
        html += '<div class="single-variant-data">Variant : '+objVariant.str_variant_label+' | Qty : '+objVariant.qty+ ' | Price : '+
            objVariant.price+'</div>';
        var idUpdate = $('#variant-id-update').val();
        html += '<span  class="single-variant-update" attr-variant-update="'+idUpdate+'" attr-variant-index="'+variantIndex+'">Update</span>'+
            '<span class="single-variant-remove" attr-variant-index="'+variantIndex+'">Remove</span>'
        if (action == 'create') {
            html += '</div>';
        }
        if (action == 'create') {//create variant
            $('#variant-product').append(html);
        } else {//update variant
            $('#single-variant-'+variantIndex).empty().append(html);
        }
    };

    //UPDATE VARIANT
    jQuery.updateVariant = function(variantArray, objVariant) {
        var variantIndex = $('#button-save-variant').attr('attr-variant-index');//what variant to update
        $.variantHtml(objVariant, parseInt(variantIndex), 'update');//update variant html
        variantArray[variantIndex] = objVariant;//update variant json
        //update variant validate
        var variantValidateJson = variantValidateDiv.text();
        var variantValidateArray = JSON.parse(variantValidateJson);
        var stringFilterOptionIdUpdate = objVariant.str_filter_option_id;
        variantValidateArray[variantIndex] = stringFilterOptionIdUpdate.replace(',', '-');
        variantValidateDiv.text(JSON.stringify(variantValidateArray));
    }

    //CREATE VARIANT
    jQuery.createVariant = function(variantArray, objVariant) {
        var numVariant = $('.single-variant').length;
        variantArray.push(objVariant);//add to variant json
        $.variantHtml(objVariant, parseInt(numVariant), 'create');//create variant html
        //create variant validate
        var variantValidateJson = variantValidateDiv.text();
        variantValidateArray = [];
        if (variantValidateJson != '') {
            var variantValidateArray = JSON.parse(variantValidateJson);
        }
        var stringFilterOptionId = objVariant.str_filter_option_id;
        stringFilterOptionId = stringFilterOptionId.replace(',', '-');
        variantValidateArray.push(stringFilterOptionId);
        variantValidateDiv.text(JSON.stringify(variantValidateArray));
    };

    //SAVE VARIANT
    jQuery.saveVariant = function() {
        var variantJson = variantJsonDiv.text();
        var variantArray = [];
        if (variantJson != '') {
            variantArray = JSON.parse(variantJson);
        }
        var action = $('#button-save-variant').attr('attr-action');
        var objVariant = $.getVariantData();
        if (action == 'update') {//update variant
            $.updateVariant(variantArray, objVariant);
        } else {//create variant
            $.createVariant(variantArray, objVariant);
        }
        variantJsonDiv.text(JSON.stringify(variantArray));
        $('#modalAddVariant').modal('hide');
    };

    //REFRESH FORM ADD VARIANT
    jQuery.refreshFormVariant = function() {
        $(".filter-option-config").val('').select2();
        $('#qty_variant').val('');
        $('#price_variant').val('');
        imageVariantDiv.empty();
        imageVariantDiv.append('<span class="find-button-icon oc-icon-image"></span>');
        $('#featured_image_variant').val('');
        $('#gallery-variant').empty();
    };

    //ASSIGN DATA TO CONFIGURABLE FORM WHEN EDIT VARIANT
    jQuery.assignDataToEditVariant = function(variantData, variantIndex) {
        var galleryDiv = $('#gallery-variant');
        var strFilterOptionId = variantData.str_filter_option_id;
        var filterOptionIdArray = strFilterOptionId.split(',');
        var i = 0;
        $('.filter-option-config').each(function() {
            $(this).val(filterOptionIdArray[i]).trigger('change');
            i++;
        });
        $('#qty_variant').val(variantData.qty);
        $('#price_variant').val(variantData.price);
        if (variantData.featured_image != '') {
            imageVariantDiv.empty();
            imageVariantDiv.append('<img src="/storage/app/media'+variantData.featured_image+'" height="100">');
            $('#featured_image_variant').val(variantData.featured_image);
        }
        if (variantData.length != 0) {
            var galleryData = variantData.gallery;
            galleryDiv.val();
            var galleryHtml = '';
            if (galleryData[0] != '') {
                var galleryDataArray = galleryData[0].split(';');
                for (var y=0; y<galleryDataArray.length; y++) {
                    galleryHtml += '<li class="image-outer-variant">' +
                        '<img class="image-inner-variant" src="/storage/app/media'+galleryDataArray[y]+'">' +
                        '<img class="img-delete" src="'+baseUrl+'/plugins/ideas/shop/assets/img/x.png"> ' +
                        '<div class="gallery-variant-image">'+galleryDataArray[y]+'</div>' +
                        '</li>';
                }
            }
            galleryDiv.append(galleryHtml);
        }
        $('#button-save-variant').attr('attr-variant-index', variantIndex);
        $('#modalAddVariant').modal();
    };

    //DISPLAY MODAL EDIT
    jQuery.displayModalEdit = function(variantIndex) {
        $.refreshFormVariant();
        var variantJson = variantJsonDiv.text();
        var variantArray = JSON.parse(variantJson);
        var variantData = variantArray[variantIndex];
        $('#variant-index').val(variantIndex);
        $.assignDataToEditVariant(variantData, variantIndex);
    };

    //Validate variant filter option id
    jQuery.validateVariantFilterOptionId = function(action, variantIndex) {
        var variantValidateJson = variantValidateDiv.text();
        var variantValidateArray = [];
        if (variantValidateJson != '') {
            variantValidateArray = JSON.parse(variantValidateJson);
        }
        var filterOptionIdArray = [];
        $('.filter-option-config').each(function() {
            filterOptionIdArray.push($(this).val());
        });
        var stringFilterOptionId = filterOptionIdArray.join('-');
        //CHECK STRING IS IN ARRAY
        if (action == 'update') {
            //accept itself value when update
            variantValidateArray.splice(variantIndex, 1);//remove 1 element - itself - in variantIndex
        }
        if ($.inArray(stringFilterOptionId, variantValidateArray) != -1) {
            $.displayFlashMsg('This variant exists', 'error');
            return INVALID;//invalid
        } else {
            return VALID;//valid
        }
    };

    //REMOVE VARIANT
    jQuery.removeVariant = function(variantIndex) {
        $('#single-variant-'+variantIndex).remove();
        var i = 0;
        $('.single-variant').each(function() {//reset index of list variant
            $(this).attr('id', 'single-variant-'+i);
            $(this).find('.single-variant-update').attr('attr-variant-index', i);
            $(this).find('.single-variant-remove').attr('attr-variant-index', i);
            i++;
        });
        var variantValidateJson = variantValidateDiv.text();
        var variantJson = variantJsonDiv.text();
        var variantValidateArray = JSON.parse(variantValidateJson);
        var variantArray = JSON.parse(variantJson);
        variantValidateArray.splice(variantIndex, 1);
        variantArray.splice(variantIndex, 1);
        variantValidateDiv.text(JSON.stringify(variantValidateArray));
        variantJsonDiv.text(JSON.stringify(variantArray));
    };

    //product create and edit
    if (currentUrl.match(/products/) && currentUrl.match(/create/) ||
        currentUrl.match(/products/) && currentUrl.match(/update/)) {
        $(document).on('click', '#button-save-variant', function() {
            var filterArray = [];
            var numFilter = 0;
            $('.filter-option-config').each(function() {
                var filterValue = $(this).val();
                if (filterValue != '') {
                    filterArray.push($(this).val());
                }
                numFilter++;
            });
            if (filterArray.length == numFilter) {
                var action = $(this).attr('attr-action');
                var variantIndex = $(this).attr('attr-variant-index');
                var rs = $.validateVariantFilterOptionId(action, variantIndex);
                if (rs == VALID) {
                    $.saveVariant();
                }
            } else {
                $.displayFlashMsg('You have to choose filter', 'error');
            }
        });
        $(document).on('click', '.single-variant-update', function() {
            var variantIndex = $(this).attr('attr-variant-index');//what variant index to update
            $('#button-save-variant').attr('attr-action', 'update');
            //0 when create config and != 0 when update old variant (when update config) - with new variant still be 0
            $('#variant-id-update').val($(this).attr('attr-variant-update'));
            $.displayModalEdit(variantIndex);
        });
        $('#gallery, #gallery-variant').sortable();
        $(document).on('click', '.single-variant-remove', function() {
            var variantIndex = $(this).attr('attr-variant-index');
            if (confirm('Are you sure to delete this variant ?')) {
                $.removeVariant(variantIndex);
            }
        });
    }

    //DISPLAY MODAL TO ADD VARIANT
    $('#button-create-variant').click(function() {
        $.refreshFormVariant();
        $('#button-save-variant').attr('attr-action', 'create');
        $('#variant-id-update').val(0);
        $('#modalAddVariant').modal();
    });
});

