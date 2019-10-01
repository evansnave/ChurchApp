<?php
session_start();
include_once "../operations/connection.php";
$date = (int) $_GET['date'];
$actual_date = date('Y-m-d', $date);
if ($_SESSION['role'] == 'cell_leader') {
    $cell_id = $_SESSION['cell_id'];
    $query = "SELECT * FROM first_timers WHERE firstTimer_status='active' AND date_added = '$actual_date' AND senior_cell = $cell_id ORDER BY fullname";
} else {
    $query = "SELECT * FROM first_timers WHERE firstTimer_status='active' AND date_added = '$actual_date' ORDER BY fullname";
}
$statement = $db->prepare($query);
$statement->execute();
$count = $statement->rowCount();
$rows = $statement->fetchAll(PDO::FETCH_ASSOC);
$i = 1;
if ($count == 0 && empty($rows)) {
    echo "<h3 class=\"text-center text-muted\">No First Timers Available</h3>";
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
                <th>Age</th>
                <th>Marital Status</th>
                <th>Occupation</th>
                <th>Invited By</th>
                <th>Inviters Contact</th>
                <th>Born Again</th>
                <th>When</th>
                <th>Membership</th>
                <th>If no why?</th>
                <th>Visitation</th>
                <th>If yes when</th>
                <th>Prayer Request</th>
                <th class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($rows as $result) {
                ?>
                <tr>
                    <td class="text-center"><?php echo $i ?></td>
                    <td><?php echo strtoupper($result['fullname']) ?></td>
                    <td><?php echo $result['phone_number'] ?></td>
                    <td><?php echo strtoupper($result['residence']) ?></td>
                    <td><?php echo strtoupper($result['gender']) ?></td>
                    <td><?php echo $result['age'] ?></td>
                    <td><?php echo strtoupper($result['marital_status']) ?></td>
                    <td><?php echo strtoupper($result['occupation']) ?></td>
                    <td><?php echo strtoupper($result['invited_by']) ?></td>
                    <td><?php echo $result['inviters_contact'] ?></td>
                    <td><?php echo strtoupper($result['born_again']) ?></td>
                    <td><?php echo strtoupper($result['born_again_when']) ?></td>
                    <td><?php echo strtoupper($result['membership']) ?></td>
                    <td><?php echo strtoupper($result['if_no_why']) ?></td>
                    <td><?php echo strtoupper($result['visitation']) ?></td>
                    <td><?php echo strtoupper($result['if_yes_when']) ?></td>
                    <td><?php echo strtoupper($result['prayer_request']) ?></td>
                    <td class="text-center">
                        <a href="report.php?token=<?= $result['id'] ?>" class="btn btn-primary"> Report</a>
                        <?php if ($_SESSION['role'] == 'admin') {?>
                            <a href="#" class=" btn btn-danger" id="delete_product" data-id="<?php echo $result["id"]; ?>" href="javascript:void(0)">
                                Delete
                            </a>
                        <?php }?>
                    </td>
                </tr>
                <?php $i++;
            } ?>
        </tbody>
    </table>
<?php } ?>
<script src="assets/js/datatables/datatables-init.js"></script>