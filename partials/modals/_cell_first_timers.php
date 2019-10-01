<?php
include_once 'operations/connection.php';
include_once 'helpers/functions.php';
?>
<div id="first_timer_modal" class="modal fade">
    <div class="modal-dialog">
        <form method="post" id="first_timer_form">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><i class="fa fa-plus"></i> Add First Timer</h4>
                </div>
                <div class="modal-body">

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
                            <input name="cell" id="cell" hidden value="<?= $_SESSION['cell_id']?>">
                            <input value="<?= nameOfCell($db, $_SESSION['cell_id']) ?>" readonly class="form-control">
                        </div>
                    <?php } ?>

                    <div class="form-group">
                        <label>Full Name</label>
                        <input type="text" name="fullname" id="fullname" class="form-control" required />
                    </div>

                    <div class="form-group">
                        <label>Phone Number</label>
                        <input type="number" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="10" name="phone_number" id="phone_number" class="form-control" required />
                    </div>

                    <div class="form-group">
                        <label>Address</label>
                        <input type="text" name="address" id="address" class="form-control" required />
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Gender</label>
                                <select name="gender" id="gender" class="form-control">
                                    <option></option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Age</label>
                                <input type="number" name="age" id="age" class="form-control" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="2" required pattern="[+-]?([0-9]*[.])?[0-9]+" />
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Marital Status</label>
                                <select name="marital_status" id="marital_status" class="form-control" required>
                                    <option></option>
                                    <option value="married">Married</option>
                                    <option value="single">Single</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Occupation</label>
                                <input type="text" name="occupation" id="occupation" class="form-control" required />
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Invited By</label>
                                <input type="text" name="invited_by" id="invited_by" class="form-control" required />
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Inviters Contact</label>
                                <input type="number" name="inviters_contact" id="inviters_contact" class="form-control" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="10" />
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Are you Born Again</label>
                                <select name="born_again" id="born_again" class="form-control" required>
                                    <option></option>
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>When?</label>
                                <input type="text" name="when_born_again" id="when_born_again" class="form-control" />
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Membership</label>
                                <select name="membership" id="membership" class="form-control">
                                    <option></option>
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>If no why?</label>
                                <input type="text" name="if_no_why" id="if_no_why" class="form-control" />
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Visitation</label>
                                <select name="visitation" id="visitation" class="form-control">
                                    <option></option>
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>If yes when?</label>
                                <input type="text" name="if_yes_when" id="if_yes_when" class="form-control" />
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Prayer Request</label>
                        <textarea name="prayer_request" id="prayer_request" cols="10" rows="5" class="form-control"></textarea>
                    </div>

                </div>
                <div class="modal-footer text-center">
                    <input type="hidden" name="btn_action" id="btn_action" />
                    <input type="submit" name="action" id="action" class="btn btn-primary" value="Add First Timer" />
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>