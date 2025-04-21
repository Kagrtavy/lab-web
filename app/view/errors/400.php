<?php
if (!isset($_GET['id']) || !is_numeric($_GET['id']) || (int)$_GET['id'] <= 0) {
    http_response_code(400);
    echo "<h1>400 — Invalid request</h1>";
    exit;
}