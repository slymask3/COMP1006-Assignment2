<?php ob_start();
$pagename = 'Edit Page';
require_once 'header.php';

require_once 'auth.php';
require_once 'auth-admin.php';

require_once 'db.php';

try {
    $query = 'SELECT * FROM pages WHERE id=:id';
    $result = $conn->prepare($query);
    $result->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
    $result->execute();
    $table = $result->fetchAll();

    if($result->rowCount() > 0) {
        $page = $table[0];
        ?>

        <form method="post" action="save-page.php">
            <input type="hidden" name="id" value="<?php echo $page['id'] ?>" />
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" name="title" value="<?php echo $page['title'] ?>" />
            </div>
            <div class="form-group">
                <label for="content">Content:</label>
                <textarea name="content" cols="50" rows="6"><?php echo $page['content'] ?></textarea>
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