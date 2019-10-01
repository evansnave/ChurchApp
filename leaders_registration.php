<?php
include_once "partials/header.php";
include_once "operations/connection.php";
include_once "helpers/functions.php";
if ($_SESSION['role'] == 'official') {
    $date = strtotime(date('Y-m-d'));
} else {
    $date = $_GET['date'];
}

?>
<script src="assets/js/jquery.min.js"></script>

<div class="pcoded-main-container">
    <div class="pcoded-wrapper">
        <div class="pcoded-content">
            <div class="pcoded-inner-content">
                <div class="main-body">
                    <div class="page-wrapper">
                        <div id="alert"></div>
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-6 text-left">
                                    <?php if (checkLAttendance($db) > 0) { ?>
                                        <h4 class="text-muted ">Attendance Registration for <?= date('l, M j, Y', $date); ?></h4>
                                    <?php }else {
                                        echo '<h4 class="text-muted ">Please contact the administrator</h4>';
                                    } ?>

                                </div>
                                <div class=" col-md-6 text-right">
                                </div>
                            </div>
                        </div>
                        <?php if (checkLAttendance($db) > 0) { ?>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="tab-content" id="myTabContent">
                                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                            <div class="table-responsive">
                                                <div id="load"></div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        <?php } ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_once "partials/_footer.php"; ?>
<script src="assets/js/leaders_registration.js"></script>