<?php ob_start();
$pagename = 'Delete Page';
require_once 'header.php';

require_once 'db.php';

try {
    $query = 'DELETE FROM pages WHERE id=:id';
    $result = $conn->prepare($query);
    $result->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
    $result->execute();

    header('Location: pages.php');
} catch(PDOException $e) {
    echo 'An error occurred with the database: '.$e->getMessage();
} catch(Exception $e) {
    echo 'An error occurred: '.$e->getMessage();
} finally {
    $conn = null;
}

?>

<?php require_once 'footer.php'; ob_flush(); ?>