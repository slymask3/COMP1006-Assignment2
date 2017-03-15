<?php ob_start();
session_start(); ?>

<!DOCTYPE html>
<html>
<head>
    <title>Assignment 2 - <?php echo $pagename ?></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="stylesheet.css">
</head>
<body>

<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">Assignment 2</a>
        </div>
        <ul class="nav navbar-nav navbar-left">
            <?php
            $conn = new PDO('mysql:host=sql.computerstudi.es;dbname=gc200287553', 'gc200287553', 'UV2!F*Lh');
            $query = 'SELECT * FROM pages';
            $result = $conn->prepare($query);
            $result->execute();
            $table = $result->fetchAll();
            foreach($table as $page) {
                echo '<li '.((empty($_GET['page'])?1:$_GET['page']) == $page['id'] ? ' class="active"' : '').' ><a href="default.php?page='.$page['id'].'">'.$page['title'].'</a></li>';
            }
            $conn = null;
            ?>
            <?php if(!empty($_SESSION) && $_SESSION['is_admin']) { ?>
                <li<?php echo ($pagename == 'Administrators' ? ' class="active"' : '') ?>><a href="admins.php">Administrators</a></li>
                <li<?php echo ($pagename == 'Pages' ? ' class="active"' : '') ?>><a href="pages.php">Pages</a></li>
            <?php } else { ?>
            <?php } ?>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <?php if(!empty($_SESSION['user_id'])) { ?>
            <li<?php echo ($pagename == 'Logout' ? ' class="active"' : '') ?>><a href="logout.php">Logout</a></li>
            <?php } else { ?>
                <li<?php echo ($pagename == 'Login' ? ' class="active"' : '') ?>><a href="login.php">Login</a></li>
                <li<?php echo ($pagename == 'Register' ? ' class="active"' : '') ?>><a href="register.php">Register</a></li>
            <?php } ?>
        </ul>
    </div>
</nav>

<div class="container">
    <?php echo ($pagename=='Default'?'':'<h2>'.$pagename.'</h2>') ?>
    <?php ob_flush(); /*var_dump($_SESSION);*/?>