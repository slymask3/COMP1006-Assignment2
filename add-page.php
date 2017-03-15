<?php
$pagename = 'Add Page';
require_once 'header.php';
?>

<form method="post" action="add-page-save.php" class="form-horizontal">
    <div class="form-group">
        <label for="title" class="col-sm-2">Title:</label>
        <input type="text" name="title" required/>
    </div>
    <div class="form-group">
        <label for="content" class="col-sm-2">Content:</label><br>
        <textarea name="content" cols="50" rows="6"></textarea>
    </div>
    <div class="col-sm-offset-2">
        <input type="submit" value="Save" class="btn btn-primary" />
    </div>
</form>

<?php require_once 'footer.php'; ?>