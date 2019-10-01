$(document).ready(function () {
    
    fetch_data();
    $(document).on('click', '#delete_product', function (e) {

        var account_id = $(this).data('id');
        SwalDelete(account_id);
        e.preventDefault();
    });

    function SwalDelete(account_id) {
        swal({
            title: 'Are you sure?',
            text: "User will be deleted permanently!",
            type: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Delete',
            showLoaderOnConfirm: true,

            preConfirm: function () {
                return new Promise(function (resolve) {

                    $.ajax({
                            url: 'operations/delete/user.php',
                            type: 'POST',
                            data: 'delete=' + account_id,
                            dataType: 'json'
                        })
                        .done(function (response) {
                            swal('Deleted!', response.message, response.status);
                            fetch_data();
                        })
                        .fail(function () {
                            swal('Oops...', 'Something went wrong. Try Again!', 'error');
                        });
                });
            },
            allowOutsideClick: false
        });
    }

    $('#add_button').click(function () {
        $('#user_form')[0].reset();
        $('.modal-title').html("<i class='fa fa-plus'></i> Add User");
        $('#action').val("Add User");
        $('#btn_action').val("Add");
    });

    $(document).on('submit', '#user_form', function (event) {
        event.preventDefault();
        $('#action').attr('disabled', 'disabled');
        var form_data = $(this).serialize();
        $.ajax({
            url: "operations/users.php",
            method: "POST",
            data: form_data,
            success: function (data) {
                $('#user_form')[0].reset();
                $('#userModal').modal('hide');
                $('#alert').fadeIn().html(data);
                $('#action').attr('disabled', false);
                fetch_data();
            }
        })
    });

    $(document).on('click', '.update', function () {
        var account_id = $(this).attr("id");
        var btn_action = 'fetch_single';
        $.ajax({
            url: "operations/users.php",
            method: "POST",
            data: {
                account_id: account_id,
                btn_action: btn_action
            },
            dataType: "json",
            success: function (data) {
                $('#userModal').modal('show');
                $('#cell').show();
                $('#username').val(data.username);
                $('#account_name').val(data.account_name);
                $('#account_role').val(data.account_role);
                $('#cell_name').val(data.cell);
                $('.modal-title').html("<i class='fa fa-pencil-square-o'></i> Edit User");
                $('#account_id').val(account_id);
                $('#action').val('Edit User');
                $('#btn_action').val('Edit');
                $('#account_password').attr('required', false);
            }
        })
    });


});

//=====ajax live update for table=====//
function fetch_data() {
    $.ajax({
        url: "load/users.php",
        method: "POST",
        success: function (data) {
            $('#load').html(data);
        }
    });
}
fetch_data();