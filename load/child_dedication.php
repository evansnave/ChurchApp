<?php
include_once "../operations/connection.php";
include_once "../helpers/functions.php";
$query = "SELECT * FROM child_dedication where member_status = 'active' ORDER BY child_name";
$statement = $db->prepare($query);
$statement->execute();
$count = $statement->rowCount();
$rows = $statement->fetchAll(PDO::FETCH_ASSOC);
$i = 1;
if ($count == 0 && empty($rows)) {
    echo "<h3 class=\"text-center text-muted\">Please add a Child </h3>";
} else {
    ?>
<table id="example23" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th class="text-center">S/N</th>
            <th>Name Of Child</th>
            <th>Date Of Birth</th>
            <th>Gender</th>
            <th>Age</th>
            <th>Place Of Birth</th>
            <th>Father's Name</th>
            <th>Phone Number</th>
            <th>Mother's Name</th>
            <th class="text-center">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($rows as $result) {?>
        <tr>
            <td class="text-center"><?php echo $i ?></td>
            <td><?php echo strtoupper($result['child_name']) ?></td>
            <td><?php echo strtoupper($result['dob']) ?></td>
            <td><?php echo strtoupper($result['gender']) ?></td>
            <td><?php echo $result['age'] ?></td>
            <td><?php echo $result['pob'] ?></td>
            <td><?php echo $result['fathers_name'] ?></td>
            <td><?php echo $result['phone_number'] ?></td>
            <td><?php echo $result['mothers_name'] ?></td>
            <td class="text-center">
                <a href="dedication_report.php?child=<?php echo $result["member_id"] ?>" class="btn btn-success">View</a>
                <button type="button" name="update" id="<?php echo $result["member_id"] ?>" class="btn btn-primary update">Edit</button>
                <a href="#" class=" btn btn-danger" id="delete_product" data-id="<?php echo $result["member_id"]; ?>" href="javascript:void(0)">
                    Delete
                </a>
            </td>
        </tr>
        <?php $i++; } ?>
    </tbody>
</table>
<?php } ?>
<script src="assets/js/datatables/datatables-init.js"></script>