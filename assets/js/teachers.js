$(document).ready(function () {

    fetch_data();
    $(document).on('click', '#delete_product', function (e) {

        var id = $(this).data('id');
        SwalDelete(id);
        e.preventDefault();
    });

    function SwalDelete(id) {
        swal({
            title: 'Are you sure?',
            text: "Teacher will be removed permanently!",
            type: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Delete',
            showLoaderOnConfirm: true,

            preConfirm: function () {
                return new Promise(function (resolve) {

                    $.ajax({
                            url: 'operations/delete/teachers.php',
                            type: 'POST',
                            data: 'delete=' + id,
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
        $('#teachers_form')[0].reset();
        $('.modal-title').html("<i class='fa fa-plus'></i> Add Teacher");
        $('#action').val("Add Teacher");
        $('#btn_action').val("Add");
    });

    $(document).on('submit', '#teachers_form', function (event) {
        event.preventDefault();
        $('#action').attr('disabled', 'disabled');
        var form_data = $(this).serialize();
        $.ajax({
            url: "operations/teachers.php",
            method: "POST",
            data: form_data,
            success: function (data) {
                $('#teachers_form')[0].reset();
                $('#userModal').modal('hide');
                $('#alert').fadeIn().html(data);
                $('#action').attr('disabled', false);
                fetch_data();
            }
        })
    });

    $(document).on('click', '.update', function () {
        var id = $(this).attr("id");
        var btn_action = 'fetch_single';
        $.ajax({
            url: "operations/teachers.php",
            method: "POST",
            data: {
                id: id,
                btn_action: btn_action
            },
            dataType: "json",
            success: function (data) {
                $('#userModal').modal('show');
                $('#fullname').val(data.fullname);
                $('#phone_number').val(data.phone_number);
                $('.modal-title').html("<i class='fa fa-pencil-square-o'></i> Edit Teacher");
                $('#id').val(id);
                $('#action').val('Edit Teacher');
                $('#btn_action').val('Edit');
                $('#account_password').attr('required', false);
            }
        })
    });


});

//=====ajax live update for table=====//
function fetch_data() {
    $.ajax({
        url: "load/teachers.php",
        method: "POST",
        success: function (data) {
            $('#load').html(data);
        }
    });
}
fetch_data();