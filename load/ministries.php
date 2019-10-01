<?php
include_once "../operations/connection.php";
include_once "../helpers/functions.php";
$query = "SELECT * FROM ministries WHERE ministry_status = 'active' ORDER BY name_of_ministry ";
$statement = $db->prepare($query);
$statement->execute();
$count = $statement->rowCount();
$rows = $statement->fetchAll(PDO::FETCH_ASSOC);
$i = 1;
if ($count == 0 && empty($rows)) {
    echo "<h3 class=\"text-center text-muted\">Please <strong>Add</strong> a Ministry</h3>";
} else {
    ?>
    <table id="myTable" class="table table-hover table-striped table-bordered">

        <thead>
            <tr>
                <th class="text-center">#</th>
                <th>Ministry</th>
                <th>Ministry Leader</th>
                <th>Total Members</th>
                <th class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($rows as $results) { ?>
                <tr>
                    <th class="text-center" scope="row"><?= $i ?></th>
                    <td><?= $results['name_of_ministry'] ?> </td>
                    <td><?= cellLeader($db, $results['ministry_leader']) ?> </td>
                    <td><?= countMembersInMinistries($db,$results["id"])?></td>
                    <td class="text-center">
                        <!-- <a href="department_members.php?department=<?=$results["id"]?>" class= "btn btn-success">View</a> -->
                        <button type="button" name="update" id="<?php echo $results["id"] ?>" class="btn btn-primary update">Edit</button>
                        <a href="#" class=" btn btn-danger" id="delete_product" data-id="<?php echo $results["id"]; ?>" href="javascript:void(0)">
                            Delete
                        </a>
                    </td>
                </tr>
                <?php $i++;
            } ?>
        </tbody>
    </table>
<?php } ?>
<script src="assets/js/datatables/datatables-init.js"></script>