    $(document).ready(function () {

        fetch_data();

        $('#add_member').click(function () {
            $('#members_modal').modal('show');
            $('#members_form')[0].reset();
            $('#members_form')[0].reset();
            $('.modal-title').html("<i class='fa fa-plus'></i> Add Member");
            $('#action').val("Add Member");
            $('#btn_action').val("Add");
        });


        $(document).on('submit', '#members_form', function (event) {
            event.preventDefault();
            $('#action').attr('disabled', 'disabled');
            var form_data = $(this).serialize();
            $.ajax({
                url: "operations/members.php",
                method: "POST",
                data: form_data,
                success: function (data) {
                    $('#members_form')[0].reset();
                    $('#members_modal').modal('hide');
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
                url: "operations/members.php",
                method: "POST",
                data: {
                    id: id,
                    btn_action: btn_action
                },
                dataType: "json",
                success: function (data) {
                    $('#members_modal').modal('show');
                    $('#title').val(data.title);
                    $('#fullname').val(data.fullname);
                    $('#phone_number').val(data.phone_number);
                    $('#address').val(data.address);
                    $('#gender').val(data.gender);
                    $('#age').val(data.age);
                    $('#marital_status').val(data.marital_status);
                    $('#occupation').val(data.occupation);
                    $('#foundation_school').val(data.foundation_school);
                    $('#baptism').val(data.baptism);
                    $('#dob').val(data.dob);
                    $('#year_joined').val(data.year_joined);
                    $('#cell').val(data.cell);
                    $('.modal-title').html("<i class='fa fa-pencil-square-o'></i> Edit Member");
                    $('#id').val(id);
                    $('#action').val('Edit Member');
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
                                    url: 'operations/delete/member.php',
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
        $("#load").load('load/members.php');
    }