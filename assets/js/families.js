$(document).ready(function () {

    fetch_data();
    $(document).on('click', '#delete_product', function (e) {

        var cell_id = $(this).data('id');
        SwalDelete(cell_id);
        e.preventDefault();
    });


    function SwalDelete(cell_id) {
        swal({
            title: 'Are you sure?',
            text: "Family will be deleted permanently!",
            type: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Delete',
            showLoaderOnConfirm: true,

            preConfirm: function () {
                return new Promise(function (resolve) {

                    $.ajax({
                            url: 'operations/delete/families.php',
                            type: 'POST',
                            data: 'delete=' + cell_id,
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
        $('#cell_modal').modal('show');
        $('#cell_form')[0].reset();
        $('.modal-title').html("<i class='fa fa-plus'></i> Add Family");
        $('#action').val("Add Family");
        $('#btn_action').val("Add");
    });


    $(document).on('submit', '#cell_form', function (event) {
        event.preventDefault();
        $('#action').attr('disabled', 'disabled');
        var form_data = $(this).serialize();
        $.ajax({
            url: "operations/families.php",
            method: "POST",
            data: form_data,
            success: function (data) {
                $('#cell_form')[0].reset();
                $('#cell_modal').modal('hide');
                $('#alert').fadeIn().html(data);
                $('#action').attr('disabled', false);
                fetch_data();
            }
        })
    });

    $(document).on('click', '.update', function () {
        var cell_id = $(this).attr("id");
        var btn_action = 'fetch_single';
        $.ajax({
            url: "operations/families.php",
            method: "POST",
            data: {
                cell_id: cell_id,
                btn_action: btn_action
            },
            dataType: "json",
            success: function (data) {
                $('#cell_modal').modal('show');
                $('#family_head').val(data.family_head);
                $('.modal-title').html("<i class='fa fa-pencil'></i> Edit Family Details");
                $('#cell_id').val(cell_id);
                $('#action').val('Edit Details');
                $('#btn_action').val('Edit');
            }
        })
    });

});


//=====ajax live update for table=====//
function fetch_data() {
    $.ajax({
        url: "load/families.php",
        method: "POST",
        success: function (data) {
            $('#load').html(data);
        }
    });
}