<?php
session_start();
include_once "../operations/connection.php";
include_once "../helpers/functions.php";
$query = "SELECT * FROM `programs` WHERE `program_status` = 'active' ORDER BY program_id desc   ";
$statement = $db->prepare($query);
$statement->execute();
$count = $statement->rowCount();
$rows = $statement->fetchAll(PDO::FETCH_ASSOC);
$i = 1;
if ($count == 0 && empty($rows)) {
    echo "<h3 class=\"text-center text-muted\">Please create a Program</h3>";
} else {
    ?>
    <table id="myTable" class="table table-hover table-striped table-bordered">

        <thead>
            <tr>
                <th class="text-center">#</th>
                <th>Name Of Program</th>
                <th>Date Of Program</th>
                <th class="text-center">Attendance Target</th>
                <?php if ($_SESSION['role'] == 'admin') { ?>
                    <th class="text-center">Total Invitees</th>
                    <th class="text-center">Link</th>
                <?php } ?>
                <th class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($rows as $results) { ?>
                <tr>
                    <th class="text-center" scope="row"><?= $i ?></th>
                    <th><?= strtoupper($results['name_of_program']) ?></th>
                    <td>
                        <?php
                            $date = strtotime($results['date_of_program']);
                            echo date('l, M j, Y', $date);
                        ?>
                    </td>
                    <th class="text-center"><?= $results['attendance_target'] ?></th>
                    </td>
                    <?php if ($_SESSION['role'] == 'admin') { ?>
                        <td class="text-center">
                            <?php echo countInviteesForAProgram($db, $date) ?>
                        </td>
                        <td class="text-center">
                            <a href="program.php?program=<?php echo $date ?>">https://cewaportal.com/program.php?program=<?php echo  $date ?></a>
                        </td>
                    <?php } ?>
                    <td class="text-center">
                        <a href="program_details.php?date=<?= $date ?>" class="btn btn-success">Details</a>
                        <?php if ($_SESSION['role'] != 'cell_leader') { ?>
                            <button type="button" name="update" id="<?php echo $results["program_id"] ?>" class="btn btn-primary update">Edit</button>
                            <a href="#" class=" btn btn-danger" id="delete_product" data-id="<?php echo $results["program_id"]; ?>" href="javascript:void(0)">Delete</a>
                        <?php } ?>
                    </td>
                </tr>
            <?php $i++;
                } ?>
        </tbody>
    </table>
<?php } ?>
<script src="assets/js/datatables/datatables-init.js"></script>