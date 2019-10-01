<?php
$token = $_GET['token'];
include_once "../operations/connection.php";
$query = "SELECT * FROM service_attendance WHERE first_timer = $token AND status = 'active' ORDER BY service_day desc ";
$statement = $db->prepare($query);
$statement->execute();
$count = $statement->rowCount();
$rows = $statement->fetchAll(PDO::FETCH_ASSOC);
$i = 1;
if ($count == 0 && empty($rows)) {
    echo "<h3 class=\"text-center text-muted\">No services attended</h3>";
} else {
    ?>
    <table id="myTable" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th class="text-center">S/N</th>
                <th class="text-center">Service Day</th>
                <!-- <th class="text-center">Action</th> -->
            </tr>
        </thead>

        <tbody>
            <?php
            foreach ($rows as $result) {
                ?>
                <tr>
                    <td class="text-center"><?php echo $i ?></td>
                    <td class="text-center">
                        <?php
                        $date = strtotime($result['service_day']);
                        echo date('l, M j, Y', $date)
                        ?>
                    </td>
                    <!-- <td class="text-center">
                        <button type="button" name="update" id="<?php echo $result["id"] ?>" class="btn btn-primary update_services_attended">Edit</button>
                        <a href="#" class=" btn btn-danger" id="delete_service" data-id="<?php echo $result["id"]; ?>" href="javascript:void(0)">
                            Delete
                        </a>
                    </td> -->

                </tr>
                <?php $i++;
            } ?>
        </tbody>
    </table>
<?php } ?>