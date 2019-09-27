<?php
$query = "SELECT * FROM members_attendance WHERE `$date` != 0 ORDER BY `$date`";
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
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($rows as $result) {
                $member_id = $result['member_id'];
                $query = "SELECT * FROM members WHERE id = $member_id  ORDER BY fullname";
                $statement = $db->prepare($query);
                $statement->execute();
                $count = $statement->rowCount();
                $members = $statement->fetch();
                ?>
                <tr>
                    <td class="text-center"><?php echo $i ?></td>
                    <td>
                        <?php echo strtoupper($members['title'] . " " . $members['fullname']) ?>
                    </td>
                    <td><?php echo $members['phone_number'] ?></td>
                    <td>
                        <?php if ($members['cell'] != 0) 
                        {
                            echo nameOfCell($db, $members['cell']);    
                        } 
                        ?>
                    </td>
                    <td class="text-center"><?=($result[$date])?></td>
                </tr>
                <?php $i++;
            } ?>
        </tbody>
    </table>
<?php } ?>