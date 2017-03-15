<?php ob_start();
$pagename = 'Delete';
require_once 'header.php';

require_once 'db.php';

try {
    $query = 'DELETE FROM users WHERE user_id=:id';
    $result = $conn->prepare($query);
    $result->bindParam(':id', $_GET['user_id'], PDO::PARAM_INT);
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