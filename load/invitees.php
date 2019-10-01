<?php
session_start();
$program_name = 'program_'.$_GET['date'];
include_once "../operations/connection.php";
include_once '../helpers/functions.php';
if ($_SESSION['role'] == 'cell_leader') {
    $cell_id = $_SESSION['cell_id'];
    $query = "SELECT * FROM `$program_name` WHERE invitee_status = 'active' AND cell = $cell_id ";
} else {
    $query = "SELECT * FROM `$program_name` WHERE invitee_status = 'active' ";
}
$statement = $db->prepare($query);
$statement->execute();
$count = $statement->rowCount();
$rows = $statement->fetchAll(PDO::FETCH_ASSOC);
$i = 1;
if ($count == 0 && empty($rows)) {
    echo "<h3 class=\"text-center text-muted\">Please <strong>Add</strong> an Invitee </h3>";
} else {
    ?>
    <table id="example23" class="table table-hover table-striped table-bordered">

        <thead>
            <tr>
                <th class="text-center">#</th>
                <th>Name of Invitee</th>
                <th>Phone Number</th>
                <th>Residence</th>
                <th>Family</th>
                <th class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($rows as $results) { ?>
                <tr>
                    <th class="text-center" scope="row"><?= $i ?></th>
                    <td><?= $results['name_of_invitee'] ?> </td>
                    <td><?= $results['phone_number'] ?> </td>
                    <td><?= $results['residence'] ?> </td>
                    <td><?= nameOfCell($db, $results['cell']) ?> </td>
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