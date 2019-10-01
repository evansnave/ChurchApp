<div class="col-sm-12">
    <div class="card">
        <div class="row card-header">
            <div class="col-md-6 text-left">
                <h4 class=" text-info">Activity Group Joined</h4>
            </div>
            <div class=" col-md-6 text-right">
                <button name="add" id="add_activity" data-toggle="modal" data-target="#activity_group_modal" class="btn btn-info">
                    Submit Report
                </button>
            </div>
        </div>
        <div class="card-block table-border-style">
            <div class="table-responsive">
                <div id="load_activity_groups"></div>
            </div>
        </div>
    </div>
</div>
<div id="activity_group_modal" class="modal fade">
    <div class="modal-dialog">
        <form method="post" id="activity_group_modal_form">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><i class="fa fa-plus"></i>Activity Group Report</h4>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label>Activity Group Joined</label>
                        <select name="group_joined" id="group_joined" class="form-control">
                            <option></option>
                            <?= listOfActivityGroups($db) ?>
                        </select>
                    </div>
                </div>

                <div class="modal-footer">
                    <input name="first_timer" value="<?= $token ?>" hidden>
                    <input type="hidden" name="group_id" id="group_id" />
                    <input type="hidden" name="btn_action3" id="btn_action3" />
                    <input type="submit" name="action3" id="action3" class="btn btn-primary" value="Submit Report" />
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                </div>

            </div>
        </form>
    </div>
</div>

<script>
    $(document).ready(function() {

        fetch_activity_groups();

        $('#add_activity').click(function() {
            $('#activity_group_modal').modal('show');
            $('#activity_group_modal_form')[0].reset();
            $('.modal-title').html("<i class='fa fa-plus'></i> Activity Group Report");
            $('#action3').val("Submit Report");
            $('#btn_action3').val("Add");
        });


        $(document).on('submit', '#activity_group_modal_form', function(event) {
            event.preventDefault();
            $('#action3').attr('disabled', 'disabled');
            var form_data = $(this).serialize();
            $.ajax({
                url: "operations/activity_group_joined.php",
                method: "POST",
                data: form_data,
                success: function(data) {
                    $('#activity_group_modal_form')[0].reset();
                    $('#activity_group_modal').modal('hide');
                    $('#alert').fadeIn().html(data);
                    $('#action3').attr('disabled', false);
                    fetch_activity_groups();
                }
            })
        });
        $(document).on('click', '#delete_group', function(e) {
            var group_id = $(this).data('id');
            SwalDelete(group_id);
            e.preventDefault();
        });

        function SwalDelete(group_id) {
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
                                url: 'operations/delete/activity_group_joined.php',
                                type: 'POST',
                                data: 'delete=' + group_id,
                                dataType: 'json'
                            })
                            .done(function(response) {
                                swal('Deleted!', response.message, response.status);
                                fetch_activity_groups();
                            })
                            .fail(function() {
                                swal('Oops...', 'Something went wrong. Try Again!', 'error');
                            });
                    });
                },
                allowOutsideClick: false
            });
        }

        $(document).on('click', '.update_activity_group', function() {
            var group_id = $(this).attr("id");
            var btn_action3 = 'fetch_single';
            $.ajax({
                url: "operations/activity_group_joined.php",
                method: "POST",
                data: {
                    group_id: group_id,
                    btn_action3: btn_action3
                },
                dataType: "json",
                success: function(data) {
                    $('#activity_group_modal').modal('show');
                    $('#group_joined').val(data.group_joined);
                    $('.modal-title').html("<i class='fa fa-pencil'></i> Edit Call Details");
                    $('#group_id').val(group_id);
                    $('#action3').val('Edit Details');
                    $('#btn_action3').val('Edit');
                }
            })
        });
    });

    //=====ajax live update for table=====//
    function fetch_activity_groups() {
        $.ajax({
            url: "load/activity_groups_joined.php?token=<?= $token ?>",
            method: "POST",
            success: function(data) {
                $('#load_activity_groups').html(data);
            }
        });
    }
    fetch_activity_groups();
</script>