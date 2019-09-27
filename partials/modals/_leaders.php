<?php
    include_once 'operations/connection.php';
    include_once 'helpers/functions.php';
?>
<div id="cell_modal" class="modal fade">
    <div class="modal-dialog">
        <form method="post" id="cell_form">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><i class="fa fa-plus"></i> Add a Leader</h4>
                </div>
                <div class="modal-body">

                   

                    <div class="form-group">
                        <label>Name of Leader</label>
                        <select name="leader" id="leader" class="form-control" required>
                            <option></option>
                            <?=listOfMembers($db)?>
                        </select>
                    </div>

                <div class="form-group">
                        <label>Title</label>
                        <select name="title" id="title" class="form-control">
                            <option value=""></option>
                            <option value="Apostle">Apostle</option>
                            <option value="Reverend">Reverend</option>
                            <option value="Pastor">Pastor</option>
                            <option value="Elder">Elder</option>
                            <option value="Deacon">Deacon</option>
                            <option value="Deaconess">Deaconess</option>
                            <option value="President">President</option>
                            <option value="Secretary">Secretary</option>
                            <option value="Organizer">Organizer</option>
                           
                        </select>
                    </div>


                </div>
                <div class="modal-footer text-center">
                    <input type="hidden" name="id" id="id" />
                    <input type="hidden" name="btn_action" id="btn_action" />
                    <input type="submit" name="action" id="action" class="btn btn-primary" value="Add leader" />
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>