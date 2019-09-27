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
                        <div class="">
                            <div class="row">
                                <div class="col-md-6 text-left">
                                    <?php if (checkAttendance($db) > 0) { ?>
                                        <h4 class="text-muted ">Attendance Registration for <?= date('l, M j, Y', $date); ?></h4>
                                    <?php }else {
                                        echo '<h4 class="text-muted ">Please contact the administrator</h4>';
                                    } ?>

                                </div>
                                <div class=" col-md-6 text-right">
                                    <?php if (checkAttendance($db) > 0) { ?>
                                        <button name="add" id="add_member" data-toggle="modal" data-target="#member_modal" class="btn btn-dark">
                                            Add Member
                                        </button>
                                        <button name="add" id="add_button" data-toggle="modal" data-target="#first_timer_modal" class="btn btn-dark">
                                            Add First Timer
                                        </button>
                                    <?php } ?>

                                </div>
                            </div>
                        </div>
                        <?php if (checkAttendance($db) > 0) { ?>
                            <div class="row">
                                <div class="col-sm-12">
                                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active text-uppercase" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Members</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link text-uppercase" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">First Timers</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link text-uppercase" id="registered" data-toggle="tab" href="#members" role="tab" aria-controls="registered" aria-selected="false">Registered</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content" id="myTabContent">
                                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                            <div class="table-responsive">
                                                <div id="load"></div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                            <div class="table-responsive">
                                                <div id="first_timers"></div>
                                            </div>
                                        </div>
                                        
                                        <div class="tab-pane fade" id="members" role="tabpanel" aria-labelledby="registered">
                                            <div class="table-responsive">
                                                <div id="members_data"></div>
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
<?php include 'partials/modals/_first_timers.php' ?>
<?php include 'partials/modals/_members.php' ?>

<?php include_once "partials/_footer.php"; ?>
<script src="assets/js/registration.js"></script>