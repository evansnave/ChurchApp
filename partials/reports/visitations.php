<div class="col-sm-12">
    <div class="card">
        <div class="row card-header">
            <div class="col-md-6 text-left">
                <h4 class=" text-warning">Visitations</h4>
            </div>
            <div class=" col-md-6 text-right">
                <button name="add" id="add_button2" data-toggle="modal" data-target="#visitation_modal" class="btn btn-warning">
                    Submit Report
                </button>
            </div>
        </div>
        <div class="card-block table-border-style">
            <div class="table-responsive">
                <div id="load_visitation"></div>
            </div>
        </div>
    </div>
</div>

<div id="visitation_modal" class="modal fade">
    <div class="modal-dialog">
        <form method="post" id="visitation_modal_form">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><i class="fa fa-plus"></i> Visitation Report</h4>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label>Day Of Visitation</label>
                        <input type="date" name="date_of_visitation" id="date_of_visitation" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Duration</label>
                        <select name="duration" id="duration" class="form-control" required>
                            <option></option>
                            <option value="15 Minutes">15 Minutes</option>
                            <option value="30 Minutes">30 Minutes</option>
                            <option value="1 Minutes">1 Hour</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Feedback</label>
                        <textarea name="feedback" id="feedback" cols="5" rows="5" class="form-control"></textarea>
                    </div>

                    <div class="form-group">
                        <label>Visited By</label>
                        <input type="text" name="visited_by" id="visited_by" class="form-control" required>
                    </div>
                </div>

                <div class="modal-footer">
                    <input name="first_timer" value="<?= $token ?>" hidden>
                    <input type="hidden" name="visitation_id" id="visitation_id" />
                    <input type="hidden" name="btn_action2" id="btn_action2" />
                    <input type="submit" name="action2" id="action2" class="btn btn-primary" value="Submit Report" />
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                </div>

            </div>
        </form>
    </div>
</div>

<script>
    $(document).ready(function() {

        fetch_visitation();

        $('#add_button2').click(function() {
            $('#visitation_modal').modal('show');
            $('#visitation_modal_form')[0].reset();
            $('.modal-title').html("<i class='fa fa-plus'></i> Visitation Report");
            $('#action2').val("Submit Report");
            $('#btn_action2').val("Add");
        });


        $(document).on('submit', '#visitation_modal_form', function(event) {
            event.preventDefault();
            $('#action2').attr('disabled', 'disabled');
            var form_data = $(this).serialize();
            var btn_action2 = 'fetch_single';
            $.ajax({
                url: "operations/visitations.php",
                method: "POST",
                data: form_data,
                success: function(data) {
                    fetch_visitation();
                    $('#visitation_modal_form')[0].reset();
                    $('#visitation_modal').modal('hide');
                    $('#alert').fadeIn().html(data);
                    $('#action2').attr('disabled', false);
                }
            })
        });


        $(document).on('click', '#delete_visitation', function(e) {
            var visitation_id = $(this).data('id');
            SwalDelete(visitation_id);
            e.preventDefault();
        });

        function SwalDelete(visitation_id) {
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
                                url: 'operations/delete/visitations.php',
                                type: 'POST',
                                data: 'delete=' + visitation_id,
                                dataType: 'json'
                            })
                            .done(function(response) {
                                swal('Deleted!', response.message, response.status);
                                fetch_visitation();
                            })
                            .fail(function() {
                                swal('Oops...', 'Something went wrong. Try Again!', 'error');
                            });
                    });
                },
                allowOutsideClick: false
            });
        }

        $(document).on('click', '.update_visitation', function() {
            var visitation_id = $(this).attr("id");
            var btn_action2 = 'fetch_single';
            $.ajax({
                url: "operations/visitations.php",
                method: "POST",
                data: {
                    visitation_id: visitation_id,
                    btn_action2: btn_action2
                },
                dataType: "json",
                success: function(data) {
                    $('#visitation_modal').modal('show');
                    $('#date_of_visitation').val(data.date_of_visitation);
                    $('#duration').val(data.duration);
                    $('#feedback').val(data.feedback);
                    $('#visited_by').val(data.visited_by);
                    $('.modal-title').html("<i class='fa fa-pencil'></i> Edit Call Details");
                    $('#visitation_id').val(visitation_id);
                    $('#action2').val('Edit Details');
                    $('#btn_action2').val('Edit');
                }
            })
        });
    });

    //=====ajax live update for table=====//
    function fetch_visitation() {
        $.ajax({
            url: "load/visitations.php?token=<?= $token ?>",
            method: "POST",
            success: function(data) {
                $('#load_visitation').html(data);
            }
        });
    }
</script>