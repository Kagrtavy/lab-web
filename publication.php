<?php
require_once "app" . DIRECTORY_SEPARATOR. "func" . DIRECTORY_SEPARATOR . "function.php";
if (!isset($_GET['id']) || !is_numeric($_GET['id']) || (int)$_GET['id'] <= 0) {
    http_response_code(400);
    echo "<h1>400 — Invalid request</h1>";
    exit;
}
$id = (int)$_GET['id'];
$post = getPublicationById($id);
if (!$post) {
    http_response_code(404);
    echo "<h1>404 — Publication not found</h1>";
    exit;
}
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