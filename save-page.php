<?php ob_start();
$pagename = 'Save Page';
require_once 'header.php';

require_once 'db.php';

try {
    $query = 'UPDATE pages SET title=:title, content=:content WHERE id=:id';
    $result = $conn->prepare($query);
    $result->bindParam(':title', $_POST['title'], PDO::PARAM_STR, 100);
    $result->bindParam(':content', $_POST['content'], PDO::PARAM_STR, 10000);
    $result->bindParam(':id', $_POST['id'], PDO::PARAM_INT);
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