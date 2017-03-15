<?php ob_start();
$pagename = 'Logout';
require_once 'header.php';

$_SESSION['user_id'] = null;
$_SESSION['username'] = null;
//if(isset($_SESSION)) { session_abort(); }
session_start();
session_destroy();

echo 'You have successfully logged out.';

header('location:login.php');

require_once 'footer.php';

ob_flush(); ?>