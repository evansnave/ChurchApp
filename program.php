<?php
session_start();
include_once 'operations/connection.php';
include_once 'helpers/functions.php';
$date = $_GET['program'];
$program_date = date('Y-m-d', $date);
if (!nameOfProgram($db, $program_date)) {
    die('<h3 class="tex-center">Sorry... The page you are looking for is unavailable</h3>');
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <link rel="icon" href="assets/images/pci.jpg" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title><?= nameOfProgram($db, $program_date) ?></title>
</head>

<body>
    <div class="container" style="margin-top:100px">
        <div class="page-wrapper">
            <div id="alert"></div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header text-center">
                            <h4 class="text-muted"><?= nameOfProgram($db, $program_date) ?> (<i class="feather icon-calendar"></i> <?= date('l, M j, Y', $date) ?>)</h4>
                        </div>
                        <div class="card-block table-border-style">
                            <form method="post" id="invitee_form">
                                <div class="modal-content">
                                    <div class="text-center"><br>
                                        <h4 class="text-center"><i class="fa fa-plus"></i> Register your Invitees</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label>Name Of Invitee</label>
                                            <input type="text" name="name_of_invitee" id="name_of_invitee" class="form-control" required />
                                        </div>
                                        <div class="form-group">
                                            <label>Phone Number</label>
                                            <input type="number" name="phone_number" id="phone_number" class="form-control" required />
                                        </div>
                                        <div class="form-group">
                                            <label>Place Of Residence</label>
                                            <input type="text" name="residence" id="residence" class="form-control" required />
                                        </div>
                                        <?php if ($_SESSION['role'] != 'cell_leader') { ?>
                                        <div class="form-group">
                                            <label>Cell</label>
                                            <select name="cell" id="cell" class="form-control">
                                                <option></option>
                                                <?= listOfCells($db) ?>
                                            </select>
                                        </div>
                                        <?php } ?>

                                        <?php if ($_SESSION['role'] == 'cell_leader') { ?>
                                        <div class="form-group">
                                            <label>Cell</label>
                                            <input name="cell" id="cell" hidden value="<?= $_SESSION['cell_id'] ?>">
                                            <input value="<?= nameOfCell($db, $_SESSION['cell_id']) ?>" readonly class="form-control">
                                        </div>
                                        <?php } ?>
                                    </div>
                                    <div class="modal-footer ">
                                        <input type="hidden" name="id" id="id" />
                                        <input type="hidden" name="btn_action" id="btn_action" value="Add" />
                                        <input type="submit" name="action" id="action" class="btn btn-info" value="Add Invitee" />
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include_once "partials/_footer.php";
    ?>
    <script>
        $(document).ready(function() {
            $('#add_button').click(function() {
                $('#invitee_form')[0].reset();
                $('#action').val("Add Invitee");
                $('#btn_action').val("Add");
            });

            $(document).on('submit', '#invitee_form', function(event) {
                event.preventDefault();
                $('#action').attr('disabled', 'disabled');
                var form_data = $(this).serialize();
                $.ajax({
                    url: "operations/invitees.php?date=<?= $date ?>",
                    method: "POST",
                    data: form_data,
                    success: function(data) {
                        $('#invitee_form')[0].reset();
                        $('#alert').fadeIn().html(data);
                    }
                })
            });
        });
    </script>