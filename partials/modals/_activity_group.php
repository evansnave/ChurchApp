<div id="activity_group_modal" class="modal fade">
    <div class="modal-dialog">
        <form method="post" id="activity_group_form">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><i class="fa fa-plus"></i> Add Department</h4>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label>Name of Department</label>
                        <input type="text" name="activity_group" id="activity_group" class="form-control" required />
                    </div>

                </div>
                <div class="modal-footer text-center">
                    <input type="hidden" name="group_id" id="group_id" />
                    <input type="hidden" name="btn_action" id="btn_action" />
                    <input type="submit" name="action" id="action" class="btn btn-primary" value="Add Department" />
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>