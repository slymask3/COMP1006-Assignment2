<?php ob_start();
$pagename = 'Edit User';
require_once 'header.php';

require_once 'auth.php';
require_once 'auth-admin.php';

require_once 'db.php';

try {
    $query = 'SELECT * FROM users WHERE user_id=:user_id';
    $result = $conn->prepare($query);
    $result->bindParam(':user_id', $_GET['user_id'], PDO::PARAM_INT);
    $result->execute();
    $table = $result->fetchAll();

    if($result->rowCount() > 0) {
        $user = $table[0];
        ?>

        <form method="post" action="save-user.php">
            <input type="hidden" name="id" value="<?php echo $user['user_id'] ?>" />
            <div class="form-group">
                <label for="username">Email:</label>
                <input type="text" name="username" value="<?php echo $user['username'] ?>" />
            </div>
            <div class="form-group">
                <label for="isadmin">Type:</label>
                <select name="isadmin">
                    <option value="0" <?php echo $user['is_admin']==0?'selected':'' ?>>Member</option>
                    <option value="1" <?php echo $user['is_admin']==1?'selected':'' ?>>Admin</option>
                </select>
            </div>
            <div class="form-group">
                <input type="submit" value="Save" class="btn btn-primary" />
            </div>
        </form>

        <?php
    }

} catch(PDOException $e) {
    echo 'An error occurred with the database: '.$e->getMessage();
} catch(Exception $e) {
    echo 'An error occurred: '.$e->getMessage();
} finally {
    $conn = null;
}
?>

<?php require_once 'footer.php'; ob_flush(); ?>