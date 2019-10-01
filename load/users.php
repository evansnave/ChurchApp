<?php
include_once "../operations/connection.php";
include_once '../helpers/functions.php';
$query = "SELECT * FROM accounts WHERE account_status='active'";
$statement = $db->prepare($query);
$statement->execute();
$count = $statement->rowCount();
$rows = $statement->fetchAll(PDO::FETCH_ASSOC);
$i = 1;
if ($count == 0 && empty($rows)) {
    echo "<h4 class=\"text-center text-muted\">Please <strong>Add</strong> a User</h4>";
} else {
    ?>
    <table id="myTable" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th class="text-center">S/N</th>
                <th>Name</th>
                <th>Username</th>
                <th>User Role</th>
                <th class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($rows as $result) {
                ?>
                <tr>
                    <td class="text-center"><?php echo $i ?></td>
                    <td><?php echo strtoupper($result['username']) ?></td>
                    <td><?php echo $result['account_name'] ?></td>
                    <td><?php 
                        switch ($result['account_role']) {
                            case 'admin':
                                echo 'Administrator';
                                break;
                            case 'cell_leader':
                                echo nameOfCell($db, $result['cell']) .' cell Leader';
                                break;
                            case 'follow_up':
                                echo nameOfCell($db, $result['cell']) .' follow Up Cordinator';
                                break;
                            case 'official':
                                echo 'Registration Official';
                                break;       
                            default:
                                echo ' ';
                                break;
                        } 
                    ?></td>
                    <td class="text-center">
                        <?php if ($result['account_role'] == 'admin') { } else { ?>
                            <button type="button" name="update" id="<?php echo $result["account_id"] ?>" class="btn btn-primary update">Edit</button>
                            <a href="#" class=" btn btn-danger" id="delete_product" data-id="<?php echo $result["account_id"]; ?>" href="javascript:void(0)">Delete</a>
                        <?php }       ?>
                    </td>
                </tr>
                <?php $i++;
            } ?>
        </tbody>
    </table>
<?php } ?>
<script src="assets/js/datatables/datatables-init.js"></script>