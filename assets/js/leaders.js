$(document).ready(function () {

    fetch_data();

    $('#add_leader').click(function () {
        $('#cell_modal').modal('show');
        $('#cell_form')[0].reset();
        $('#cell_form')[0].reset();
        $('.modal-title').html("<i class='fa fa-plus'></i> Add Leader");
        $('#action').val("Add Leader");
        $('#btn_action').val("Add");
    });


    $(document).on('submit', '#cell_form', function (event) {
        event.preventDefault();
        $('#action').attr('disabled', 'disabled');
        var form_data = $(this).serialize();
        $.ajax({
            url: "operations/leaders.php",
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
            url: "operations/leaders.php",
            method: "POST",
            data: {
                id: id,
                btn_action: btn_action
            },
            dataType: "json",
            success: function (data) {
                $('#cell_modal').modal('show');
                $('#leader').val(data.leader);
                $('#title').val(data.title);
                $('.modal-title').html("<i class='fa fa-pencil-square-o'></i> Edit Leader");
                $('#id').val(id);
                $('#action').val('Edit Leader');
                $('#btn_action').val('Edit');
                fetch_data();
            }
        })
    });

        $(document).on('click', '#delete_product', function (e) {

            var member_id = $(this).data('id');
            SwalDelete(member_id);
            e.preventDefault();
        });


        function SwalDelete(member_id) {
            swal({
                title: 'Are you sure?',
                text: "Member will be deleted permanently!",
                type: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Delete',
                showLoaderOnConfirm: true,

                preConfirm: function () {
                    return new Promise(function (resolve) {

                        $.ajax({
                                url: 'operations/delete/leaders.php',
                                type: 'POST',
                                data: 'delete=' + member_id,
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

});

//=====ajax live update for table=====//
function fetch_data() {
    $("#load").load('load/leaders.php');
}