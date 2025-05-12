<?php
require_once "app" . DIRECTORY_SEPARATOR. "func" . DIRECTORY_SEPARATOR . "function.php";
require_once "app" . DIRECTORY_SEPARATOR . "func" . DIRECTORY_SEPARATOR . "validate.php";
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
$comments = getCommentsById($id);
$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $rate = $_POST['rate'] ?? '';
    $comment = trim($_POST['comment'] ?? '');
    $errors = validateCommentForm($username, $rate, $comment);
    if (count($errors) === 0) {
        addComment($id, $username, $rate, $comment);
        header("Location: publication.php?id=" . $id);
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
    <?php require "app" . DS. "view" . DS . "templates" . DS . "head.php"; ?>
    <body>
        <?php require "app" . DS. "view" . DS . "templates" . DS . "header.php"; ?>
        <main>
            <?php require "app" . DS . "view" . DS . "templates" . DS . "article.php"; ?>
            <div class="form-box">
                <?php require "app" . DS . "view" . DS . "templates" . DS . "comment_form.php"; ?>
            </div>
            <div class="comment-box">
                <?php require "app" . DS . "view" . DS . "templates" . DS . "comments.php"; ?>
            </div>
        </main>
        <?php require "app" . DS. "view" . DS . "templates" . DS . "footer.php"; ?>
    </body>
</html>