<?php ob_start();
$pagename = 'Add Page';
require_once 'header.php';

require_once 'db.php';

try {
    $query = 'SELECT * FROM pages WHERE title=:title';
    $result = $conn->prepare($query);
    $result->bindParam(':title', $_POST['title'], PDO::PARAM_STR, 100);
    $result->execute();

    if($result->rowCount() == 0) {
        $query = 'INSERT INTO pages (title, content) VALUES (:title, :content)';
        $result = $conn->prepare($query);
        $result->bindParam(':title', $_POST['title'], PDO::PARAM_STR, 100);
        $result->bindParam(':content', $_POST['content'], PDO::PARAM_STR, 10000);
        $result->execute();

        echo 'You have successfully added a new page!';
    } else {
        echo 'The title \''.$_POST['title'].'\' is already in use.';
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