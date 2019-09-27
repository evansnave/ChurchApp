<?php
$query = "SELECT * FROM first_timers_attendance WHERE `$date` != 0 ORDER BY `$date`";
$statement = $db->prepare($query);
$statement->execute();
$count = $statement->rowCount();
$rows = $statement->fetchAll(PDO::FETCH_ASSOC);
$i = 1;
if ($count == 0 && empty($rows)) {
    echo "<h3 class=\"text-center text-muted\">No data available</h3>";
} else {
    ?>
<table id="myTable" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th class="text-center">S/N</th>
            <th>Name</th>
            <th>Phone Number</th>
            <th>Cell</th>
            <th class="text-center">Time Arrived</th>
            <th class="text-center" >Services Attended</th>
        </tr>
    </thead>
    <tbody>
        <?php
            foreach ($rows as $result) {
                $first_timer_id = $result['first_timer_id'];
                $query = "SELECT * FROM first_timers WHERE id = $first_timer_id  ORDER BY fullname";
                $statement = $db->prepare($query);
                $statement->execute();
                $count = $statement->rowCount();
                $first_timers = $statement->fetch();
                ?>
        <tr>
            <td class="text-center"><?php echo $i ?></td>
            <td>
                <?php echo strtoupper($first_timers['fullname']) ?>
            </td>
            <td><?php echo $first_timers['phone_number'] ?></td>
            <td><?php if ($first_timers['senior_cell'] != 0) {
                echo nameOfCell($db, $first_timers['senior_cell']);
            }
            ?></td>
            <td class="text-center"><?= ($result[$date]) ?></td>
            <td class="text-center"><?= serviesAttended($db,$first_timer_id)?></td>
        </tr>
        <?php $i++;
            } ?>
    </tbody>
</table>
<?php } ?>