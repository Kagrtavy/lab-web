<?php
include_once 'app' . DIRECTORY_SEPARATOR . 'func' . DIRECTORY_SEPARATOR . 'function.php';

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
$post = getPublicationById($id);
?>

<?php if ($post): ?>
    <article class="article-box">
        <header>
            <div class="category">In <span><?= $post['category'] ?></span></div>
            <h2 class="about-article"><?= $post['title'] ?></h2>
            <img src="/images/<?= $post['image'] ?>" alt="<?= $post['title'] ?>" class="article-photo">
        </header>
        <div class="content">
            <p><?= nl2br($post['content']) ?></p>
        </div>
        <footer>
            <p>Author: <?= $post['author'] ?></p>
            <p>
                Published at <time datetime="<?= $post['created'] ?>">
                    <?= date('F j, Y H:i', strtotime($post['created'])) ?>
                </time>
            </p>
        </footer>
    </article>
<?php else: ?>
    <p>Publication not found.</p>
<?php endif; ?>