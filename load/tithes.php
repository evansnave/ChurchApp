<?php
include_once "../operations/connection.php";
include_once '../helpers/functions.php';
$query = "SELECT * FROM tithes WHERE tithe_status = 'active' ";
$statement = $db->prepare($query);
$statement->execute();
$count = $statement->rowCount();
$rows = $statement->fetchAll(PDO::FETCH_ASSOC);
$i = 1;
if ($count == 0 && empty($rows)) {
    echo "<h3 class=\"text-center text-muted\">Please <strong>Add </strong>A  Tithe</h3>";
} else {
    ?>
    <table id="myTable" class="table table-hover table-striped table-bordered">

        <thead>
            <tr>
                <th class="text-center">#</th>
                <th>Date Entered</th>
                <th>Name of Accountant</th>
                <th>Tither</th>
                <th class="text-center">Amount</th>
                <th class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($rows as $results) { ?>
                <tr>
                    <th class="text-center" scope="row"><?= $i ?></th>
                    <td><?=simpleDate(strtotime( $results['date_entered'])) ?> </td>
                    <td><?= strtoupper($results['accountant_name']) ?> </td>
                    <td><?= cellLeader($db, $results['member_id']) ?></td>
                    <td><?= 'GH¢ '. number_format($results['amount'],2) ?> </td>
                    <td class="text-center">
                        <button type="button" name="update" id="<?php echo $results["id"] ?>" class="btn btn-primary update">Edit</button>
                        <a href="#" class=" btn btn-danger" id="delete_product" data-id="<?php echo $results["id"]; ?>" href="javascript:void(0)">Delete</a>
                    </td>
                </tr>
                <?php $i++;
            } ?>
        </tbody>
    </table>
<?php } ?>
<script src="assets/js/datatables/datatables-init.js"></script>