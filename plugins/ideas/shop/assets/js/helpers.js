var baseUrl = window.location.origin;
function openMediaFinder(elem, fieldAssignValue) {
    new $.oc.mediaManager.popup({alias: 'ocmediamanager', onInsert: function(items) {
        if(items.length != 1) {
            alert('Choose only one file.');
            return;
        }
        var imagePath = items[0].path;
        var imageSrc = baseUrl+'/storage/app/media'+imagePath;
        var divImage = '<img src="'+imageSrc+'" />';
        $(elem).html('').append(divImage);
        console.log(imagePath);
        $('#'+fieldAssignValue).val(imagePath);
        this.hide();
    } })
}

//media finder for downloadable product
function openMediaFinderForDownloadableProduct(divId) {
    new $.oc.mediaManager.popup({alias: 'ocmediamanager', onInsert: function(items) {
        if(items.length != 1) {
            alert('Choose only one file.');
            return;
        }
        var filePath = items[0].path;
        $('#'+divId).val(filePath);
        this.hide();
    } })
}

/**
 * Product gallery
 */
$(document).ready(function() {
    jQuery.displayFlashMsg = function(msg, type) {
        $.oc.flashMsg({
            'text': msg,
            'class': type,
            'interval': 3
        })
    }

    $(document).on('click', '.img-delete', function() {//remove image
        $(this).parent().remove();
    });
    $('.pickmedia').click(function() {
        var galleryDivName = $(this).attr('attr-div-gallery');
        var galleryDiv = $('#'+galleryDivName);
        new $.oc.mediaManager.popup({alias: 'ocmediamanager', onInsert: function(items) {
            //console.log(items);
            $.each(items, function(index, value) {
                var d = new Date();
                var imageDiv = '<li class="image-outer">'+
                    '<input type="hidden" name="'+galleryDivName+'[]" value="'+value.path+'" />' +
                    '<img class="image-inner" src="'+baseUrl+'/storage/app/media'+value.path+'"/>' +
                    '<img class="img-delete" src="'+baseUrl+'/plugins/ideas/shop/assets/img/x.png'+'" /> ' +
                    '<div class="'+galleryDivName+'-image">'+value.path+'</div>' +
                    '</li>';
                galleryDiv.append(imageDiv);
            });
            this.hide();
        }});
        galleryDiv.sortable('enable');
    });
});


/*MULTIPLE SELECT CHECKBOX*/

//add .fake-checkbox
function templateSelectResult(result) {
    var html = '<div><span class="fake-checkbox" id="select2-id-'+result.id+'"></span>'+
        result.text+'</div>';
    return $(html);
}
$(document).ready(function() {
    jQuery.addMultiSelectCheckbox = function(divSelect, callback) {
        $('#'+divSelect).select2({
            closeOnSelect:false,
            templateResult: templateSelectResult
        });
        //check, uncheck fake checkbox
        $(document).on('click', '.select2-results__option', function(){
            var ariaSelected = $(this).attr('aria-selected');
            if (ariaSelected == 'true') {
                $(this).children().children().addClass('select2-checked');
            } else {
                $(this).children().children().removeClass('select2-checked');
            }
        });
        // handle event open in dynamic class 'select2-selection__rendered'
        $(document).on('click', '.select2-selection__rendered', function(){
            var selectedValue = $("#"+divSelect).val();
            if (selectedValue != null) {
                for (var i=0; i<selectedValue.length; i++) {
                    $('#select2-id-'+selectedValue[i]).addClass('select2-checked');
                }
            }
        });
        //call callback
        if (typeof callback == 'function') {
            callback.call(this);
        }
    };
});
//END MULTIPLE SELECT CHECKBOX