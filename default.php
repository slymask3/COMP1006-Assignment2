<?php
$pagename = 'Default';
require_once 'header.php';
require_once 'db.php';

$pageid = 1;
if(!empty($_GET['page'])) {
    $pageid = $_GET['page'];
}

$query = 'SELECT * FROM pages WHERE id=:id';
$result = $conn->prepare($query);
$result->bindParam(':id', $pageid, PDO::PARAM_INT);
$result->execute();
$table = $result->fetchAll();

if($result->rowCount() > 0) {
    $pagetitle = $table[0]['title'];
    $pagecontent = $table[0]['content'];
} else {
    $pagetitle = '404';
    $pagecontent = 'Page not found.';
}

?>

<h2><?php echo $pagetitle ?></h2>
<p><?php echo $pagecontent ?></p>

<?php require_once 'footer.php'; ?>