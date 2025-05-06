<?php
function validateCommentForm(string $author, string $rate, string $content): array
{
    $errors = [];
    if (mb_strlen($author) < 1 || mb_strlen($author) > 50) {
        $errors['username'] = 'Name must be between 1 and 50 characters.';
    }
    if (!in_array($rate, ['1', '2', '3', '4', '5'])) {
        $errors['rate'] = 'Invalid rating value.';
    }
    if (mb_strlen($content) < 1 || mb_strlen($content) > 200) {
        $errors['comment'] = 'Comment must be between 1 and 200 characters.';
    }
    return $errors;
}