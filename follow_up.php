<?php include_once "partials/header.php";
include_once 'helpers/functions.php';
include_once 'operations/connection.php';
include_once 'helpers/follow_up_access.php';
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
                                            <h4 class="text-muted">Follow-up Report</h4>
                                        </div>
                                        <div class=" col-md-6 text-right">
                                        </div>
                                    </div>
                                    <div class="card-block table-border-style">
                                        <div class="table-responsive">
                                            <?php
                                            if ($_SESSION['role'] == 'cell_leader' || $_SESSION['role'] == 'follow_up' ) {
                                                $cell_id = $_SESSION['cell_id'];
                                                $query = "SELECT * FROM first_timers WHERE firstTimer_status = 'active' AND senior_cell = $cell_id ORDER BY id desc   ";
                                            } else {
                                                $query = "SELECT * FROM first_timers WHERE firstTimer_status = 'active' ORDER BY id desc   ";
                                            }
                                            $statement = $db->prepare($query);
                                            $statement->execute();
                                            $count = $statement->rowCount();
                                            $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
                                            $i = 1;
                                            if ($count == 0 && empty($rows)) {
                                                echo "<h3 class=\"text-center text-muted\">No First Timers available for follow-up</h3>";
                                            } else {
                                                ?>
                                                <table id="example23" class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center">S/N</th>
                                                            <th>Name</th>
                                                            <th>Phone Number</th>
                                                            <th>Cell</th>
                                                            <th>Date</th>
                                                            <th>Calls Made</th>
                                                            <th>Visitation</th>
                                                            <th>Ministry Materials</th>
                                                            <th>Services Attended</th>
                                                            <th>Activity Group</th>
                                                            <th class="text-center">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($rows as $result) { 
                                                            $id = $result['id'];
                                                            ?>
                                                            <tr>
                                                                <td class="text-center"><?php echo $i ?></td>
                                                                <td><?php echo strtoupper($result['fullname']) ?></td>
                                                                <td><?php echo $result['phone_number'] ?></td>
                                                                <td><?= nameOfCell($db, $result['senior_cell']) ?></td>
                                                                <td><?= simpleDate(strtotime($result['date_added'])) ?></td>
                                                                <td>
                                                                    <div class="progress">
                                                                        <div class="progress-bar progress-bar-striped progress-bar-animated bg-danger" role="progressbar" style="width:<?php echo  counter($db, $result['id'], 'calls', 10) ?>%"></div>
                                                                    </div>
                                                                    <center>
                                                                        <span>
                                                                            <?php echo  counter($db, $id, 'calls', 10) ?>%
                                                                        </span>
                                                                    </center>

                                                                </td>
                                                                <td>
                                                                    <div class="progress">
                                                                        <div class="progress-bar progress-bar-striped progress-bar-animated bg-warning" role="progressbar" style="width: <?php echo  counter($db, $id, 'visitation', 2) ?>%"></div>
                                                                    </div>
                                                                    <center>
                                                                        <span>
                                                                            <?php echo  counter($db, $id, 'visitation', 2) ?>%
                                                                        </span>
                                                                    </center>
                                                                </td>
                                                                <td>
                                                                    <div class="progress">
                                                                        <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" style="width: <?php echo  counter($db, $id, 'ministry_materials', 1) ?>%"></div>
                                                                    </div>
                                                                    <center>
                                                                        <span>
                                                                            <?php echo  counter($db, $id, 'ministry_materials', 1) ?>%
                                                                        </span>
                                                                    </center>
                                                                </td>
                                                                <td>
                                                                    <div class="progress">
                                                                        <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary" role="progressbar" style="width:<?php echo  counter($db, $id, 'service_attendance', 4) ?>%"></div>
                                                                    </div>
                                                                    <center>
                                                                        <span>
                                                                            <?php echo  counter($db, $id, 'service_attendance', 4) ?>%
                                                                        </span>
                                                                    </center>
                                                                </td>
                                                                <td>
                                                                    <div class="progress">
                                                                        <div class="progress-bar progress-bar-striped progress-bar-animated bg-info" role="progressbar" style="width: <?php echo  counter($db, $id, 'activity_groups_joined', 1) ?>%"></div>
                                                                    </div>
                                                                    <center>
                                                                        <span>
                                                                            <?php echo  counter($db, $id, 'activity_groups_joined', 1) ?>%
                                                                        </span>
                                                                    </center>
                                                                </td>
                                                                <td class="text-center">
                                                                    <?php
                                                                    if ($result['senior_cell'] == 0) {
                                                                        echo '<button id="assign_button"  data-id="' . $id . '" data-toggle="modal" data-target="#assign" class="btn btn-danger" style="color:white">Assign</button>';
                                                                    } else {
                                                                        echo '<a href="report.php?token=' . $id . '" class ="btn btn-success">View Reports</a>';
                                                                    }
                                                                    ?>
                                                                </td>
                                                            </tr>
                                                            <?php $i++;
                                                        } ?>
                                                    </tbody>
                                                </table>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php include 'partials/modals/_assign.php' ?>
            </div>
        </div>
    </div>
</div>
<?php include_once "partials/_footer.php"; ?>
<script src="assets/js/follow_up.js"></script>