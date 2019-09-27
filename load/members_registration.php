<?php
include_once "../operations/connection.php";
include_once "../helpers/functions.php";
$today = date('Y-m-d');
$column_name = strtotime($today);
$query = "SELECT * FROM members_attendance WHERE `$column_name` = 0 ";
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
            <!-- <td>Picture</td> -->
            <th>Name</th>
            <th>Phone Number</th>
            <th>Family</th>
            <th class="text-center">Action</th>
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
            <td><?php echo strtoupper($members['title'] . " " . $members['fullname']) ?></td>
            <td><?php echo $members['phone_number'] ?></td>
            <td><?php
                if ($members['cell'] != 0) {
                    echo  nameOfCell($db, $members['cell']);
                }
            ?></td>
            <td class="text-center">
                <button type="button" name="register" id="<?php echo $member_id ?>" class="btn btn-primary register">Register</button>
            </td>
        </tr>
        <?php $i++;
            } ?>
    </tbody>
</table>
<?php } ?>
<script src="assets/js/datatables/datatables-init.js"></script>