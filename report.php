<?php
include_once "partials/header.php";
include_once "operations/connection.php";
include_once "helpers/functions.php";
$token = $_GET['token'];
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
                            <h5 class="text-muted">Follow-up Report for <?= nameOfFistTImer($db, $token) ?> <span class="text-primary">( <a href="tel:<?= numberOfFistTImer($db, $token) ?>"><?= numberOfFistTImer($db, $token) ?></a> )</span></h5>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <ul class="nav nav-pills mb-3 text-center" id="pills-tab" role="tablist">
                                    <!-- <li class="nav-item">
                                        <a class="nav-link active" id="profile_tab" data-toggle="pill" href="#pills-bio" role="tab" aria-controls="pills-calls" aria-selected="true">Bio Data</a>
                                    </li> -->
                                    <li class="nav-item">
                                        <a class="nav-link" id="calls_tab" data-toggle="pill" href="#pills-calls" role="tab" aria-controls="pills-calls" aria-selected="true">Calls</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="visitations_tab" data-toggle="pill" href="#pills-visitations" role="tab" aria-controls="pills-visitations" aria-selected="false">Visitations</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="group_tab" data-toggle="pill" href="#pills-group" role="tab" aria-controls="pills-group" aria-selected="false">Activity Group</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="ministry_tab" data-toggle="pill" href="#pills-ministry" role="tab" aria-controls="pills-ministry" aria-selected="false">Ministry Materials</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">Services Attended</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-fs" role="tab" aria-controls="pills-contact" aria-selected="false">Foundation School</a>
                                    </li>
                                </ul>
                                <div class="tab-content" id="pills-tabContent">
                                    <!-- <div class="tab-pane fade show active" id="pills-bio" role="tabpanel" aria-labelledby="profile_tab">
                                        <?php //include 'partials/reports/profile.php' ?>
                                    </div> -->
                                    <div class="tab-pane fade show active" id="pills-calls" role="tabpanel" aria-labelledby="calls_tab">
                                        <?php include 'partials/reports/calls.php' ?>
                                    </div>
                                    <div class="tab-pane fade" id="pills-visitations" role="tabpanel" aria-labelledby="visitations_tab">
                                        <?php include 'partials/reports/visitations.php' ?>
                                    </div>
                                    <div class="tab-pane fade" id="pills-group" role="tabpanel" aria-labelledby="group_tab">
                                        <?php include 'partials/reports/activity_groups_joined.php' ?>
                                    </div>
                                    <div class="tab-pane fade" id="pills-ministry" role="tabpanel" aria-labelledby="ministry_tab">
                                        <?php include 'partials/reports/ministry_materials.php' ?>
                                    </div>
                                    <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                                        <?php include 'partials/reports/services_attended.php' ?>
                                    </div>
                                    <div class="tab-pane fade" id="pills-fs" role="tabpanel" aria-labelledby="pills-fs">
                                        <?php include 'partials/reports/foundation_school.php' ?>
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