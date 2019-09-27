<div class="col-sm-12">
    <div class="card">
        <div class="row card-header">
            <div class="col-md-6 text-left">
                <h4 class=" text-primary">Services Attended</h4>
            </div>
            <div class=" col-md-6 text-right">
                <button name="add" id="add_service" data-toggle="modal" data-target="#service_modal" class="btn btn-primary">
                    Submit Report
                </button>
            </div>
        </div>
        <div class="card-block table-border-style">
            <div class="table-responsive">
                <div id="load_service"></div>
            </div>
        </div>
    </div>
</div>
<div id="service_modal" class="modal fade">
    <div class="modal-dialog">
        <form method="post" id="service_modal_form">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><i class="fa fa-plus"></i>Services Attended Report</h4>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label>Service Date </label>
                        <input type="date" name="service_day" id="service_day" required class="form-control">
                    </div>
                </div>

                <div class="modal-footer">
                    <input name="first_timer" value="<?= $token ?>" hidden>
                    <input type="hidden" name="service_id" id="service_id" />
                    <input type="hidden" name="btn_action4" id="btn_action4" />
                    <input type="submit" name="action4" id="action4" class="btn btn-info" value="Submit Report" />
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                </div>

            </div>
        </form>
    </div>
</div>

<script>
    $(document).ready(function() {

        fetch_services();

        $('#add_service').click(function() {
            $('#service_modal').modal('show');
            $('#service_modal_form')[0].reset();
            $('.modal-title').html("<i class='fa fa-plus'></i> Services Attended Report");
            $('#action4').val("Submit Report");
            $('#btn_action4').val("Add");
        });


        $(document).on('submit', '#service_modal_form', function(event) {
            event.preventDefault();
            $('#action4').attr('disabled', 'disabled');
            var form_data = $(this).serialize();
            $.ajax({
                url: "operations/services_attended.php",
                method: "POST",
                data: form_data,
                success: function(data) {
                    $('#service_modal_form')[0].reset();
                    $('#service_modal').modal('hide');
                    $('#alert').fadeIn().html(data);
                    $('#action4').attr('disabled', false);
                    fetch_services();
                }
            })
        });
        $(document).on('click', '#delete_service', function(e) {
            var service_id = $(this).data('id');
            SwalDelete(service_id);
            e.preventDefault();
        });

        function SwalDelete(service_id) {
            swal({
                title: 'Are you sure?',
                text: "This report will be deleted permanently!",
                type: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Delete',
                showLoaderOnConfirm: true,

                preConfirm: function() {
                    return new Promise(function(resolve) {

                        $.ajax({
                                url: 'operations/delete/services_attended.php',
                                type: 'POST',
                                data: 'delete=' + service_id,
                                dataType: 'json'
                            })
                            .done(function(response) {
                                swal('Deleted!', response.message, response.status);
                                fetch_services();
                            })
                            .fail(function() {
                                swal('Oops...', 'Something went wrong. Try Again!', 'error');
                            });
                    });
                },
                allowOutsideClick: false
            });
        }

        $(document).on('click', '.update_services_attended', function() {
            var service_id = $(this).attr("id");
            var btn_action4 = 'fetch_single';
            $.ajax({
                url: "operations/services_attended.php",
                method: "POST",
                data: {
                    service_id: service_id,
                    btn_action4: btn_action4
                },
                dataType: "json",
                success: function(data) {
                    $('#service_modal').modal('show');
                    $('#service_day').val(data.service_day);
                    $('.modal-title').html("<i class='fa fa-pencil'></i> Edit Service Details");
                    $('#service_id').val(service_id);
                    $('#action4').val('Edit Details');
                    $('#btn_action4').val('Edit');
                }
            })
        });
    });

    //=====ajax live update for table=====//
    function fetch_services() {
        $.ajax({
            url: "load/services_attended.php?token=<?= $token ?>",
            method: "POST",
            success: function(data) {
                $('#load_service').html(data);
            }
        });
    }
</script>