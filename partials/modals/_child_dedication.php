<?php
include_once 'operations/connection.php';
include_once 'helpers/functions.php';
?>
<div id="members_modal" class="modal fade">
    <div class="modal-dialog">
        <form method="post" id="members_form">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><i class="fa fa-plus"></i> Add Child</h4>
                </div>

                <form id="members_form" class="table table-bordered table-striped">
                <div class="modal-body">

                    <div class="form-group">
                        <label>Name Of Child</label>
                        <input type="text" name="child_name" id="child_name" class="form-control" required />
                    </div>

                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label>Date of Birth</label>
                                <input type="date" name="dob" id="dob" class="form-control" />
                            </div>
                        </div>

                    
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Gender</label>
                                <select name="gender" id="gender" class="form-control">
                                    <option></option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                            </div>
                        </div>    

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Age</label>
                                <input type="number" name="age" id="age" class="form-control" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="2" required pattern="[+-]?([0-9]*[.])?[0-9]+" />
                            </div>
                        </div>
                     </div>

                    <div class="form-group">
                        <label>Place of Birth</label>
                        <input type="text" name="pob" id="pob" class="form-control" required />
                    </div>

                    <div class="form-group">
                        <label>Father's Name</label>
                        <input type="text" name="fathers_name" id="fathers_name" class="form-control" required />
                    </div>

                    <div class="form-group">
                        <label>Church</label>
                        <input type="text" name="fathers_church" id="fathers_church" class="form-control" required />
                    </div>

                <div class="row">    
                    <div class="col-md-6">
                    <div class="form-group">
                        <label>Department</label>
                        <select name="f_department" id="f_department" class="form-control">
                            <option></option>
                            <?= listOfDepartments($db) ?>
                        </select>
                    </div>
                    </div>

                    <div class="col-md-6">
                    <div class="form-group">
                        <label>Family</label>
                        <select name="f_cell" id="f_cell" class="form-control">
                            <option></option>
                            <?= listOfCells($db) ?>
                        </select>
                    </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">  
                        <div class="form-group">
                            <label>Date Born Again</label>
                            <input type="date" name="fdba" id="fdba" class="form-control" />
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Phone Number</label>
                            <input type="number" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="10" name="phone_number" id="phone_number" class="form-control" required />
                        </div>
                    </div>
                </div>

                    <div class="form-group">
                        <label>Father's Address</label>
                        <input type="text" name="f_address" id="f_address" class="form-control" required />
                    </div>

                    <div class="form-group">
                        <label>Father's Nationality</label>
                        <input type="text" name="f_nationality" id="f_nationality" class="form-control" required />
                    </div>

                    <div class="form-group">
                        <label>Mother's Name</label>
                        <input type="text" name="mothers_name" id="mothers_name" class="form-control" required />
                    </div>

                    <div class="form-group">
                        <label>Church</label>
                        <input type="text" name="mothers_church" id="mothers_church" class="form-control" required />
                    </div>

                <div class="row">    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Department</label>
                            <select name="m_department" id="m_department" class="form-control">
                                <option></option>
                                <?= listOfDepartments($db) ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Family</label>
                            <select name="m_cell" id="m_cell" class="form-control">
                                <option></option>
                                <?= listOfCells($db) ?>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Mother's Nationality</label>
                            <input type="text" name="m_nationality" id="m_nationality" class="form-control" required />
                        </div>
                    </div>      
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Date Born Again</label>
                            <input type="date" name="mdba" id="mdba" class="form-control" />
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label>Mother's Address</label>
                    <input type="text" name="m_address" id="m_address" class="form-control" required />
                </div>


                <div class="row">
                    <div class="col-md-6">   
                    <div class="form-group">
                        <label>Phone Number</label>
                        <input type="number" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="10" name="m_phone_number" id="m_phone_number" class="form-control" required />
                    </div>
                </div>  
            

                        <div class="col-md-6">    
                            <div class="form-group">
                                <label>Marital Status</label>
                                <select name="marital_status" id="marital_status" class="form-control" required>
                                    <option></option>
                                    <option value="married">Married</option>
                                    <option value="single">Single</option>
                                    <option value="single">Divorced</option>
                                    <option value="single">Single Parent</option>
                                </select>
                            </div>
                        </div>               
                    </div>
                </div>
                <div class="modal-footer text-center">
                    <input type="hidden" name="id" id="id" />
                    <input type="hidden" name="btn_action" id="btn_action" />
                    <input type="submit" name="action" id="action" class="btn btn-primary" value="Add Member" />
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>