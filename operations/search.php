<style>
    .bg {
        background-color: white;
        padding: 20px;
        text-align: center;
    }

    li {
        list-style: none;
    }
</style>
<?php
include_once "connection.php";

$search_data = strip_tags($_POST['search_data']);
if (strlen($search_data) >= 2) {
    $search = "SELECT * FROM first_timers WHERE fullname LIKE :search_data AND firstTimer_status = 'active' ";
    $statement = $db->prepare($search);
    $statement->bindValue(':search_data', '%' . $search_data . '%', PDO::PARAM_STR);
    $statement->execute();
    $count = $statement->rowCount();
    if ($count >= 1) {
        while ($data = $statement->fetch()) { ?>
            <div class="main-body bg">
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8 col-sm-12">
                        <table class="table table-hover">
                            <tbody>
                                <tr>
                                    <td><?= $data['fullname'] ?></td>
                                    <td><?= $data['phone_number'] ?></td>
                                    <td><?= $data['residence'] ?></td>
                                    <td>
                                        <a href="report.php?token=<?= $data['id'] ?>" class="label theme-bg text-white f-12">View</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
<?php }
    } else { ?>
<div class="bg">
    <ul class="pro-body">
        <li class="nav-item"><?= $search_data ?> not found in our records</li>
    </ul>
</div>
<?php }
}
