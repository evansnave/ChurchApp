<?php
    include_once 'operations/connection.php';
    include_once 'helpers/functions.php';
?>
<div id="cell_modal" class="modal fade">
    <div class="modal-dialog">
        <form method="post" id="cell_form">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><i class="fa fa-plus"></i> Add a Cell</h4>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label>Name of Cell</label>
                        <input type="text" name="name_of_cell" id="name_of_cell" class="form-control" required />
                    </div>

                    <div class="form-group">
                        <label>Name of Leader</label>
                        <select name="cell_leader" id="cell_leader" class="form-control" required>
                            <option></option>
                            <?=listOfMembers($db)?>
                        </select>
                    </div>

                    <!-- <div class="form-group"> -->
                        <!-- <label>Cell Venue</label> -->
                        <input type="text" hidden name="cell_venue" id="cell_venue" class="form-control" value=" " />
                    <!-- </div> -->

                    <!-- <div class="form-group"> -->
                        <!-- <label>Email</label> -->
                        <input type="email" name="email_address" id="email_address" class="form-control" hidden />
                    <!-- </div> -->

                </div>
                <div class="modal-footer text-center">
                    <input type="hidden" name="cell_id" id="cell_id" />
                    <input type="hidden" name="btn_action" id="btn_action" />
                    <input type="submit" name="action" id="action" class="btn btn-primary" value="Add Cell" />
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>