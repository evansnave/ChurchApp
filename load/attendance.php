<?php
include_once "../operations/connection.php";
include_once "../helpers/functions.php";
$query = "SELECT * FROM attendance WHERE status = 'active' ORDER BY id desc ";
$statement = $db->prepare($query);
$statement->execute();
$count = $statement->rowCount();
$rows = $statement->fetchAll(PDO::FETCH_ASSOC);
$i = 1;
if ($count == 0 && empty($rows)) {
    echo "<h3 class=\"text-center text-muted\">Please Start a    Service</h3>";
} else {
    ?>
    <table id="myTable" class="table table-hover table-striped table-bordered">

        <thead>
            <tr>
                <th class="text-center">#</th>
                <th>Service Date</th>
                <th class="text-center">Present</th>
                <th class="text-center">Absent</th>
                <th class="text-center">First Timers</th>
                <th class="text-center">Total Attendance</th>
                <th class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($rows as $results) { ?>
                <tr>
                    <th class="text-center" scope="row"><?= $i ?></th>
                    <td>
                        <?php
                        $date = $results['service_date'];
                        echo date('l, M j, Y', $date);
                        ?>
                    </td>
                    <td class="text-center">
                        <?= countMembersPresent($db, $date) ?>
                    </td>
                    <td class="text-center">
                        <?= countMembersAbsent($db, $date) ?>
                    </td>
                    <td class="text-center">
                        <?= countFirstTimersPresent($db, $date) ?>
                    </td>
                    <td class="text-center">
                        <?= (countFirstTimersPresent($db, $date) + countMembersPresent($db, $date))?>
                    </td>
                    <td class="text-center">
                        <?php
                        if ($results['session'] == 'ongoing') { ?>
                            <a href="#" class=" btn btn-danger" id="end" data-id="<?php echo $results["id"]; ?>" href="javascript:void(0)">End Registration</a>
                        <?php } ?>

                        <?php
                        if ($results['session'] == 'ended') { ?>
                            <a href=" attendance_report.php?date=<?= $date ?>" class="btn btn-primary">Report</a>
                            <a href="#" class=" btn btn-danger" id="delete_service" data-id="<?php echo $date; ?>" href="javascript:void(0)">
                                Delete
                            </a>
                        <?php } ?>
                    </td>
                </tr>
                <?php $i++;
            } ?>
        </tbody>
    </table>
<?php } ?>
<script src="assets/js/datatables/datatables-init.js"></script>