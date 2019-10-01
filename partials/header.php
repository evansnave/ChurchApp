<?php
session_start();
if (!isset($_SESSION['username'])) {
   echo '<script> window.location.href = "operations/logout.php";</script>'; 
}
include_once "_head.php";
include_once "_sidebar.php";
include_once "_navigation.php";
include_once "helpers/end_attendance.php";
