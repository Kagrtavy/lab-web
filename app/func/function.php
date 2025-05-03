<?php
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
    $sql = "SELECT a.id, a.title, a.content, a.image, a.created, u.name AS author, c.title AS category
    FROM articles a JOIN users u ON a.user_id = u.id JOIN categories c ON a.category_id = c.id ORDER BY a.created DESC";
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
    if (!$stmt) {
        die('Error in preparing a request: ' . $conn->error);
    }
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $post = $result->fetch_assoc() ?: null;
    $stmt->close();
    return $post;
}