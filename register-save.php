<?php ob_start();
$pagename = 'Register';
require_once 'header.php';

require_once 'db.php';

try {
    $query = 'SELECT * FROM users WHERE username=:username';
    $result = $conn->prepare($query);
    $result->bindParam(':username', $_POST['username'], PDO::PARAM_STR, 30);
    $result->execute();

    if($result->rowCount() == 0) {
        if($_POST['password'] == $_POST['confirm']) {
            $hashedpassword = hash('sha512', $_POST['password']);
            $query = 'INSERT INTO users (username, password, is_admin) VALUES (:username, :password, 1)'; //Register the user as an Admin for now.
            $result = $conn->prepare($query);
            $result->bindParam(':username', $_POST['username'], PDO::PARAM_STR, 30);
            $result->bindParam(':password', $hashedpassword, PDO::PARAM_STR, 128);
            $result->execute();

            echo 'You have successfully registered!';
        } else {
            echo 'The passwords do not match.';
        }
    } else {
        echo 'The username \''.$_POST['username'].'\' is already taken.';
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