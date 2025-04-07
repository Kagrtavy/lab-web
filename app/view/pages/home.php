<?php
include_once 'app' . DIRECTORY_SEPARATOR . 'func' . DIRECTORY_SEPARATOR . 'function.php';
$publications = getPublications();
?>

<?php foreach ($publications as $post): ?>
    <article class="article-box">
        <img src="/images/<?= $post['image'] ?>" alt="<?= $post['title'] ?>" class="article-photo">
        <div class="article-wrap">
            <header>
                <div class="category">In <span><?= $post['category'] ?></span></div>
                <h2 class="about-article">
                    <a href="?page=publication&id=<?= $post['id'] ?>">
                    <?= $post['title'] ?>
                    </a>
                </h2>
                <div class="author">
                    <?= $post['author'] ?> -
                    <time datetime="<?= $post['created'] ?>">
                        <?= date('F j, Y', strtotime($post['created'])) ?>
                    </time>
                </div>
            </header>
            <div class="content">
                <p><?= mb_strimwidth($post['content'], 0, 200, '...') ?></p>
            </div>
        </div>
    </article>
<?php endforeach; ?>