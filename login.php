<?php
$pagename = 'Login';
require_once 'header.php';
?>

<form method="post" action="login-save.php" class="form-horizontal">
    <div class="form-group">
        <label for="username" class="col-sm-2">Username:</label>
        <input type="email" name="username" required/>
    </div>
    <div class="form-group">
        <label for="password" class="col-sm-2">Password:</label>
        <input type="password" name="password" required/>
    </div>
    <div class="col-sm-offset-2">
        <input type="submit" value="Login" class="btn btn-primary" />
    </div>
</form>

<?php require_once 'footer.php'; ?>