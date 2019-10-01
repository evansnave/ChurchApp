<div id="userModal" class="modal fade">
    <div class="modal-dialog">
        <form method="post" id="user_form">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><i class="fa fa-plus"></i> Add User</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Enter Name</label>
                        <input type="text" name="username" id="username" class="form-control" required />
                    </div>
                    <div class="form-group">
                        <label>Enter Username</label>
                        <input type="text" name="account_name" id="account_name" class="form-control" required />
                    </div>
                    <div class="form-group">
                        <label>Enter User Password</label>
                        <input type="password" name="account_password" id="account_password" class="form-control" required />
                    </div>

                    <div class="form-group">
                        <label>User Role</label>
                        <select name="account_role" id="account_role" class="form-control" required>
                            <option></option>
                            <option value="cell_leader">Cell Leader</option>
                            <option value="follow_up">Follow up Cordinator</option>
                            <option value="official">Registration Official</option>
                        </select>
                    </div>

                    <div class="form-group" id="cell">
                        <label>Cell</label>
                        <select name="cell" id="cell_name" class="form-control">
                            <option ></option>
                            <?= listOfCells($db) ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="account_id" id="account_id" />
                    <input type="hidden" name="btn_action" id="btn_action" />
                    <input type="submit" name="action" id="action" class="btn btn-info" value="Add User" />
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </form>

    </div>
</div>

