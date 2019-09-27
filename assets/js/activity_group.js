    $(document).ready(function () {

        fetch_data();
        $(document).on('click', '#delete_product', function (e) {

            var firstTimerId = $(this).data('id');
            SwalDelete(firstTimerId);
            e.preventDefault();
        });


        function SwalDelete(firstTimerId) {
            swal({
                title: 'Are you sure?',
                text: "Department will be deleted permanently!",
                type: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Delete',
                showLoaderOnConfirm: true,

                preConfirm: function () {
                    return new Promise(function (resolve) {

                        $.ajax({
                                url: 'operations/delete/activity_group.php',
                                type: 'POST',
                                data: 'delete=' + firstTimerId,
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
            $('#activity_group_modal').modal('show');
            $('#activity_group_form')[0].reset();
            $('.modal-title').html("<i class='fa fa-plus'></i> Add Department");
            $('#action').val("Add Department");
            $('#btn_action').val("Add");
        });


        $(document).on('submit', '#activity_group_form', function (event) {
            event.preventDefault();
            $('#action').attr('disabled', 'disabled');
            var form_data = $(this).serialize();
            $.ajax({
                url: "operations/activity_group.php",
                method: "POST",
                data: form_data,
                success: function (data) {
                    $('#activity_group_form')[0].reset();
                    $('#activity_group_modal').modal('hide');
                    $('#alert').fadeIn().html(data);
                    $('#action').attr('disabled', false);
                    fetch_data();
                }
            })
        });
        
        $(document).on('click', '.update', function () {
            var group_id = $(this).attr("id");
            var btn_action = 'fetch_single';
            $.ajax({
                url: "operations/activity_group.php",
                method: "POST",
                data: {
                    group_id: group_id,
                    btn_action: btn_action
                },
                dataType: "json",
                success: function (data) {
                    $('#activity_group_modal').modal('show');
                    $('#activity_group').val(data.name);
                    $('.modal-title').html("<i class='fa fa-pencil-square-o'></i> Edit Department");
                    $('#group_id').val(group_id);
                    $('#action').val('Edit Details');
                    $('#btn_action').val('Edit');
                }
            })
        });

    });
    

    //=====ajax live update for table=====//
    function fetch_data() {
        $.ajax({
            url: "load/activity_groups.php",
            method: "POST",
            success: function (data) {
                $('#load').html(data);
            }
        });
    }