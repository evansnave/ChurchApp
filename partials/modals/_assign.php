<div id="assign" class="modal fade">
    <div class="modal-dialog">
        <form method="post" id="assignSeniorCellForm">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><i class="fa fa-plus"></i>Assign Senior Cell</h4>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label>Cell</label>
                        <select name="senior_cell" id="senior_cell" class="form-control" required>
                            <option></option>
                            <?=listOfCells($db)?>
                        </select>
                    </div>
                </div>

                <div class="modal-footer">
                    <input type="hidden" name="btn_action1" id="btn_action1" value="Edit" />
                    <input type="submit" name="action" id="action" class="btn btn-primary" value="Assign Senior Cell" />
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                </div>

            </div>
        </form>
    </div>
</div>
