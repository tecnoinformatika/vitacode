function addOrUpdateQueryParam(search, param, newval) {
    var questionIndex = search.indexOf('?');
    if (questionIndex < 0) {
        search = search + '?';
        search = search + param + '=' + newval;
        return search;
    }
    var regex = new RegExp("([?;&])" + param + "[^&;]*[;&]?");
    var query = search.replace(regex, "$1").replace(/&$/, '');
    var indexOfEquals = query.indexOf('=');
    return (indexOfEquals >= 0 ? query + '&' : query + '') + (newval ? param + '=' + newval : '');
}


$(document).ready(function() {

    var currentUrl = window.location.href;

    /**
     * CATEGORY
     */
    //sort by
    $('#product-sort-by').change(function() {
        var sortBy = $(this).val();
        window.location.href = addOrUpdateQueryParam(currentUrl, 'sort-by', sortBy);
    });
    //pagination
    $('.cat-pag').click(function() {
        var page = $(this).attr('attr-page');
        window.location.href = addOrUpdateQueryParam(currentUrl, 'page', page);
    });

    /**
     * END CATEGORY
     */

});