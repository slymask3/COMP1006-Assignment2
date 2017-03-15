<?php ob_start();
$pagename = 'Pages';
require_once 'header.php';

require_once 'auth.php';
require_once 'auth-admin.php';

require_once 'db.php';

try {
    $query = 'SELECT * FROM pages';
    $result = $conn->prepare($query);
    $result->execute();
    $table = $result->fetchAll();

    echo '<table class="table table-striped">';
    echo '<thead>';
    echo '<th>Page ID</th>';
    echo '<th>Title</th>';
    echo '<th>Edit</th>';
    echo '<th>Delete</th>';
    echo '</thead>';
    echo '<tbody>';
    foreach($table as $page) {
        echo '<tr>';
        echo '<td>'.$page['id'].'</td>';
        echo '<td>'.$page['title'].'</td>';
        echo '<td>';
        echo '<a href="edit-page.php?id='.$page['id'].'" class="btn btn-warning">Edit</a>';
        echo '</td>';
        echo '<td>';
        echo '<a href="delete-page.php?id='.$page['id'].'" class="btn btn-danger" onclick="return confirm(\'Are you sure you want to delete this page?\')">Delete</button>';
        echo '</td>';
        echo '</tr>';
    }
    echo '</tbody>';
    echo '</table>';

} catch(PDOException $e) {
    echo 'An error occurred with the database: '.$e->getMessage();
} catch(Exception $e) {
    echo 'An error occurred: '.$e->getMessage();
} finally {
    $conn = null;
}
?>

<a href="add-page.php" class="btn btn-success">Add Page</a>

<?php require_once 'footer.php'; ob_flush(); ?>