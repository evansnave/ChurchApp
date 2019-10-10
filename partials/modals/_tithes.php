<?php
    include_once 'operations/connection.php';
    include_once 'helpers/functions.php';
?>
<div id="cell_modal" class="modal fade">
    <div class="modal-dialog">
        <form method="post" id="cell_form">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><i class="fa fa-plus"></i> Add Tithe</h4>
                </div>
                <div class="modal-body">

                <div class="form-group">
                        <label>Date</label>
                        <input type="date"  name="date_entered" id="date_entered" class="form-control" required value=" " />
                     </div>

                    <div class="form-group">
                        <label>Name of Accountant</label>
                        <input type="text" name="accountant_name" id="accountant_name" class="form-control" required />
                    </div>

                   

                     <div class="form-group">
                        <label>Name of Tither</label>
                        <select name="member_id" id="member_id" class="form-control" required>
                            <option></option>
                            <?=listOfMembers($db)?>
                        </select>
                    </div>

                
                     <div class="form-group">
                        <label>Amount</label>
                        <input type="text" name="amount" id="amount" class="form-control" required />
                    </div>

                </div>
                <div class="modal-footer text-center">
                    <input type="hidden" name="id" id="id" />
                    <input type="hidden" name="btn_action" id="btn_action" />
                    <input type="submit" name="action" id="action" class="btn btn-primary" value="Add Tithe" />
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>