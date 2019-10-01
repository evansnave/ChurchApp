<?php
session_start();
include_once "../operations/connection.php";
include_once '../helpers/functions.php';
$department_id =$_GET['department'];
$query = "SELECT * FROM members WHERE member_status='active' AND department = $department_id ORDER BY fullname";
$statement = $db->prepare($query);
$statement->execute();
$count = $statement->rowCount();
$rows = $statement->fetchAll(PDO::FETCH_ASSOC);
$i = 1;
if ($count == 0 && empty($rows)) {
    echo "<h3 class=\"text-center text-muted\">Please add a Member </h3>";
} else {
    ?>
    <table id="example23" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th class="text-center">S/N</th>
                <th>Name</th>
                <th>Phone Number</th>
                <th>Residence</th>
                <th>Gender</th>
                <th>Marital Status</th>
                <th>Occupation</th>
                <th>Foundation School</th>
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
                        <?php echo strtoupper($result['title'] . " " . $result['fullname']) ?>
                    </td>
                    <td><?php echo $result['phone_number'] ?></td>
                    <td><?php echo strtoupper($result['residence']) ?></td>
                    <td><?php echo strtoupper($result['gender']) ?></td>
                    <td><?php echo strtoupper($result['marital_status']) ?></td>
                    <td><?php echo strtoupper($result['occupation']) ?></td>
                    <td><?php echo strtoupper($result['foundation_school']) ?></td>
                    <td><?php echo strtoupper($result['baptism']) ?></td>
                    <td><?php echo strtoupper($result['dob']) ?></td>
                    <td><?php echo strtoupper($result['year_joined']) ?></td>
                    <td class="text-center">
                        <button type="button" name="update" id="<?php echo $result["id"] ?>" class="btn btn-primary update">Edit</button>
                        <?php if($_SESSION['role'] == 'admin'){?>
                        <a href="#" class=" btn btn-danger" id="delete_product" data-id="<?php echo $result["id"]; ?>" href="javascript:void(0)">
                            Delete
                        </a>
                        <?php } ?>
                    </td>
                </tr>
                <?php $i++;
            } ?>
        </tbody>
    </table>
<?php } ?>
<script src="assets/js/datatables/datatables-init.js"></script>