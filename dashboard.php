<?php
include_once "partials/header.php";
include_once 'helpers/admin_access.php';
include_once "operations/connection.php";
include_once "helpers/functions.php";
?>
<div class="pcoded-main-container">
    <div class="pcoded-wrapper">
        <div class="pcoded-content">
            <div class="pcoded-inner-content">
                <div class="main-body">
                    <div class="page-wrapper">
                        <div id="alert"></div>
                        <div class="row">
                            <div class="col-md-6 col-xl-3">
                                <div class="card daily-sales">
                                    <div class="card-block">
                                        <h4 class="mb-4">Members</h4>
                                        <div class="row d-flex align-items-center">
                                            <div class="col-12">
                                                <h3 class="m-b-0 text-right reload">
                                                    <i class="feather icon-users text-c-green f-30 m-r-10"></i>
                                                    <?= countMembers($db) ?>
                                                </h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-xl-3">
                                <div class="card daily-sales">
                                    <div class="card-block">
                                        <h4 class="mb-4">First Timers</h4>
                                        <div class="row d-flex align-items-center">
                                            <div class="col-12">
                                                <h3 class="m-b-0 text-right">
                                                    <i class="feather icon-user-plus text-c-red f-30 m-r-10"></i>
                                                    <?= countFirstTimers($db) ?>
                                                </h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-xl-3">
                                <div class="card daily-sales">
                                    <div class="card-block">
                                        <h4 class="mb-4">Family Meeting First Timers</h4>
                                        <div class="row d-flex align-items-center">
                                            <div class="col-12">
                                                <h3 class="m-b-0 text-right">
                                                    <i class="feather icon-box text-c-blue f-30 m-r-10"></i>
                                                    <?= countFirstTimersFromCellMeetings($db) ?>
                                                </h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-xl-3">
                                <div class="card daily-sales">
                                    <div class="card-block">
                                        <h4 class="mb-4">First Timers Added Today</h4>
                                        <div class="row d-flex align-items-center">
                                            <div class="col-12">
                                                <h3 class="m-b-0 text-right">
                                                    <i class="feather icon-arrow-up text-c-yellow f-30 m-r-10"></i>
                                                    <?= countFirstTimersAddedToday($db) ?>
                                                </h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-8 col-md-6">
                                <div class="card Recent-Users">
                                    <div class="card-header">
                                        <h5>First Timers Migration</h5>
                                    </div>
                                    <div class="card-block px-0 py-3">
                                        <div class="table-responsive reload">
                                            <table class="table table-hover">
                                                <tbody>
                                                    <?= firstTimerMigration($db) ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-md-6">
                                <div class="card card-event">
                                    <div class="card-block">
                                        <div class="row align-items-center justify-content-center">
                                            <div class="col">
                                                <h5 class="m-0">Upcoming Birthdays</h5>
                                            </div>
                                            <?= upcomingBirthdays($db) ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-8 col-md-12">
                                <div class="card Recent-Users">
                                    <div class="card-header">
                                        <h5>Recent Members </h5>
                                    </div>
                                    <div class="card-block px-0 py-3">
                                        <div class="table-responsive">
                                            <table class="table table-hover">
                                                <tbody>
                                                    <?= recentMembers($db) ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4" style="padding:0">
                                <div class="col-md-12 col-sm-12 col-xl-12">
                                    <div class="card card-social">
                                        <div class="card-block border-bottom">
                                            <div class="row align-items-center justify-content-center">
                                                <div class="col-auto">
                                                    <i class="feather icon-star text-primary f-36"></i>
                                                </div>
                                                <div class="col text-right">
                                                    <h3 class="text-muted tet-primary">Foundation School</h3>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-block">
                                            <div class="row align-items-center justify-content-center card-active">
                                                <div class="col-6">
                                                    <h6 class="text-center m-b-10"><span class="text-muted m-r-5">Completed:</span><?= countFoundationSchool($db) ?></h6>
                                                    <?php
                                                    $percent = 0;
                                                    $not_completed = (countMembers($db) - countFoundationSchool($db));
                                                    if (countmembers($db) > 0) {
                                                        $percent = ($not_completed / countMembers($db)) * 100;
                                                        $completed = (100 - $percent);
                                                    }
                                                    ?>
                                                    <div class="progress">
                                                        <div class="progress-bar progress-c-theme" role="progressbar" style="width:<?= $completed ?>%;height:6px;" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <h6 class="text-center  m-b-10"><span class="text-muted m-r-5">Not Completed:</span><?= (countMembers($db) - countFoundationSchool($db)) ?></h6>
                                                    <div class="progress">
                                                        <div class="progress-bar progress-c-theme2" role="progressbar" style="width:<?= $percent ?>%;height:6px;" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xl-12">
                                    <div class="card">
                                        <div class="card-block border-bottom">
                                            <div class="row align-items-center justify-content-center">
                                                <div class="col-auto">
                                                    <i class="feather icon-droplet text-danger f-36"></i>
                                                </div>
                                                <div class="col text-right">
                                                    <h3 class="text-muted tet-primary">Baptism</h3>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-block">
                                            <div class="row align-items-center justify-content-center card-active">
                                                <div class="col-6">
                                                    <h6 class="text-center m-b-10"><span class="text-muted m-r-5">Baptised:</span><?= countBaptism($db) ?></h6>
                                                    <?php
                                                    $percentage = 0;
                                                    $absent = (countMembers($db) - countBaptism($db));
                                                    if (countmembers($db) > 0) {
                                                        $percentage = ($absent / countMembers($db)) * 100;
                                                        $present = 100 - $percentage;
                                                    }
                                                    ?>
                                                    <div class="progress">
                                                        <div class="progress-bar progress-c-theme" role="progressbar" style="width:<?= $present ?>%;height:6px;" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <h6 class="text-center  m-b-10"><span class="text-muted m-r-5">Not Baptised:</span><?= $absent ?></h6>
                                                    <div class="progress">
                                                        <div class="progress-bar progress-c-theme2" role="progressbar" style="width:<?= $percentage ?>%;height:6px;" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="col-xl-12 col-md-12">
                                <div class="card Recent-Users">
                                    <div class="card-header">
                                        <h5>Recent Follow-up Reports</h5>
                                    </div>
                                    <div class="card-block px-0 py-3">
                                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="false">Follow-up Calls</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link active show" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="true">Visitations</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Services Attended</a>
                                            </li>
                                        </ul>
                                        <div class="tab-content" id="myTabContent">
                                            <div class="tab-pane fade" id="home" role="tabpanel" aria-labelledby="home-tab">
                                                <div class="table-responsive">
                                                    <?php include_once 'partials/dashboard/follow_up_calls.php'; ?>
                                                </div>

                                            </div>
                                            <div class="tab-pane fade active show" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                                <div class="table-responsive">
                                                    <?php include_once 'partials/dashboard/follow_up_visitations.php'; ?>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                                                <div class="table-responsive">
                                                    <?php include_once 'partials/dashboard/services_attended.php'; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="col-xl-8 col-sm-12">
                                <div class="card Recent-Users">
                                    <div class="card-header">
                                        <h5>Recent First Timers</h5>
                                    </div>
                                    <div class="card-block px-0 py-3">
                                        <div class="table-responsive">
                                            <table class="table table-hover">
                                                <tbody>
                                                    <?= recentFirstTimers($db) ?>
                                                </tbody>
                                            </table>
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
</div>
<?php
include_once "partials/modals/_members.php";
include_once "partials/_footer.php";
?>
<script src="assets/js/migrations.js"></script>