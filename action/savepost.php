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

$errors = [];
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $errors[] = "Данные должны быть отправлены методом POST";
}

if (empty($_POST['title'])) {
    $errors[] = "Заполните заголовок";
} elseif (strlen(trim($_POST['title'])) > 255) {
    $errors[] = "Заголовок слишком длинный (максимум 255 символов)";
}

if (empty($_POST['content'])) {
    $errors[] = "Заполните тело поста";
} elseif (strlen(trim($_POST['content'])) > 1500) {
    $errors[] = "Содержимое слишком длинное";
}

if (!empty($errors)) {
    echo "<h2>присутствуют ошибки валидации:</h2>";
    echo "<ul>";
    foreach ($errors as $error) {
        echo "<li>$error</li>";
    }
    echo "</ul>";
    echo '<a href="/admin/form.php">Вернуться к форме</a>';
    exit();
}

$title = $connection->real_escape_string($_POST['title']);
$content = $connection->real_escape_string($_POST['content']);

$stmt = $connection->prepare("INSERT INTO posts (title, content) VALUES (?, ?)");
$stmt->bind_param("ss", $title, $content); // ss значит здесь будут 2 стринги

if ($stmt->execute()) {
    header("Location: form.php");
    exit();
} 
    else {
    echo "Ошибка: " . $stmt->error;
}

$_SESSION['csrf_token'] = bin2hex(random_bytes(32));

$stmt->close();
$connection->close();

?>