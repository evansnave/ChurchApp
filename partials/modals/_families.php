<?php
    include_once 'operations/connection.php';
    include_once 'helpers/functions.php';
?>
<div id="cell_modal" class="modal fade">
    <div class="modal-dialog">
        <form method="post" id="cell_form">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><i class="fa fa-plus"></i> Add a Family</h4>
                </div>
                <div class="modal-body">


                    <div class="form-group">
                        <label>Family Head</label>
                        <select name="family_head" id="family_head" class="form-control" required>
                            <option></option>
                            <?=listOfMembers($db)?>
                        </select>
                    </div>

                    

                </div>
                <div class="modal-footer text-center">
                    <input type="hidden" name="cell_id" id="cell_id" />
                    <input type="hidden" name="btn_action" id="btn_action" />
                    <input type="submit" name="action" id="action" class="btn btn-primary" value="Add Family" />
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>