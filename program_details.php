<?php
include_once "partials/header.php";
include_once 'operations/connection.php';
include_once 'helpers/functions.php';
include_once 'helpers/cell_leader_access.php';
$date = $_GET['date'];
$program_date = date('Y-m-d', $date);
?>
<div class="pcoded-main-container">
    <div class="pcoded-wrapper">
        <div class="pcoded-content">
            <div class="pcoded-inner-content">
                <div class="main-body">
                    <div class="page-wrapper">
                        <div id="alert"></div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card">
                                    <div class="row card-header">
                                        <div class="col-md-6 text-left">
                                            <h4 class="text-muted"><?= nameOfProgram($db, $program_date) ?> (<i class="feather icon-calendar"></i> <?=date('l, M j, Y',$date)?>)</h4>
                                        </div>
                                        <div class=" col-md-6 text-right">
                                            <button name="add" id="add_button" data-toggle="modal" data-target="invitee_modal" class="btn btn-dark">
                                                Add Invitee
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-block table-border-style">
                                        <div class="table-responsive">
                                            <div id="load"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php include 'partials/modals/_invitees.php' ?>
            </div>
        </div>
    </div>
</div>
<?php include_once "partials/_footer.php"; ?>
<script>
    $(document).ready(function() {

        fetch_data();

        $(document).on('click', '#delete_product', function(e) {

            var id = $(this).data('id');
            SwalDelete(id);
            e.preventDefault();
        });


        function SwalDelete(id) {
            swal({
                title: 'Are you sure?',
                text: "Invitee will be deleted permanently!",
                type: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Delete',
                showLoaderOnConfirm: true,

                preConfirm: function() {
                    return new Promise(function(resolve) {

                        $.ajax({
                                url: 'operations/delete/invitees.php?date=<?=$date?>',
                                type: 'POST',
                                data: 'delete=' + id,
                                dataType: 'json'
                            })
                            .done(function(response) {
                                swal('Deleted!', response.message, response.status);
                                fetch_data();
                            })
                            .fail(function() {
                                swal('Oops...', 'Something went wrong. Try Again!', 'error');
                            });
                    });
                },
                allowOutsideClick: false
            });
        }

        $('#add_button').click(function() {
            $('#invitee_form')[0].reset();
            $('#invitee_modal').modal('show');
            $('.modal-title').html("<i class='fa fa-plus'></i> Add Invitee");
            $('#action').val("Add Invitee");
            $('#btn_action').val("Add");
        });

        $(document).on('submit', '#invitee_form', function(event) {
            event.preventDefault();
            $('#action').attr('disabled', 'disabled');
            var form_data = $(this).serialize();
            $.ajax({
                url: "operations/invitees.php?date=<?= $date ?>",
                method: "POST",
                data: form_data,
                success: function(data) {
                    $('#invitee_form')[0].reset();
                    $('#invitee_modal').modal('hide');
                    $('#alert').fadeIn().html(data);
                    $('#action').attr('disabled', false);
                    fetch_data();
                }
            })
        });

        $(document).on('click', '.update', function() {
            var id = $(this).attr("id");
            var btn_action = 'fetch_single';
            $.ajax({
                url: "operations/invitees.php?date=<?= $date ?>",
                method: "POST",
                data: {
                    id: id,
                    btn_action: btn_action
                },
                dataType: "json",
                success: function(data) {
                    $('#invitee_modal').modal('show');
                    $('#name_of_invitee').val(data.name_of_invitee);
                    $('#residence').val(data.residence);
                    $('#cell').val(data.cell);
                    $('#phone_number').val(data.phone_number);
                    $('.modal-title').html("<i class='fa fa-pencil-square-o'></i> Edit Details");
                    $('#id').val(id);
                    $('#action').val('Edit Details');
                    $('#btn_action').val('Edit');
                    $('#account_password').attr('required', false);
                }
            })
        });


    });

    //=====ajax live update for table=====//
    function fetch_data() {
        $.ajax({
            url: "load/invitees.php?date=<?= $date ?>",
            method: "POST",
            success: function(data) {
                $('#load').html(data);
            }
        });
    }
    fetch_data();;
</script>