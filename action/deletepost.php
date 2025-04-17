<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

$host = 'localhost';
$user = 'blog';
$password = '40>IRnS[';
$database = 'blog';
$connection = new mysqli('localhost', 'blog', '40>IRnS[', 'blog');

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id > 0) {
        $stmt = $connection->prepare("UPDATE posts SET is_deleted = 1 WHERE id = ?");
        $stmt->bind_param("i", $id);
            
        if ($stmt->execute()) {
            $_SESSION['success'] = "Пост перемещен в корзину";
        } else {
            $_SESSION['error'] = "Ошибка: " . $connection->error;
        }
        
        $stmt->close();
        $connection->close();
}

header("Location: " . ($_SERVER['HTTP_REFERER'] ?? '/'));
exit();