<?php ob_start();
$pagename = 'Administrators';
require_once 'header.php';

require_once 'auth.php';
require_once 'auth-admin.php';

require_once 'db.php';

try {
    $query = 'SELECT * FROM users';
    $result = $conn->prepare($query);
    $result->execute();
    $table = $result->fetchAll();

    echo '<table class="table table-striped">';
    echo '<thead>';
    echo '<th>User ID</th>';
    echo '<th>Username</th>';
    echo '<th>Type</th>';
    echo '<th>Edit</th>';
    echo '<th>Delete</th>';
    echo '</thead>';
    echo '<tbody>';
    foreach($table as $user) {
        echo '<tr>';
        echo '<td>'.$user['user_id'].'</td>';
        echo '<td>'.$user['username'].'</td>';
        echo '<td>'.($user['is_admin'] == 1 ? 'Admin' : 'Member').'</td>';
        echo '<td>';
        echo '<a href="edit-user.php?user_id='.$user['user_id'].'" class="btn btn-warning">Edit</a>';
        echo '</td>';
        echo '<td>';
        echo '<a href="delete-user.php?user_id='.$user['user_id'].'" class="btn btn-danger" onclick="return confirm(\'Are you sure you want to delete '.$user['username'].'\'s account?\')">Delete</button>';
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

<?php require_once 'footer.php'; ob_flush(); ?>