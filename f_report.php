<?php 
include_once "operations/connection.php";
$from = $_REQUEST['from'];
$to = $_REQUEST['to'];
$type_of_report = $_REQUEST['type_of_report'];
$query = "SELECT * FROM $type_of_report WHERE date_entered >= '$from' AND date_entered <= '$to' ORDER BY  date_entered ";
$statement = $db->prepare($query);
$statement->execute();
$count = $statement->rowCount();
$i= 1;
$total_amount = 0;
$rows = $statement->fetchAll(PDO::FETCH_ASSOC); 
include_once "partials/header.php";
include_once 'helpers/admin_access.php';
include_once 'helpers/functions.php';
?>
<div class="pcoded-main-container">
    <div class="pcoded-wrapper">
        <div class="pcoded-content">
            <div class="pcoded-inner-content">
                <div class="main-body">
                    <div class="page-wrapper">
                        <div id="alert"></div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card">
                                    <div class="row card-header">
                                        <div class="col-md-6 text-left">
                                            <h4 class="text-muted">Financial Report</h4>
                                        </div>
                                    </div>
                                    <div class="card-block table-border-style">
                                        <div class="table-responsive">
                                        <?php  if (empty($rows)) {
                                                echo "<h3 class=\"text-center text-muted\">No Records Found </h3>";
                                            } else {
                                                ?>
                                                <table id="example23" class="table table-hover table-striped table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center">#</th>
                                                            <th>Date</th>
                                                            <th>Accountant</th>
                                                            <th>Type</th>
                                                            <th class="text-center">Amount</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($rows as $results) { ?>
                                                            <tr>
                                                                <th class="text-center" scope="row"><?= $i ?></th>
                                                                <td><?= simpleDate(strtotime($results['date_entered'])) ?> </td>
                                                                <td><?= $results['accountant_name'] ?> </td>
                                                                <td><?php 
                                                                    switch ($_REQUEST['type_of_report']) {
                                                                        case 'offerings':
                                                                            echo $results['offering_type'];                                                                            
                                                                        break;
                                                                        case 'fundraising':
                                                                            echo $results['fundraising_type'];
                                                                        break;
                                                                        default:
                                                                            echo $_REQUEST['type_of_report'];
                                                                        break;
                                                                    }
                                                                ?> </td>
                                                                <td class="text-center"><?= 'GH¢ '.number_format($results['amount'],2) ?> </td>
                                                            </tr>

                                                            <?php
                                                                $total_amount += $results['amount']; 
                                                                $i++;
                                                            } ?>
                                                    </tbody>
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center">#</th>
                                                            <th></th>
                                                            <th></th>
                                                            <th class="text-center">TOTAL</th>
                                                            <th class="text-center"><?= 'GH¢ '. number_format($total_amount,2) ?></th>
                                                        </tr>
                                                    </thead>
                                                </table>
                                            <?php } ?>
                                            <script src="assets/js/datatables/datatables-init.js"></script>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include_once "partials/_footer.php"; ?>
