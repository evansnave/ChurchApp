<?php
include_once "partials/header.php";
include_once "operations/connection.php";
include_once "helpers/functions.php";
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
                                            <h4 class="text-muted">Foundation School Teachers</h4>
                                        </div>
                                        <div class=" col-md-6 text-right">
                                            <button name="add" id="add_button" data-toggle="modal" data-target="#userModal" class="btn btn-dark">
                                                Add Teacher
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-block table-border-style">
                                        <div class="table-responsive">
                                            <div id="load"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php include 'partials/modals/_teachers.php' ?>
            </div>
        </div>
    </div>
</div>
<?php include_once "partials/_footer.php"; ?>
<!-- <script src="assets/js/users.js"></script> -->
<script src="assets/js/teachers.js"></script>