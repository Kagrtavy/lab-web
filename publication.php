<?php
require_once "app" . DIRECTORY_SEPARATOR. "func" . DIRECTORY_SEPARATOR . "function.php";
require_once "app" . DIRECTORY_SEPARATOR . "func" . DIRECTORY_SEPARATOR . "validate.php";
if (!isset($_GET['id']) || !is_numeric($_GET['id']) || (int)$_GET['id'] <= 0) {
    http_response_code(400);
    die('400 — Invalid request');
}
$id = (int)$_GET['id'];
$post = getPublicationById($id);
if (!$post) {
    http_response_code(404);
    die('404 — Publication not found');
}
$comments = getCommentsById($id);
$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'username' => trim($_POST['username'] ?? ''),
        'rate' => $_POST['rate'] ?? '',
        'comment'  => trim($_POST['comment'] ?? '')
    ];
    $errors = validateCommentForm($data);

    $isAjax = !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
    if (count($errors) === 0) {
        addComment($id, $data);
        $comments = getCommentsById($id);
        if ($isAjax) {
            ob_start();
            require "app" . DS . "view" . DS . "templates" . DS . "comments.php";
            echo ob_get_clean();
            exit;
        } else {
            header("Location: publication.php?id=" . $id);
            exit;
        }
    } else if ($isAjax) {
        ob_start();
        require "app" . DS . "view" . DS . "templates" . DS . "comment_form.php";
        echo ob_get_clean();
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
    <script>
        $(document).ready(function () {
            $('form').on('submit', function (e) {
                e.preventDefault();
                const form = $(this);
                const formData = form.serialize();

                $.ajax({
                    type: 'POST',
                    url: '',
                    data: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    success: function (response) {
                        if ($(response).filter('.comment-item').length > 0 || $(response).find('.comment-item').length > 0) {
                            $('.comment-box').html(response);
                            form.trigger('reset');
                            $('.error-text').remove();
                        } else {
                            $('.form-box').html(response);
                        }
                    },
                    error: function () {
                        alert('An error occurred while submitting the comment.');
                    }
                });
            });
        });
    </script>
</html>