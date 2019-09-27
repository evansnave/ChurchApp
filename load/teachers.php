<?php
include_once "../operations/connection.php";
include_once '../helpers/functions.php';
$query = "SELECT * FROM foundation_school_teachers WHERE teacher_status='active'";
$statement = $db->prepare($query);
$statement->execute();
$count = $statement->rowCount();
$rows = $statement->fetchAll(PDO::FETCH_ASSOC);
$i = 1;
if ($count == 0 && empty($rows)) {
    echo "<h4 class=\"text-center text-muted\">Please add a Teacher</h4>";
} else {
    ?>
    <table id="myTable" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th class="text-center">S/N</th>
                <th>Name</th>
                <th>Phone Number</th>
                <th class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($rows as $result) {?>
                <tr>
                    <td class="text-center"><?php echo $i ?></td>
                    <td><?php echo strtoupper($result['fullname']) ?></td>
                    <td><?php echo $result['phone_number'] ?></td>
                    <td class="text-center">
                        <button type="button" name="update" id="<?php echo $result["id"] ?>" class="btn btn-primary update">Edit</button>
                        <a href="#" class=" btn btn-danger" id="delete_product" data-id="<?php echo $result["id"]; ?>" href="javascript:void(0)">Delete</a>
                    </td>
                </tr>
            <?php $i++; } ?>
        </tbody>
    </table>
<?php } ?>
<script src="assets/js/datatables/datatables-init.js"></script>