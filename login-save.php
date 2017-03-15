<?php ob_start();
$pagename = 'Login';
require_once 'header.php';

try {
    require_once 'db.php';

    $query = 'SELECT * FROM users WHERE username=:username';
    $result = $conn->prepare($query);
    $result->bindParam(':username', $_POST['username'], PDO::PARAM_STR, 30);
    $result->execute();

    if($result->rowCount() > 0) {
        $query = 'SELECT * FROM users WHERE username=:username AND password=:password';
        $result = $conn->prepare($query);
        $result->bindParam(':username', $_POST['username'], PDO::PARAM_STR, 30);
        $result->bindParam(':password', hash('sha512', $_POST['password']), PDO::PARAM_STR, 128);
        $result->execute();

        if($result->rowCount() > 0) {
            $row = $result->fetchAll()[0];
            //if(!isset($_SESSION)) { session_start(); }
            session_start();
            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['username'] = $row['username'];
//            if($row['is_admin'] == 1) {
//                $_SESSION['is_admin'] = true;
//            } else {
//                $_SESSION['is_admin'] = false;
//            }
            $_SESSION['is_admin'] = ($row['is_admin'] == 1 ? true : false);

            var_dump($_SESSION);

            echo 'You have successfully logged in.';

            header('location:default.php');
        } else {
            echo 'The password is incorrect.';
        }
    } else {
        echo 'The username \''.$_POST['username'].'\' doesn\'t exist.';
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