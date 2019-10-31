<?php 
    include_once "operations/connection.php";
    $member_id = $_GET['child'];
    $query = "SELECT * FROM child_dedication WHERE member_id = $member_id ";
    $statement = $db->prepare($query);
    $statement->execute();
    $count = $statement->rowCount();
    $rows = $statement->fetch(); 
    $i= 1;
    include_once "partials/header.php";
    include_once 'helpers/admin_access.php';
    include_once 'helpers/functions.php';
?>
<style>
p{
    font-size:18px
}
</style>
<div class="pcoded-main-container">
    <div class="pcoded-wrapper">
        <div class="pcoded-content">
            <div class="pcoded-inner-content">
                <div class="main-body">
                    <div class="page-wrapper">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card p-5 ">
                                    <?php if(empty($rows)) {
                                        echo "<h3 class=\"text-center text-muted\">No Records Found </h3>";
                                        } else {?>
                                        <div id='print'>
                                            <h4 class="text-muted text-center">INFANT DEDICATION FORM</h4>
                                            <fieldset class="border p-3 mb-5" style="line-height:30px;">
                                                <legend class="w-auto">CHILD BIO</legend>
                                                <p>
                                                    <span>NAME OF CHILD:</span>
                                                    <span> <?= $rows['child_name'] ?></span>
                                                </p>
                                                <p>
                                                    <span>DATE OF BIRTH:</span>
                                                    <span><?= $rows['dob'] ?></span>
                                                </p>
                                                <p>
                                                    <span>GENDER:</span>
                                                    <span><?= $rows['gender'] ?></span>
                                                </p>
                                                <p>
                                                    <span>AGE:</span>
                                                    <span><?= $rows['age'] ?></span>
                                                </p>
                                                <p>
                                                        <span>PLACE OF BIRTH:</span>
                                                        <span><?= $rows['pob'] ?></span>
                                                </p>   
                                            </fieldset>

                                            <fieldset class="border p-3 mb-5" style="line-height:30px; font-size:18px">
                                                <legend class="w-auto">FATHER'S BIO</legend>
                                                <p>
                                                        <span>FATHER'S NAME:</span>
                                                        <span><?= $rows['fathers_name'] ?></span>
                                                </p>
                                                <p>
                                                        <span>FATHER'S CHURCH:</span>
                                                        <span><?= $rows['fathers_church'] ?></span>
                                                </p>
                                                <p> 
                                                        <span>FATHER'S DEPARTMENT:</span>
                                                        <span><?= $rows['f_department'] ?></span> 
                                                </p>
                                                <p>
                                                        <span>FAMILY (CELL):</span>
                                                                <span><?= nameOfCell($db,$rows['m_cell']) ?></span>
                                                </p>
                                                <p>
                                                        <span>DATE BORN AGAIN:</span>
                                                        <span><?= $rows['fdba'] ?></span>
                                                 </p>
                                                <p>
                                                        <span>FATHER'S ADDRESS:</span>
                                                        <span><?= $rows['f_address'] ?></span>
                                                </p>
                                                <p>
                                                        <span>NATIONALITY:</span>
                                                        <span><?= $rows['f_nationality'] ?></span>
                                                </p>
                                                <p>
                                                        <span>PHONE NUMBER:</span>
                                                        <span><?= $rows['phone_number'] ?></span>
                                                </p>
                                            </fieldset>

                                            <fieldset class="border p-3" style="line-height:30px; font-size:18px">
                                                <legend class="w-auto">MOTHER'S BIO</legend>
                                                <p>
                                                        <span>MOTHER'S NAME:</span>
                                                        <span><?= $rows['mothers_name'] ?></span>
                                                </p>
                                                <p>
                                                        <span>MOTHER'S CHURCH:</span>
                                                        <span><?= $rows['mothers_church'] ?></span>
                                                </p>
                                                <p>
                                                        <span>DEPARTMENT:</span>
                                                        <span><?= $rows['m_department'] ?></span>
                                                </p>
                                                <p>
                                                        <span>FAMILY (CELL):</span>
                                                        <span><?= nameOfCell($db,$rows['m_cell']) ?></span>
                                                </p>
                                                <p>
                                                        <span>DATE BORN AGAIN:</span>
                                                        <span><?= $rows['mdba'] ?></span>
                                                </p>
                                                <p>
                                                        <span>MOTHER'S ADDRESS:</span>
                                                        <span><?= $rows['m_address'] ?></span>
                                                </p>
                                                <p>
                                                        <span>NATIONALITY:</span>
                                                        <span><?= $rows['m_nationality'] ?></span>
                                                </p>
                                                <p>
                                                        <span>PHONE NUMBER:</span>
                                                        <span><?= $rows['m_phone_number'] ?></span>
                                                </p>
                                                <p>
                                                        <span>MARITAL STATUS:</span>
                                                        <span><?= $rows['marital_status'] ?></span>
                                                </p>
                                            </fieldset>
                                        </div>
                                        <input type='button' id='btn' value='Print' class="btn btn-primary" onclick='printData();'>
                                    <?php } ?>
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
<script src="assets/js/datatables/datatables-init.js"></script>
<script>
    function printData()
{
   var divToPrint=document.getElementById("print");
   newWin= window.open("");
   newWin.document.write(divToPrint.outerHTML);
   newWin.print();
   newWin.close();
}

$('button').on('click',function(){
printData();
})
</script>