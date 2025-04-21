<?php
require_once "app" . DIRECTORY_SEPARATOR. "func" . DIRECTORY_SEPARATOR . "function.php";
include "app" . DIRECTORY_SEPARATOR . "view" . DIRECTORY_SEPARATOR . "errors" . DIRECTORY_SEPARATOR . "400.php";
$id = (int) $_GET['id'];
$post = getPublicationById($id);
include "app" . DIRECTORY_SEPARATOR . "view" . DIRECTORY_SEPARATOR . "errors" . DIRECTORY_SEPARATOR . "404.php";
?>
<!DOCTYPE html>
<html lang="en">
    <?php require "app" . DIRECTORY_SEPARATOR. "view" . DIRECTORY_SEPARATOR . "templates" . DIRECTORY_SEPARATOR . "head.php"; ?>
    <body>
        <?php require "app" . DIRECTORY_SEPARATOR. "view" . DIRECTORY_SEPARATOR . "templates" . DIRECTORY_SEPARATOR . "header.php"; ?>
        <main>
            <?php require "app" . DIRECTORY_SEPARATOR . "view" . DIRECTORY_SEPARATOR . "templates" . DIRECTORY_SEPARATOR . "article.php"; ?>
        </main>
        <?php require "app" . DIRECTORY_SEPARATOR. "view" . DIRECTORY_SEPARATOR . "templates" . DIRECTORY_SEPARATOR . "footer.php"; ?>
    </body>
</html>