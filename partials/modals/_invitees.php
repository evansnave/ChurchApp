<?php
include_once 'operations/connection.php';
include_once 'helpers/functions.php';
?>
<div id="invitee_modal" class="modal fade">
    <div class="modal-dialog">
        <form method="post" id="invitee_form">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><i class="fa fa-plus"></i> Add Invitee</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Name Of Invitee</label>
                        <input type="text" name="name_of_invitee" id="name_of_invitee" class="form-control" required />
                    </div>
                    <div class="form-group">
                        <label>Phone Number</label>
                        <input type="number" name="phone_number" id="phone_number" class="form-control" required />
                    </div>
                    <div class="form-group">
                        <label>Place Of Residence</label>
                        <input type="text" name="residence" id="residence" class="form-control" required />
                    </div>
                    <?php if ($_SESSION['role'] != 'cell_leader') { ?>
                        <div class="form-group">
                            <label>Cell</label>
                            <select name="cell" id="cell" class="form-control">
                                <option></option>
                                <?= listOfCells($db) ?>
                            </select>
                        </div>
                    <?php } ?>

                    <?php if ($_SESSION['role'] == 'cell_leader') { ?>
                        <div class="form-group">
                            <label>Cell</label>
                            <input name="cell" id="cell" hidden value="<?= $_SESSION['cell_id'] ?>" >
                            <input value="<?= nameOfCell($db, $_SESSION['cell_id']) ?>" readonly class="form-control">
                        </div>
                    <?php } ?>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id" id="id" />
                    <input type="hidden" name="btn_action" id="btn_action" />
                    <input type="submit" name="action" id="action" class="btn btn-info" value="Add Invitee" />
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>