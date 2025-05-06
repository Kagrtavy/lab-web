<article class="article-box">
    <img src="/images/<?= $post['image'] ?>" alt="<?= $post['title'] ?>" class="article-photo">
    <div class="article-wrap">
        <header>
            <div class="category">In <span><?= $post['category'] ?></span></div>
            <h2 class="about-article">
                <a href="../../../publication.php?id=<?= $post['id'] ?>">
                    <?= $post['title'] ?>
                </a>
            </h2>
            <div class="author">
                <?= $post['author'] ?> -
                <time datetime="<?= $post['created'] ?>">
                    <?= date('F j, Y', strtotime($post['created'])) ?>
                </time>
                <?php if (isset($post['comment_count'])): ?>
                    <span class="comment-count">
                        <?= $post['comment_count'] ?> comment<?= $post['comment_count'] !== 1 ? 's' : '' ?>
                    </span>
                <?php endif; ?>
                <?php if (isset($post['average_rating'])): ?>
                    <div class="average-rating">
                        Rating: <?= $post['average_rating'] ?>/5
                    </div>
                <?php endif; ?>
            </div>
        </header>
        <div class="content">
            <p><?= mb_strimwidth($post['content'], 0, 200, '...') ?></p>
        </div>
    </div>
</article>