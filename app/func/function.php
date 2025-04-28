<?php
function getDbConnection(): mysqli
{
    $host = 'localhost';
    $user = 'root';
    $password = '';
    $dbname = 'lab-web';
    $conn = new mysqli($host, $user, $password, $dbname);
    if ($conn->connect_error) {
        die('Connection error: ' . $conn->connect_error);
    }
    $conn->set_charset("utf8mb4");
    return $conn;
}

function getPublications(): array
{
    $conn = getDbConnection();
    $sql = "SELECT a.id, a.title, a.content, a.image, a.created, u.name AS author, c.title AS category
    FROM articles a JOIN users u ON a.user_id = u.id JOIN categories c ON a.category_id = c.id ORDER BY a.created DESC";
    $result = $conn->query($sql);
    $publications = [];
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $publications[] = $row;
        }
    }
    $conn->close();
    return $publications;
}

function getPublicationById(int $id): ?array
{
    $conn = getDbConnection();
    $stmt = $conn->prepare("SELECT a.id, a.title, a.content, a.image, a.created, u.name AS author, c.title AS category
    FROM articles a JOIN users u ON a.user_id = u.id JOIN categories c ON a.category_id = c.id WHERE a.id = ? LIMIT 1");
    if (!$stmt) {
        die('Error in preparing a request: ' . $conn->error);
    }
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $post = $result->fetch_assoc() ?: null;
    $stmt->close();
    $conn->close();
    return $post;
}