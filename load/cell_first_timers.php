<?php
session_start();
include_once "../operations/connection.php";
include_once "../helpers/functions.php";
if ($_SESSION['role'] == 'cell_leader') {
    $cell_id = $_SESSION['cell_id'];
    $query = "SELECT DISTINCT date_added FROM cell_first_timers WHERE firstTimer_status = 'active' AND cell = $cell_id ORDER BY date_added desc   ";
} else {
    $query = "SELECT DISTINCT date_added FROM cell_first_timers WHERE firstTimer_status = 'active' ORDER BY date_added desc   ";
}
$statement = $db->prepare($query);
$statement->execute();
$count = $statement->rowCount();
$rows = $statement->fetchAll(PDO::FETCH_ASSOC);
$i = 1;
if ($count == 0 && empty($rows)) {
    echo "<h3 class=\"text-center text-muted\">Please add First Timers from your cell meetings</h3>";
} else {
    ?>
    <table id="myTable" class="table table-hover table-striped table-bordered">

        <thead>
            <tr>
                <th class="text-center">#</th>
                <th>Date</th>
                <th class="text-center">Number of First timers</th>
                <th class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($rows as $results) { ?>
                <tr>
                    <th class="text-center" scope="row"><?= $i ?></th>
                    <td>
                        <?php
                        $date = strtotime($results['date_added']);
                        echo date('l, M j, Y', $date);
                        ?>
                    </td>
                    <td class="text-center">
                        <?= ($_SESSION['role'] == 'cell_leader') ? countCellFirstTimers($db, $cell_id) : countFirstTimersAddedOnADay($db, $date) ?>
                    </td>
                    <td class="text-center">
                        <a href="cell_ft_details.php?date=<?= $date ?>" class="btn btn-secondary">View Details</a>
                    </td>
                </tr>
                <?php $i++;
            } ?>
        </tbody>
    </table>
<?php } ?>
<script src="assets/js/datatables/datatables-init.js"></script>