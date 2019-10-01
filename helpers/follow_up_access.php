<?php
$user_role = $_SESSION['role'];
if ($user_role != 'cell_leader' && $user_role != 'admin' && $user_role != 'follow_up') { ?>
    <script>
        window.history.back()
    </script>
<?php } ?>