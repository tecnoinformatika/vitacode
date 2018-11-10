$(document).ready(function() {
    $('.edit-user-address').click(function() {
        var id = $(this).attr('attr-id');
        $.request('onEditUserAddress', {
            data: {id:id},
            success: function(res) {
                $('#first_name').val(res.first_name);
                $('#last_name').val(res.last_name);
                $('#address').val(res.address);
                $('#email').val(res.email);
                $('#phone').val(res.phone);
                $('#id_user_extend').val(res.id);
                $('.span-add-address').hide();
                $('.span-update-address').show();
                $('#modalAddress').modal();
            }
        });
    });

    $('.delete-user-address').click(function() {
        var msg = $('#msg_delete_user').text();
        var id = $(this).attr('attr-id');
        $.alertable.confirm(msg, id).then(function() {
            $.request('onDeleteUserAddress', {
                data: {id:id},
                success: function(res) {
                    location.reload();
                }
            });
        });
    });
});