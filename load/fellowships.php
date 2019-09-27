<?php
include_once "../operations/connection.php";
include_once '../helpers/functions.php';
$query = "SELECT * FROM cells WHERE cell_status = 'active' ";
$statement = $db->prepare($query);
$statement->execute();
$count = $statement->rowCount();
$rows = $statement->fetchAll(PDO::FETCH_ASSOC);
$i = 1;
if ($count == 0 && empty($rows)) {
    echo "<h3 class=\"text-center text-muted\">Please <strong>Add</strong> a Family</h3>";
} else {
    ?>
    <table id="myTable" class="table table-hover table-striped table-bordered">

        <thead>
            <tr>
                <th class="text-center">#</th>
                <th>Name of Family</th>
                <th>Family Leader</th>
                <th class="text-center">Assigned First timers</th>
            <th class="text-center">Family Members</th>
                <th class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($rows as $results) { ?>
                <tr>
                    <th class="text-center" scope="row"><?= $i ?></th>
                    <td><?= $results['name_of_cell'] ?> </td>
                    <td><?= cellLeader($db, $results['cell_leader']) ?> </td>
                    <!-- <td><?= $results['cell_venue'] ?> </td> -->
                    <td class="text-center"><?= countMemberInACell($db, $results['id']) ?> </td>
                    <td class="text-center"><?= countAssignedFirstTimers($db, $results['id']) ?> </td>
                    <td class="text-center">
                        <a href="cells.php?cell=<?= $results['id'] ?>" class="btn btn-success">View</a>
                        <button type="button" name="update" id="<?php echo $results["id"] ?>" class="btn btn-primary update">Edit</button>
                        <?php
                        if (countMemberInACell($db, $results['id']) == 0) { ?>
                            <a href="#" class=" btn btn-danger" id="delete_product" data-id="<?php echo $results["id"]; ?>" href="javascript:void(0)">Delete</a>
                        <?php } ?>
                    </td>
                </tr>
                <?php $i++;
            } ?>
        </tbody>
    </table>
<?php } ?>
<script src="assets/js/datatables/datatables-init.js"></script>