<div class="col-sm-12">
    <div class="card">
        <div class="row card-header">
            <div class="col-md-6 text-left">
                <h4>Foundation School</h4>
            </div>
            <div class=" col-md-6 text-right">
                <button name="add" id="f-school" data-toggle="modal" data-target="#f_school_modal" class="btn btn-dark">
                    Submit Report
                </button>
            </div>
        </div>
        <div class="card-block table-border-style">
            <div class="table-responsive">
                <div id="load_f_school"></div>
            </div>
        </div>
    </div>
</div>

<div id="f_school_modal" class="modal fade">
    <div class="modal-dialog">
        <form method="post" id="f_school_modal_form">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><i class="fa fa-plus"></i> Foundation School Report</h4>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label>Date</label>
                        <input type="date" name="date_attended" id="date_attended" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Class</label>
                        <select name="class" id="class" class="form-control" required>
                            <option></option>
                            <option value="Class 1">Class 1</option>
                            <option value="Class 2">Class 2</option>
                            <option value="Class 3">Class 3</option>
                            <option value="Class 4">Class 4</option>
                            <option value="Class 5">Class 5</option>
                            <option value="Class 6">Class 6</option>
                            <option value="Graduated">Graduated</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Teacher</label>
                        <select name="teacher" id="teacher" class="form-control">
                            <option></option>
                            <?= listOfTeachers($db) ?>
                        </select>
                    </div>
                </div>

                <div class="modal-footer">
                    <input name="first_timer" value="<?= $token ?>" hidden>
                    <input type="hidden" name="fs_id" id="fs_id" />
                    <input type="hidden" name="btn_action101" id="btn_action101" />
                    <input type="submit" name="action2" id="action2" class="btn btn-primary" value="Submit Report" />
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                </div>

            </div>
        </form>
    </div>
</div>

<script>
    $(document).ready(function() {

        fetch_fs();

        $('#f-school').click(function() {
            $('#f_school_modal').modal('show');
            $('#f_school_modal_form')[0].reset();
            $('.modal-title').html("<i class='fa fa-plus'></i> Foundation School Report");
            $('#action2').val("Submit Report");
            $('#btn_action101').val("Add");
        });


        $(document).on('submit', '#f_school_modal_form', function(event) {
            event.preventDefault();
            $('#action2').attr('disabled', 'disabled');
            var form_data = $(this).serialize();
            var btn_action101 = 'fetch_single';
            $.ajax({
                url: "operations/foundation_school_report.php",
                method: "POST",
                data: form_data,
                success: function(data) {
                    fetch_fs();
                    $('#f_school_modal_form')[0].reset();
                    $('#f_school_modal').modal('hide');
                    $('#alert').fadeIn().html(data);
                    $('#action2').attr('disabled', false);
                }
            })
        });


        $(document).on('click', '#delete_fc', function(e) {
            var fs_id = $(this).data('id');
            SwalDelete(fs_id);
            e.preventDefault();
        });

        function SwalDelete(fs_id) {
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
                                url: 'operations/delete/foundation_school_report.php',
                                type: 'POST',
                                data: 'delete=' + fs_id,
                                dataType: 'json'
                            })
                            .done(function(response) {
                                swal('Deleted!', response.message, response.status);
                                fetch_fs();
                            })
                            .fail(function() {
                                swal('Oops...', 'Something went wrong. Try Again!', 'error');
                            });
                    });
                },
                allowOutsideClick: false
            });
        }

        $(document).on('click', '.update_fs', function() {
            var fs_id = $(this).attr("id");
            var btn_action101 = 'fetch_single';
            $.ajax({
                url: "operations/foundation_school_report.php",
                method: "POST",
                data: {
                    fs_id: fs_id,
                    btn_action101: btn_action101
                },
                dataType: "json",
                success: function(data) {
                    $('#f_school_modal').modal('show');
                    $('#date_attended').val(data.date_attended);
                    $('#class').val(data.class);
                    $('#teacher').val(data.teacher);
                    $('#visited_by').val(data.visited_by);
                    $('.modal-title').html("<i class='fa fa-pencil'></i> Edit Fondation School Report");
                    $('#fs_id').val(fs_id);
                    $('#action2').val('Edit Details');
                    $('#btn_action101').val('Edit');
                }
            })
        });
    });

    //=====ajax live update for table=====//
    function fetch_fs() {
        $.ajax({
            url: "load/foundation_school_report.php?token=<?= $token ?>",
            method: "POST",
            success: function(data) {
                $('#load_f_school').html(data);
            }
        });
    }
</script>