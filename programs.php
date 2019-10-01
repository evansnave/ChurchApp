<?php 
include_once "partials/header.php";
include_once 'helpers/cell_leader_access.php';
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
                                            <h4 class="text-muted">Church Programs</h4>
                                        </div>
                                        <div class=" col-md-6 text-right">
                                            <?php if ($_SESSION['role'] != 'cell_leader') { ?>
                                                <button name="add" id="add_button" data-toggle="modal" data-target="program_modal" class="btn btn-dark">
                                                    Create Program
                                                </button>
                                            <?php } ?>
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
                <?php include 'partials/modals/_programs.php' ?>
            </div>
        </div>
    </div>
</div>
<?php include_once "partials/_footer.php"; ?>
<script src="assets/js/programs.js"></script>