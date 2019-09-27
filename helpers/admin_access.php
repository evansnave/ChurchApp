<?php
if ($_SESSION['role'] !== 'admin') {?>
    <script>window.history.back()</script>
<?php } ?>