<?php
// access the current session
if (!$_SESSION['is_admin']) {
    header('location:default.php');
    exit();
}
?>