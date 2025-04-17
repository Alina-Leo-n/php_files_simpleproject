<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

$host = 'localhost';
$user = 'blog';
$password = '40>IRnS[';
$database = 'blog';

$connection = new mysqli($host, $user, $password, $database);
if ($connection->connect_error) {
    die("Ошибка подключения: " . $connection->connect_error);
}
// Загружаем пост, если есть айди
$post = [];
$title = '';
$content = '';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $stmt = $connection->prepare("SELECT * FROM posts WHERE id = ? AND is_deleted = 0 ORDER BY created_at DESC");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $post = $result->fetch_assoc();
        $title = $post['title'];
        $content = $post['content'];
    }
}

require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/header.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/menu.php';
?>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-10"> 
                <h1><?php echo isset($post['id']) ? 'Редактировать пост' : 'Добавить новый пост'; ?></h1>
                <form action="/action/savepost.php" method="post">
                    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                    <input type="hidden" name="id" value="<?php echo $post['id'] ?? 0; ?>" />

                    <div class="form-group">
                        <label for="title">Заголовок</label>
                        <input type="text" class="form-control" id="title" name="title"
                               placeholder="Введите имя поста..." value="<?php echo htmlspecialchars($title); ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="content">Содержимое</label>
                        <textarea class="form-control" id="content" name="content"
                                  rows="15" placeholder="Введите текст..."><?php echo htmlspecialchars($content); ?></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Отправить</button>
                </form>
            </div>
        </div>
    </div>
</body>