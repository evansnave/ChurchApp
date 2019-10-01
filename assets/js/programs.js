$(document).ready(function () {

    fetch_data();

    $(document).on('click', '#delete_product', function (e) {

        var program_id = $(this).data('id');
        SwalDelete(program_id);
        e.preventDefault();
    });


    function SwalDelete(program_id) {
        swal({
            title: 'Are you sure?',
            text: "This Program and all related data will be deleted permanently!",
            type: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Delete',
            showLoaderOnConfirm: true,

            preConfirm: function () {
                return new Promise(function (resolve) {

                    $.ajax({
                            url: 'operations/delete/programs.php',
                            type: 'POST',
                            data: 'delete=' + program_id,
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
        $('#program_form')[0].reset();
        $('#program_modal').modal('show');
        $('.modal-title').html("<i class='fa fa-plus'></i> Create Program");
        $('#action').val("Create Program");
        $('#btn_action').val("Add");
    });

    $(document).on('submit', '#program_form', function (event) {
        event.preventDefault();
        $('#action').attr('disabled', 'disabled');
        var form_data = $(this).serialize();
        $.ajax({
            url: "operations/programs.php",
            method: "POST",
            data: form_data,
            success: function (data) {
                $('#program_form')[0].reset();
                $('#program_modal').modal('hide');
                $('#alert').fadeIn().html('<div class="alert alert-info text-center">' + data + '</div>');
                $('#action').attr('disabled', false);
                fetch_data();
            }
        })
    });

    $(document).on('click', '.update', function () {
        var program_id = $(this).attr("id");
        var btn_action = 'fetch_single';
        $.ajax({
            url: "operations/programs.php",
            method: "POST",
            data: {
                program_id: program_id,
                btn_action: btn_action
            },
            dataType: "json",
            success: function (data) {
                $('#program_modal').modal('show');
                $('#name_of_program').val(data.name_of_program);
                $('#date_of_program').val(data.date_of_program);
                $('#attendance_target').val(data.attendance_target);
                $('.modal-title').html("<i class='fa fa-pencil-square-o'></i> Edit User");
                $('#program_id').val(program_id);
                $('#action').val('Edit Details');
                $('#btn_action').val('Edit');
                $('#account_password').attr('required', false);
            }
        })
    });


});

//=====ajax live update for table=====//
function fetch_data() {
    $("#load").load('load/programs.php');
}