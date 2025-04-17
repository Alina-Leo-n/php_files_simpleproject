<?php
session_start();
if (empty($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
    die("Ошибка безопасности: неверный CSRF-токен");
}

$host = 'localhost';
$user = 'blog';
$password = '40>IRnS[';
$database = 'blog';

$connection = new mysqli($host, $user, $password, $database);

if ($connection->connect_error) {
    die("Ошибка подключения: " . $connection->connect_error);
}

$_SESSION['form_data'] = $_POST;

$errors = [];
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $errors[] = "Данные должны быть отправлены методом POST";
}

if (empty($_POST['title'])) {
    $errors[] = "Заполните заголовок";
} elseif (strlen(trim($_POST['title'])) > 255) {
    $errors[] = "Заголовок слишком длинный, максимум 255 символов";
}

if (empty($_POST['content'])) {
    $errors[] = "Заполните тело поста";
} elseif (strlen(trim($_POST['content'])) > 1500) {
    $errors[] = "Тело поста слишком длинное";
}

if (!empty($errors)) {
    echo "<h2>присутствуют ошибки валидации:</h2>";
    echo "<ul>";
    foreach ($errors as $error) {
        echo "<li>$error</li>";
    }
    echo "</ul>";
    echo '<a href="/templates/form.php">Вернуться к форме</a>';
    exit();
}

$id = $_POST['id'] ?? null;
$title = $connection->real_escape_string($_POST['title']);
$content = $connection->real_escape_string($_POST['content']);

if ($id) {
    // если редактирование
    $stmt = $connection->prepare("UPDATE posts SET title=?, content=?, updated_at=NOW() WHERE id=?");
    $stmt->bind_param("ssi", $title, $content, $id);
} else {
    // если оздание
    $stmt = $connection->prepare("INSERT INTO posts (title, content) VALUES (?, ?)");
    $stmt->bind_param("ss", $title, $content);
}

if ($stmt->execute()) {     // Выполнение запроса
    header("Location: index.php");
    exit();
} else {
    $_SESSION['errors'] = ["Ошибка базы данных: " . $connection->error];
    header("Location: " . ($id ? 'savepost.php?id='.$id : 'savepost.php'));
}
$stmt->close();
$conn->close();
?>