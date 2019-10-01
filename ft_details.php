<?php
include_once "partials/header.php";
include_once 'helpers/cell_leader_access.php';
$date = $_GET["date"];
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
                                            <h4 class="text-muted">First Timers for <?= date('l, M j, Y', $date) ?></h4>
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
                <?php include 'partials/modals/_first_timers.php' ?>
            </div>
        </div>
    </div>
</div>
<?php include_once "partials/_footer.php"; ?>
<script src="assets/js/ft_details.js"></script>
<script>
    function fetch_data() {
        $.ajax({
            url: "load/ft_details.php?date=<?= $date ?>",
            method: "POST",
            success: function(data) {
                $('#load').html(data);
            }
        });
    }
</script>