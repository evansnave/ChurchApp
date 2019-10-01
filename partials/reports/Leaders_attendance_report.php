<?php
include_once "partials/header.php";
include_once "operations/connection.php";
include_once "helpers/functions.php";
include_once 'helpers/admin_access.php';
$date = $_GET['date'];
?>
<script src="assets/js/jquery.min.js"></script>

<div class="pcoded-main-container">
    <div class="pcoded-wrapper">
        <div class="pcoded-content">
            <div class="pcoded-inner-content">
                <div class="main-body">
                    <div class="page-wrapper">
                        <div id="alert"></div>
                        <div class="header">
                            <h4 class="text-muted">Attendance Report for <?= simpleDate($date) ?></h4>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <ul class="nav nav-pills mb-3 text-center" id="pills-tab" role="tablist">
                                    <!-- <li class="nav-item">
                                        <a class="nav-link active" id="calls_tab" data-toggle="pill" href="#pills-calls" role="tab" aria-controls="pills-calls" aria-selected="true">Report</a>
                                    </li> -->
                                    <li class="nav-item">
                                        <a class="nav-link active" id="visitations_tab" data-toggle="pill" href="#pills-visitations" role="tab" aria-controls="pills-visitations" aria-selected="false">Members Present</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="group_tab" data-toggle="pill" href="#pills-group" role="tab" aria-controls="pills-group" aria-selected="false">Members Absent</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="ministry_tab" data-toggle="pill" href="#pills-ministry" role="tab" aria-controls="pills-ministry" aria-selected="false">First Timers</a>
                                    </li>
                                </ul>
                                <div class="tab-content" id="pills-tabContent">
                                    <!-- <div class="tab-pane fade show active" id="pills-calls" role="tabpanel" aria-labelledby="calls_tab">
                                        <?php include 'partials/reports/reports.php' ?>
                                    </div> -->
                                    <div class="tab-pane fade show active" id="pills-visitations" role="tabpanel" aria-labelledby="visitations_tab">
                                        <div class="table-responsive">
                                            <?php include 'partials/reports/present.php' ?>
                                        </div> 
                                    </div>
                                    <div class="tab-pane fade" id="pills-group" role="tabpanel" aria-labelledby="group_tab">
                                        <div class="table-responsive">
                                            <?php include 'partials/reports/absent.php' ?>
                                        </div> 
                                    </div>
                                    <div class="tab-pane fade" id="pills-ministry" role="tabpanel" aria-labelledby="ministry_tab">
                                        <div class="table-responsive">
                                            <?php include 'partials/reports/first_timers.php' ?>
                                        </div> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include_once "partials/_footer.php"; ?>