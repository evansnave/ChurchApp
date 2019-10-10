<?php
include_once 'operations/connection.php';
include_once 'helpers/functions.php';
?>
<div id="members_modal" class="modal fade">
    <div class="modal-dialog">
        <form method="post" id="members_form">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><i class="fa fa-plus"></i> Add Infants</h4>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" name="title" id="title" class="form-control" required />
                    </div>

                    <div class="form-group">
                        <label>Full Name</label>
                        <input type="text" name="fullname" id="fullname" class="form-control" required />
                    </div>
                    <div class="form-group">
                        <label>Guardians Name</label>
                        <input type="text" name="guardian_name" id="guardian_name" class="form-control" required />
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

                   

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Baptism</label>
                                <select name="baptism" id="baptism" class="form-control">
                                    <option></option>
                                    <option value="Baptised">Baptised</option>
                                    <option value="Not Yet">Not Yet</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Date of Birth</label>
                                <input type="date" name="dob" id="dob" class="form-control" />
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Year Join</label>
                                <input type="text" name="year_joined" id="year_joined" class="form-control" />
                            </div>
                        </div>
                    </div>

                  

        
                <div class="modal-footer text-center">
                    <input type="hidden" name="id" id="id" />
                    <input type="hidden" name="btn_action" id="btn_action" />
                    <input type="submit" name="action" id="action" class="btn btn-primary" value="Add Infant" />
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>