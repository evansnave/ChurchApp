$(document).ready(function () {

    fetch_data();
    $(document).on('click', '#delete_product', function (e) {

        var cell_id = $(this).data('id');
        SwalDelete(cell_id);
        e.preventDefault();
    });


    function SwalDelete(id) {
        swal({
            title: 'Are you sure?',
            text: "Offering will be deleted permanently!",
            type: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Delete',
            showLoaderOnConfirm: true,

            preConfirm: function () {
                return new Promise(function (resolve) {

                    $.ajax({
                            url: 'operations/delete/offerings.php',
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
        $('#cell_modal').modal('show');
        $('#cell_form')[0].reset();
        $('.modal-title').html("<i class='fa fa-plus'></i> Add Offertory");
        $('#action').val("Add Offering");
        $('#btn_action').val("Add");
    });


    $(document).on('submit', '#cell_form', function (event) {
        event.preventDefault();
        $('#action').attr('disabled', 'disabled');
        var form_data = $(this).serialize();
        $.ajax({
            url: "operations/offerings.php",
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
        var id = $(this).attr("id");
        var btn_action = 'fetch_single';
        $.ajax({
            url: "operations/offerings.php",
            method: "POST",
            data: {
                id: id,
                btn_action: btn_action
            },
            dataType: "json",
            success: function (data) {
                $('#cell_modal').modal('show');
                $('#accountant_name').val(data.accountant_name);
                $('#date_entered').val(data.date_entered);
                $('#offering_type').val(data.offering_type);
                $('#amount').val(data.amount);
                $('.modal-title').html("<i class='fa fa-pencil'></i> Edit Offertory Details");
                $('#id').val(id);
                $('#action').val('Edit Details');
                $('#btn_action').val('Edit');
            }
        })
    });

});


//=====ajax live update for table=====//
function fetch_data() {
    $.ajax({
        url: "load/offerings.php",
        method: "POST",
        success: function (data) {
            $('#load').html(data);
        }
    });
}