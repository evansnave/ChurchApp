<?php
include_once "../operations/connection.php";
include_once "../helpers/functions.php";
$token = $_GET['token'];
$query = "SELECT * FROM activity_groups_joined WHERE first_timer = $token AND status= 'active' ";
$statement = $db->prepare($query);
$statement->execute();
$count = $statement->rowCount();
$rows = $statement->fetchAll(PDO::FETCH_ASSOC);
$i = 1;
if ($count == 0 && empty($rows)) {
    echo "<h3 class=\"text-center text-muted\">Has not joined any department </h3>";
} else {
    ?>
    <table id="myTable" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th class="text-center">S/N</th>
                <th>Departments</th>
                <th class="text-center">Action</th>  
            </tr>
        </thead>

        <tbody>
            <?php
            foreach ($rows as $result) {
                ?>
                <tr>
                    <td class="text-center"><?php echo $i ?></td>
                    <td><?= nameOfActivityGroup($db,$result['group_joined']) ?></td>
                    <td class="text-center">
                        <button type="button" name="update" id="<?php echo $result["id"] ?>" class="btn btn-primary update_activity_group">Edit</button>
                        <a href="#" class=" btn btn-danger" id="delete_group" data-id="<?php echo $result["id"]; ?>" href="javascript:void(0)">
                            Delete
                        </a>
                    </td>
                </tr>
                <?php $i++;
            } ?>
        </tbody>
    </table>
<?php } ?>