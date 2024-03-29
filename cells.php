<?php
include_once "partials/header.php";
include_once "operations/connection.php";
include_once "helpers/functions.php";
include_once 'helpers/cell_leader_access.php';
if ($_SESSION['role'] == 'cell_leader') {
    $cell_id = $_SESSION['cell_id'];
} else {
    $cell_id = $_GET['cell'];
}
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
                                            <h4 class="text-muted"><?= nameOfCell($db, $cell_id) ?></h4>
                                        </div>
                                        <div class=" col-md-6 text-right">
                                            <button name="add" id="add_member" data-toggle="modal" data-target="#member_modal" class="btn btn-dark">
                                                Add Member
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
                <?php include 'partials/modals/_members.php' ?>
            </div>
        </div>
    </div>
</div>
<?php include_once "partials/_footer.php"; ?>
<script src="assets/js/cell_members.js"></script>
<script>
    function fetch_data() {
        $.ajax({
            url: "load/cell_members.php?cell=<?= $cell_id ?>",
            method: "POST",
            success: function(data) {
                $('#load').html(data);
            }
        });
    }
</script>