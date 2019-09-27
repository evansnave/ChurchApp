<?php
$token = $_GET['token'];
include_once "../operations/connection.php";
$query = "SELECT * FROM calls WHERE first_timer = $token  AND status = 'active' ORDER BY called_at";
$statement = $db->prepare($query);
$statement->execute();
$count = $statement->rowCount();
$rows = $statement->fetchAll(PDO::FETCH_ASSOC);
$i = 1;
if ($count == 0 && empty($rows)) {
    echo "<h3 class=\"text-center text-muted\">No report for calls </h3>";
} else {
    ?>
    <table id="myTable" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th class="text-center">S/N</th>
                <th>Called By</th>
                <th>Type Of Call</th>
                <th>Response</th>
                <th>Comment</th>
                <th class="text-center">Called At</th>
                <th class="text-center">Action</th>
            </tr>
        </thead>

        <tbody>
            <?php
            foreach ($rows as $result) { ?>
                <tr>
                    <td class="text-center"><?php echo $i ?></td>
                    <td><?= $result['called_by'] ?></td>
                    <td><?= $result['call_option'] ?></td>
                    <td><?= $result['response'] ?></td>
                    <td><?= $result['comment'] ?></td>
                    <td class="text-center">
                        <?php
                        $date = strtotime($result['called_at']);
                        echo date('l, M j, Y H:i A', $date)
                        ?>
                    </td>
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