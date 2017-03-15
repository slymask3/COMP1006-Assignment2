<?php
// access the current session
if (empty($_SESSION['user_id'])) {
    header('location:login.php');
    exit();
}
?>