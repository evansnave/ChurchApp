<?php
include_once "../operations/connection.php";
include_once "../helpers/functions.php";
$query = "SELECT * FROM teens where member_status = 'active' ORDER BY fullname";
$statement = $db->prepare($query);
$statement->execute();
$count = $statement->rowCount();
$rows = $statement->fetchAll(PDO::FETCH_ASSOC);
$i = 1;
if ($count == 0 && empty($rows)) {
    echo "<h3 class=\"text-center text-muted\">Please add a Teen </h3>";
} else {
    ?>
<table id="example23" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th class="text-center">S/N</th>
            <td>Picture</td>
            <th>Name</th>
            <th>Guardians Name</th>
            <th>Phone Number</th>
            <th>Residence</th>
            <th>Gender</th>
            <th>Age</th>
            <th>Baptism</th>
            <th>Date Of Birth</th>
            <th>Year Joined</th>
            <th class="text-center">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
            foreach ($rows as $result) {
                ?>
        <tr>
            <td class="text-center"><?php echo $i ?></td>
            <td>
                <img class="rounded-circle m-r-10" style="width:40px;" src="assets/images/user/avatar-4.jpg" alt="activity-user">

            </td>
            <td>
                <?php echo strtoupper($result['title'] . " " . $result['fullname']) ?>
            </td>
            <td><?php echo $result['guardian_name'] ?></td>
            <td><?php echo $result['phone_number'] ?></td>
            <td><?php echo strtoupper($result['residence']) ?></td>
            <td><?php echo strtoupper($result['gender']) ?></td>
            <td><?php echo $result['age'] ?></td>
            <td><?php echo strtoupper($result['baptism']) ?></td>
            <td><?php echo strtoupper($result['dob']) ?></td>
            <td><?php echo strtoupper($result['year_joined']) ?></td>
           
            
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