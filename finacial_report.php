<?php 
include_once "partials/header.php";
include_once 'helpers/admin_access.php';
?>
<div class="pcoded-main-container">
    <div class="pcoded-wrapper">
        <div class="pcoded-content">
            <div class="pcoded-inner-content">
                <div class="main-body">
                    <div class="page-wrapper">
                        <div id="alert"></div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card">
                                    <div class="row card-header">
                                        <div class="col-md-6 text-left">
                                            <h4 class="text-muted">Financial Report</h4>
                                        </div>
                                    </div>
                                    <div class="card-block table-border-style">
                                        <form action="f_report.php" method="post">
                                            <div class="form-group">
                                                <label for="">From</label>
                                                <input type="date" name="from" id="from" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="">To</label>
                                                <input type="date" name="to" id="to" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="">Type of Report</label>
                                                <select name="type_of_report" id="type_of_report" class="form-control">
                                                    <option value="offerings">Offertory</option>
                                                    <option value="tithes">Tithe</option>
                                                    <option value="fundraising">Fundraising</option>
                                                </select>
                                            </div>

                                            <button type="submit" class="btn btn-primary text-center">Generate Report</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php include 'partials/modals/_members.php' ?>
            </div>
        </div>
    </div>
</div>
<?php include_once "partials/_footer.php"; ?>