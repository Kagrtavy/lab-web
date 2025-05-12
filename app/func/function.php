<?php
const DS = DIRECTORY_SEPARATOR;
function getDbConnection(): mysqli
{
    static $conn = null;
    if ($conn === null) {
        $host = 'localhost';
        $user = 'root';
        $password = '';
        $dbname = 'lab-web';
        try {
            mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
            $conn = new mysqli($host, $user, $password, $dbname);
            $conn->set_charset("utf8mb4");
        } catch (mysqli_sql_exception $e) {
            http_response_code(500);
            die('Connection error: ' . $e->getMessage());
        }
    }
    return $conn;
}

function getPublications(): array
{
    $conn = getDbConnection();
    $sql = "SELECT a.id, a.title, a.content, a.image, a.created, u.name AS author, c.title AS category, 
    COUNT(cm.id) AS comment_count, ROUND(AVG(cm.rate), 1) AS average_rating FROM articles a JOIN users u ON a.user_id = u.id
    JOIN categories c ON a.category_id = c.id LEFT JOIN comments cm ON cm.article_id = a.id
    GROUP BY a.id, a.title, a.content, a.image, a.created, u.name, c.title ORDER BY a.created DESC";
    $result = $conn->query($sql);
    $publications = [];
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $publications[] = $row;
        }
    }
    return $publications;
}

function getPublicationById(int $id): ?array
{
    $conn = getDbConnection();
    $stmt = $conn->prepare("SELECT a.id, a.title, a.content, a.image, a.created, u.name AS author, c.title AS category
    FROM articles a JOIN users u ON a.user_id = u.id JOIN categories c ON a.category_id = c.id WHERE a.id = ? LIMIT 1");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $post = $result->fetch_assoc() ?: null;
    $stmt->close();
    return $post;
}

function addComment(int $articleId, string $author, string $rate, string $content): bool
{
    $conn = getDbConnection();
    $stmt = $conn->prepare("INSERT INTO comments (article_id, author, rate, content, created) VALUES (?, ?, ?, ?, NOW())");
    $stmt->bind_param("isss", $articleId, $author, $rate, $content);
    $success = $stmt->execute();
    $stmt->close();
    return $success;
}

function getCommentsById(int $articleId): array
{
    $conn = getDbConnection();
    $stmt = $conn->prepare("SELECT author, rate, content, created FROM comments WHERE article_id = ? ORDER BY created DESC");
    $stmt->bind_param("i", $articleId);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
}