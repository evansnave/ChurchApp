<?php
if ($_SESSION['role'] != 'admin' OR $_SESSION['role'] != 'official') { ?>
    <script>
        window.history.back()
    </script>
<?php } ?>