$(document).ready(function () {

fetch_data();

$('#add_member').click(function () {
    $('#members_modal').modal('show');
    $('#members_form')[0].reset();
    $('#members_form')[0].reset();
    $('.modal-title').html("<i class='fa fa-plus'></i> Add A Child");
    $('#action').val("Add A Child");
    $('#btn_action').val("Add");
});


$(document).on('submit', '#members_form', function (event) {
    event.preventDefault();
    $('#action').attr('disabled', 'disabled');
    var form_data = $(this).serialize();
    $.ajax({
        url: "operations/child_dedication.php",
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
        url: "operations/child_dedication.php",
        method: "POST",
        data: {
            id: id,
            btn_action: btn_action
        },
        dataType: "json",
        success: function (data) {
            $('#members_modal').modal('show');
            $('#child_name').val(data.child_name);
            $('#dob').val(data.dob);
            $('#gender').val(data.gender);
            $('#age').val(data.age);
            $('#pob').val(data.pob);
            $('#fathers_name').val(data.fathers_name);
            $('#fathers_church').val(data.fathers_church);
            $('#f_department').val(data.f_department);
            $('#f_cell').val(data.f_cell);
            $('#fdba').val(data.fdba);
            $('#f_address').val(data.f_address);
            $('#f_nationality').val(data.f_nationality);
            $('#phone_number').val(data.phone_number);
            $('#mothers_name').val(data.mothers_name);
            $('#mothers_church').val(data.mothers_church);
            $('#m_department').val(data.m_department);
            $('#m_cell').val(data.m_cell);
            $('#mdba').val(data.mdba);
            $('#m_address').val(data.m_address);
            $('#m_nationality').val(data.m_nationality);
            $('#m_phone_number').val(data.m_phone_number);
            $('#marital_status').val(data.marital_status);

            $('.modal-title').html("<i class='fa fa-pencil-square-o'></i> Edit Member");
            $('#id').val(id);
            $('#action').val('Edit Child');
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
            text: "Child will be deleted permanently!",
            type: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Delete',
            showLoaderOnConfirm: true,

            preConfirm: function () {
                return new Promise(function (resolve) {

                    $.ajax({
                            url: 'operations/delete/child_dedication.php',
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
$("#load").load('load/child_dedication.php');
}