<div id="program_modal" class="modal fade">
    <div class="modal-dialog">
        <form method="post" id="program_form">
            <div class="modal-content">
                <div class="modal-header"> 
                    <h4 class="modal-title"><i class="fa fa-plus"></i> Create Program</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Name Of Program</label>
                        <input type="text" name="name_of_program" id="name_of_program" class="form-control" required />
                    </div>
                    <div class="form-group">
                        <label>Date of Program</label>
                        <input type="date" name="date_of_program" id="date_of_program" class="form-control" required />
                    </div>
                    <div class="form-group">
                        <label>Attendance Target</label>
                        <input type="number" name="attendance_target" id="attendance_target" class="form-control" required />
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="program_id" id="program_id" />
                    <input type="hidden" name="btn_action" id="btn_action" />
                    <input type="submit" name="action" id="action" class="btn btn-info" value="Create Program" />
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>