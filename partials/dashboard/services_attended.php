<?php
$query = "SELECT * FROM service_logger WHERE `logger_stats` = 'active' LIMIT 10 ";
$statement = $db->prepare($query);
$statement->execute();
$count = $statement->rowCount();
$rows = $statement->fetchAll(PDO::FETCH_ASSOC);
$i = 1;
if ($count == 0 && empty($rows)) {
    echo "<h3 class=\"text-center text-muted\">No reports for service attendance </h3>";
}else {
?>
<table class="table table-hover">
    <thead>
        <tr>
            <th class="text-center">#</th>
            <th>Name</th>
            <th>Phone Number</th>
            <th class="text-center">Services Attended</th>
            <th>Last service attended</th>
            <th class="text-center"></th>
        </tr>
    </thead>

    <tbody>
        <?php foreach ($rows as $result) { ?>
        <tr>
            <td class="text-center"><?php echo $i ?></td>
            <td><?= nameOfFistTImer($db, $result['first_timer_id']) ?></td>
            <td><?= numberOfFistTImer($db, $result['first_timer_id']) ?></td>
            <td class="text-center"><?= $result['service_count'] ?></td>
            <td>
                <?= simpleDate(lastServiceAttended($db, $result['first_timer_id'])) ?>
            </td>
            <td class="text-center">
                <a href="report.php?token=<?= $result['first_timer_id'] ?>" class="label theme-bg2 text-white f-12">Reports</a>
            </td>
        </tr>
        <?php $i++; } ?>
    </tbody>
</table>
<?php } ?>