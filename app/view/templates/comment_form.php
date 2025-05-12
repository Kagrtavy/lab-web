<?php
/**
 * @var array $errors
 */
?>
<form action="" method="post">
    <div class="form-field">
        <label>
            Enter your name:
            <input type="text" name="username" value="<?= $_POST['username'] ?? '' ?>">
        </label>
        <?php if (array_key_exists('username', $errors)): ?>
            <div class="error-text"><?= $errors['username'] ?></div>
        <?php endif; ?>
    </div>

    <div class="form-field">
        <label>
            Rate this post:
            <select name="rate">
                <option disabled>Rate</option>
                <?php for ($i = 1; $i <= 5; $i++): ?>
                    <option value="<?= $i ?>" <?= (isset($_POST['rate']) && (int)$_POST['rate'] === $i) ? 'selected' : '' ?>><?= $i ?></option>
                <?php endfor; ?>
            </select>
        </label>
        <?php if (array_key_exists('rate', $errors)): ?>
            <div class="error-text"><?= $errors['rate'] ?></div>
        <?php endif; ?>
    </div>

    <div class="form-field">
        <label for="comment">Comment text:</label>
        <textarea id="comment" name="comment" cols="50" rows="10" wrap="hard"><?= $_POST['comment'] ?? '' ?></textarea>
        <?php if (array_key_exists('comment', $errors)): ?>
            <div class="error-text"><?= $errors['comment'] ?></div>
        <?php endif; ?>
    </div>

    <div class="button-box">
        <input type="submit" value="Submit" class="form-button">
    </div>
</form>
