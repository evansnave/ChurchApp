<?php
$query = "SELECT * FROM calls WHERE  `status` = 'active' ORDER BY called_at DESC LIMIT 10";
$statement = $db->prepare($query);
$statement->execute();
$count = $statement->rowCount();
$rows = $statement->fetchAll(PDO::FETCH_ASSOC);
$i = 1;
if ($count == 0 && empty($rows)) {
    echo "<h3 class=\"text-center text-muted\">No report for calls </h3>";
} else {
    ?>
<table class="table table-hover">
    <thead>
        <tr>
            <th class="text-center">#</th>
            <th>Name</th>
            <th>Phone Number</th>
            <th class="text-center">Called At</th>
            <th>Type of Call</th>
            <th>Response</th>
            <th class="text-center"></th>
        </tr>
    </thead>

    <tbody>
        <?php
            foreach ($rows as $result) { ?>
        <tr>
            <td class="text-center"><?php echo $i ?></td>
            <td><?= nameOfFistTImer($db, $result['first_timer']) ?></td>
            <td><?= numberOfFistTImer($db, $result['first_timer']) ?></td>
            <td class="text-center">
                <?php
                        $date = strtotime($result['called_at']);
                        echo date('l, M j, Y H:i A', $date)
                        ?>
            </td>
            <td><?= $result['call_option'] ?></td>
            <td><?= $result['response'] ?></td>
            <td class="text-center">
                <a href="report.php?token=<?=$result['first_timer']?>" class="label theme-bg2 text-white f-12">Reports</a>
            </td>

        </tr>
        <?php $i++;
            } ?>
    </tbody>
</table>
<?php } ?>