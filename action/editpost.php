<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

$connection = new mysqli('localhost', 'blog', '40>IRnS[', 'blog');
$csrf_token = $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
?>

<form action="updatepost.php" method="post">
    <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">
    <!-- поля формы редактирования -->
    <label for="titlename">Заголовок</label>
                        <input type="text" class="form-control" id="titlename" aria-describedby="emailHelp" placeholder="Введите имя поста..." name="title" value="<?php echo $newsItem['title'] ?? ''; ?>">
                    </div>
                    <div class="form-group">
                        <label for="content">Содержимое</label>
                        <textarea class="form-control" id="content" placeholder="Введите текст..." rows="15" name="text"><?php echo $newsItem['text'] ?? ''; ?></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Отправить</button>
</form>