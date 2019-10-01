<?php
include_once "../operations/connection.php";
include_once '../helpers/functions.php';
$today = date('Y-m-d');
$column_name = strtotime($today);
$query = "SELECT * FROM first_timers_attendance WHERE `$column_name` = 0";
$statement = $db->prepare($query);
$statement->execute();
$count = $statement->rowCount();
$rows = $statement->fetchAll(PDO::FETCH_ASSOC);
$i = 1;
if ($count == 0 && empty($rows)) {
    echo "<h3 class=\"text-center text-muted\">No data available</h3>";
} else {
    ?>
<table id="myTableFt" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th class="text-center">S/N</th>
            <!-- <td>Picture</td> -->
            <th>Name</th>
            <th>Phone Number</th>
            <th class="text-center">Services Attended</th>
            <th class="text-center">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
            foreach ($rows as $result) {
                $first_timer_id = $result['first_timer_id'];
                $query = "SELECT * FROM first_timers WHERE id = $first_timer_id ";
                $statement = $db->prepare($query);
                $statement->execute();
                $count = $statement->rowCount();
                $first_timers = $statement->fetch();
                ?>
        <tr>
            <td class="text-center"><?php echo $i ?></td>
            <!-- <td>
                        <img class="rounded-circle m-r-10" style="width:40px;" src="assets/images/user/avatar-1.jpg" alt="activity-user">

                    </td> -->
            <td>
                <?php echo strtoupper($first_timers['fullname']) ?>
            </td>
            <td><?php echo $first_timers['phone_number'] ?></td>
            <td class="text-center"><?= serviesAttended($db, $first_timer_id) ?></td>
            <td class="text-center">
                <button type="button" name="register_ft" id="<?php echo $first_timers["id"] ?>" class="btn btn-primary register_ft">Register</button>
            </td>
        </tr>
        <?php $i++;
            } ?>
    </tbody>
</table>
<?php } ?>
<script src="assets/js/ftDt.js"></script>