<?php if (!empty($comments)): ?>
    <h3>Comments:</h3>
    <?php foreach ($comments as $comment): ?>
        <div class="comment-item">
            <strong><?= $comment['author'] ?></strong>
            <span>rated it <?= (int)$comment['rate'] ?>/5</span><br>
            <p><?= nl2br($comment['content']) ?></p>
            <small><?= date('F j, Y, H:i', strtotime($comment['created'])) ?></small>
        </div>
    <?php endforeach; ?>
<?php else: ?>
    <p>No comments yet.</p>
<?php endif; ?>