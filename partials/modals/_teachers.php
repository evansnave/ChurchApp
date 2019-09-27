<div id="userModal" class="modal fade">
    <div class="modal-dialog">
        <form method="post" id="teachers_form">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><i class="fa fa-plus"></i> Add a Teacher</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Name of Teacher</label>
                        <input type="text" name="fullname" id="fullname" class="form-control" required />
                    </div>
                    <div class="form-group">
                        <label>Phone Number</label>
                        <input type="text" name="phone_number" id="phone_number" class="form-control" required />
                    </div>

                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id" id="id" />
                    <input type="hidden" name="btn_action" id="btn_action" />
                    <input type="submit" name="action" id="action" class="btn btn-info" value="Add Teacher" />
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </form>

    </div>
</div>