<div class="col-sm-12">
    <div class="card">
        <div class="row card-header">
            <div class="col-md-6 text-left">
                <h4 class=" text-success">Ministry Materials</h4>
            </div>
            <div class=" col-md-6 text-right">
                <button name="add" id="add_button5" data-toggle="modal" data-target="#ministry_materials_modal" class="btn btn-success">
                    Submit Report
                </button>
            </div>
        </div>
        <div class="card-block table-border-style">
            <div class="table-responsive">
                <div id="load_materials"></div>
            </div>
        </div>
    </div>
</div>

<div id="ministry_materials_modal" class="modal fade">
    <div class="modal-dialog">
        <form method="post" id="ministry_materials_modal_form">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><i class="fa fa-plus"></i> Ministry Material Report</h4>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" name="title" id="title" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Format</label>
                        <select name="format" id="format" class="form-control" required>
                            <option></option>
                            <option value="VCD">VCD</option>
                            <option value="DVD">DVD</option>
                            <option value="Audio">Audio</option>
                            <option value="Book">Book</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Feedback</label>
                        <textarea name="feedback" id="feedback1" cols="5" rows="5" class="form-control" required></textarea>
                    </div>

                    <div class="form-group">
                        <label>Date Received</label>
                        <input type="date" name="date_received" id="date_received" class="form-control" required>
                    </div>
                </div>

                <div class="modal-footer">
                    <input name="first_timer" value="<?= $token ?>" hidden>
                    <input type="hidden" name="material_id" id="material_id" />
                    <input type="hidden" name="btn_action5" id="btn_action5" />
                    <input type="submit" name="action5" id="action5" class="btn btn-primary" value="Submit Report" />
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                </div>

            </div>
        </form>
    </div>
</div>

<script>
    $(document).ready(function() {

        fetch_materials();

        $('#add_button5').click(function() {
            $('#ministry_materials_modal').modal('show');
            $('#ministry_materials_modal_form')[0].reset();
            $('.modal-title').html("<i class='fa fa-plus'></i> Ministry Materials Report");
            $('#action5').val("Submit Report");
            $('#btn_action5').val("Add");
        });


        $(document).on('submit', '#ministry_materials_modal_form', function(event) {
            event.preventDefault();
            $('#action5').attr('disabled', 'disabled');
            var form_data = $(this).serialize();
            var btn_action5 = 'fetch_single';
            $.ajax({
                url: "operations/ministry_materials.php",
                method: "POST",
                data: form_data,
                success: function(data) {
                    fetch_materials();
                    $('#ministry_materials_modal_form')[0].reset();
                    $('#ministry_materials_modal').modal('hide');
                    $('#alert').fadeIn().html(data);
                    $('#action5').attr('disabled', false);
                }
            })
        });


        $(document).on('click', '#delete_material', function(e) {
            var material_id = $(this).data('id');
            SwalDelete(material_id);
            e.preventDefault();
        });

        function SwalDelete(material_id) {
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
                                url: 'operations/delete/ministry_materials.php',
                                type: 'POST',
                                data: 'delete=' + material_id,
                                dataType: 'json'
                            })
                            .done(function(response) {
                                swal('Deleted!', response.message, response.status);
                                fetch_materials();
                            })
                            .fail(function() {
                                swal('Oops...', 'Something went wrong. Try Again!', 'error');
                            });
                    });
                },
                allowOutsideClick: false
            });
        }

        $(document).on('click', '.update_material', function() {
            var material_id = $(this).attr("id");
            var btn_action5 = 'fetch_single';
            $.ajax({
                url: "operations/ministry_materials.php",
                method: "POST",
                data: {
                    material_id: material_id,
                    btn_action5: btn_action5
                },
                dataType: "json",
                success: function(data) {
                    $('#ministry_materials_modal').modal('show');
                    $('#title').val(data.title);
                    $('#format').val(data.format);
                    $('#feedback1').val(data.feedback1);
                    $('#date_received').val(data.date_received);
                    $('.modal-title').html("<i class='fa fa-pencil'></i> Edit Call Details");
                    $('#material_id').val(material_id);
                    $('#action5').val('Edit Details');
                    $('#btn_action5').val('Edit');
                }
            })
        });
    });

    //=====ajax live update for table=====//
    function fetch_materials() {
        $.ajax({
            url: "load/ministry_materials.php?token=<?= $token ?>",
            method: "POST",
            success: function(data) {
                $('#load_materials').html(data);
            }
        });
    }
</script>