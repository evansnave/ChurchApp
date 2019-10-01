<?php
$query = "SELECT * FROM visitation WHERE `status` = 'active' ORDER BY date_added DESC LIMIT 10";
$statement = $db->prepare($query);
$statement->execute();
$count = $statement->rowCount();
$rows = $statement->fetchAll(PDO::FETCH_ASSOC);
$i = 1;
if ($count == 0 && empty($rows)) {
    echo "<h3 class=\"text-center text-muted\">No report for visitations </h3>";
} else {
    ?>
<table class="table table-hover">
    <thead> 
        <tr>
            <th class="text-center">#</th>
            <th>Name</th>
            <th>Phone Number</th>
            <th class="text-center">Day Visited</th>
            <th>Duration</th>
            <th>Visited By</th>
            <th class="text-center"></th>
        </tr>
    </thead>

    <tbody>
        <?php
            foreach ($rows as $data) { ?>
        <tr>
            <td class="text-center"><?php echo $i ?></td>
            <td><?= nameOfFistTImer($db, $data['first_timer']) ?></td>
            <td><?= numberOfFistTImer($db, $data['first_timer']) ?></td>
            <td class="text-center">
               <?= simpleDate(strtotime($data['date_of_visitation'])) ?>
            </td>
            <td><?= $data['duration'] ?></td>
            <td><?= $data['visited_by'] ?></td>
            <td class="text-center">
                <a href="report.php?token=<?= $data['first_timer'] ?>" class="label theme-bg2 text-white f-12">Reports</a>
            </td>

        </tr>
        <?php $i++;
            } ?>
    </tbody>
</table>
<?php } ?>