<div id="activity_group_modal" class="modal fade">
    <div class="modal-dialog">
        <form method="post" id="ministries_form">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><i class="fa fa-plus"></i> Add Ministry</h4>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label>Name of Ministry</label>
                        <input type="text" name="name_of_ministry" id="name_of_ministry" class="form-control" required />
                    </div>
                    <div class="form-group">
                        <label>Ministry Leader</label>
                        <select name="ministry_leader" id="ministry_leader" class="form-control" required>
                            <option value=""></option>
                            <?=listOfMembers($db)?>
                        </select>
                    </div>

                </div>
                <div class="modal-footer text-center">
                    <input type="hidden" name="id" id="id" />
                    <input type="hidden" name="btn_action" id="btn_action" />
                    <input type="submit" name="action" id="action" class="btn btn-primary" value="Add Ministry" />
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>