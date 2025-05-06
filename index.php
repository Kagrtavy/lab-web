<?php
require_once "app" . DIRECTORY_SEPARATOR. "func" . DIRECTORY_SEPARATOR . "function.php";
$publications = getPublications();
foreach ($publications as &$post) {
    $post['comment_count'] = getCommentCountById($post['id']);
    $post['average_rating'] = getAverageRating($post['id']);
}
unset($post);
?>
<!DOCTYPE html>
<html lang="en">
    <?php require "app" . DIRECTORY_SEPARATOR. "view" . DIRECTORY_SEPARATOR . "templates" . DIRECTORY_SEPARATOR . "head.php"; ?>
    <body>
        <?php require "app" . DIRECTORY_SEPARATOR. "view" . DIRECTORY_SEPARATOR . "templates" . DIRECTORY_SEPARATOR . "header.php"; ?>
        <main>
            <?php foreach ($publications as $post): ?>
                <?php require "app" . DIRECTORY_SEPARATOR . "view" . DIRECTORY_SEPARATOR . "templates" . DIRECTORY_SEPARATOR . "article.php"; ?>
            <?php endforeach; ?>
        </main>
        <?php require "app" . DIRECTORY_SEPARATOR. "view" . DIRECTORY_SEPARATOR . "templates" . DIRECTORY_SEPARATOR . "footer.php"; ?>
    </body>
</html>