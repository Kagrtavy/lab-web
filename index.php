<?php
require_once "app" . DIRECTORY_SEPARATOR. "func" . DIRECTORY_SEPARATOR . "function.php";
$publications = getPublications();
unset($post);
?>
<!DOCTYPE html>
<html lang="en">
    <?php require "app" . DS. "view" . DS . "templates" . DS . "head.php"; ?>
    <body>
        <?php require "app" . DS . "view" . DS . "templates" . DS . "header.php"; ?>
        <main>
            <?php foreach ($publications as $post): ?>
                <?php require "app" . DS . "view" . DS . "templates" . DS . "article.php"; ?>
            <?php endforeach; ?>
        </main>
        <?php require "app" . DS . "view" . DS . "templates" . DS . "footer.php"; ?>
    </body>
</html>