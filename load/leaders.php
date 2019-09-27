<?php
include_once "../operations/connection.php";
require_once "../helpers/functions.php";
$query = "SELECT * FROM leaders WHERE status = 'active' ORDER BY leadership_title";
$statement = $db->prepare($query);
$statement->execute();
$count = $statement->rowCount();
$rows = $statement->fetchAll(PDO::FETCH_ASSOC);
$i = 1;
if ($count == 0 && empty($rows)) {
    echo "<h3 class=\"text-center text-muted\">Please add a leader </h3>";
} else {
    ?>
    <table id="myTable" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th class="text-center">#</th>
                <th>Name Of Leader</th>
                <th>Leadership Title</th>
                <th class="text-center">Action</th>
            </tr>
        </thead>

        <tbody>
            <?php
            foreach ($rows as $result) { ?>
                <tr>
                    <td class="text-center"><?php echo $i ?></td>
                    <td><?= cellLeader ($db, $result['member_id']) ?></td>
                    <td><?= $result['leadership_title'] ?></td>
                    <td class="text-center">
                        <button type="button" name="update" id="<?php echo $result["id"] ?>" class="btn btn-primary update">Edit</button>
                        <a href="#" class=" btn btn-danger" id="delete_product" data-id="<?php echo $result["id"]; ?>" href="javascript:void(0)">
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