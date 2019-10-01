<div class="col-sm-12">
    <div class="card">
        <div class="row card-header">
            <div class="col-md-6 text-left">
                <h4 class=" text-danger">Calls Made</h4>
            </div>
            <div class=" col-md-6 text-right">
                <button name="add" id="add_button" data-toggle="modal" data-target="#calls_modal" class="btn btn-danger">
                    Submit Report
                </button>
            </div>
        </div>
        <div class="card-block table-border-style">
            <div class="table-responsive">
                <div id="load_calls"></div>
            </div>
        </div>
    </div>
</div>

<div id="calls_modal" class="modal fade">
    <div class="modal-dialog">
        <form method="post" id="calls_modal_form">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><i class="fa fa-plus"></i> Follow up Calls Report</h4>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label>Type Of Call</label>
                        <select name="call_option" id="call_option" class="form-control" required>
                            <option></option>
                            <option value="Feedback Call">Service Feedback Call</option>
                            <option value="Check Up Call">Check Up Call</option>
                            <option value="Service Reminder">Service Reminder Call</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Response</label>
                        <select name="response" id="response" class="form-control" required>
                            <option></option>
                            <option value="Excellent">Excellent</option>
                            <option value="Good">Good</option>
                            <option value="Needs Improvement">Needs Improvement</option>
                            <option value="No Answer">No Answer</option>
                            <option value="Switched Off">Switched Off</option>
                            <option value="Cannot be reached">Cannot be reached</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Comments</label>
                        <input type="text" name="comment" id="comment" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Called By</label>
                        <input type="text" name="called_by" id="called_by" class="form-control" required>
                    </div>
                </div>

                <div class="modal-footer">
                    <input name="first_timer" value="<?= $token ?>" hidden>
                    <input type="hidden" name="call_id" id="call_id" />
                    <input type="hidden" name="btn_action" id="btn_action" />
                    <input type="submit" name="action" id="action" class="btn btn-primary" value="Submit Report" />
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                </div>

            </div>
        </form>
    </div>
</div>

<script>
    $(document).ready(function() {

        fetch_data();

        $('#add_button').click(function() {
            $('#calls_modal').modal('show');
            $('#calls_modal_form')[0].reset();
            $('.modal-title').html("<i class='fa fa-plus'></i> Follow up Calls Report");
            $('#action').val("Submit Report");
            $('#btn_action').val("Add");
        });

        $(document).on('click', '#delete_product', function(e) {
            var calls_id = $(this).data('id');
            SwalDelete(calls_id);
            e.preventDefault();
        });

        function SwalDelete(calls_id) {
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
                                url: 'operations/delete/calls.php',
                                type: 'POST',
                                data: 'delete=' + calls_id,
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

        $(document).on('submit', '#calls_modal_form', function(event) {
            event.preventDefault();
            $('#action').attr('disabled', 'disabled');
            var form_data = $(this).serialize();
            $.ajax({
                url: "operations/calls.php",
                method: "POST",
                data: form_data,
                success: function(data) {
                    $('#calls_modal_form')[0].reset();
                    $('#calls_modal').modal('hide');
                    $('#alert').fadeIn().html(data);
                    $('#action').attr('disabled', false);
                    fetch_data();
                }
            })
        });

        $(document).on('click', '.update', function() {
            var call_id = $(this).attr("id");
            var btn_action = 'fetch_single';
            $.ajax({
                url: "operations/calls.php",
                method: "POST",
                data: {
                    call_id: call_id,
                    btn_action: btn_action
                },
                dataType: "json",
                success: function(data) {
                    $('#calls_modal').modal('show');
                    $('#call_option').val(data.call_option);
                    $('#response').val(data.response);
                    $('#comment').val(data.comment);
                    $('#called_by').val(data.called_by);
                    $('.modal-title').html("<i class='fa fa-pencil'></i> Edit Call Details");
                    $('#call_id').val(call_id);
                    // $('#alert').fadeIn().html(data)
                    $('#action').val('Edit Details');
                    $('#btn_action').val('Edit');
                }
            })
        });
    });

    //=====ajax live update for table=====//
    function fetch_data() {
        $.ajax({
            url: "load/calls.php?token=<?= $token ?>",
            method: "POST",
            success: function(data) {
                $('#load_calls').html(data);
            }
        });
    }
</script>