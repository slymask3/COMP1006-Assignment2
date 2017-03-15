<?php ob_start();
$pagename = 'Save';
require_once 'header.php';

require_once 'db.php';

try {
    $query = 'UPDATE users SET username=:username, is_admin=:isadmin WHERE user_id=:id';
    $result = $conn->prepare($query);
    $result->bindParam(':username', $_POST['username'], PDO::PARAM_STR, 30);
    $result->bindParam(':isadmin', $_POST['isadmin'], PDO::PARAM_INT);
    $result->bindParam(':id', $_POST['id'], PDO::PARAM_INT);
    $result->execute();

    header('Location: admins.php');
} catch(PDOException $e) {
    echo 'An error occurred with the database: '.$e->getMessage();
} catch(Exception $e) {
    echo 'An error occurred: '.$e->getMessage();
} finally {
    $conn = null;
}

?>

<?php require_once 'footer.php'; ob_flush(); ?>