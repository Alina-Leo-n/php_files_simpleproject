<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

//if (isset($_GET['success'])) {
//    echo '<div class="alert alert-success">Пост сохранен</div>';
//}

if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}



require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/header.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/menu.php';
?>
<body>
    <div class="container">
        <table class="table">
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-10"> 
                    <h1>Добавить новый пост</h1>
                    <form action="/action/savepost.php" method="post">
                        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                        <div class="form-group">
                            <label for="title">Заголовок</label>
                            <input type="text" class="form-control" id="title" placeholder="Введите имя поста..." name="title" required>
                        </div>
                        <div class="form-group">
                            <label for="content">Содержимое</label>
                            <textarea class="form-control" id="content" placeholder="Введите текст..." rows="15" name="content" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Отправить</button>
                    </form> 
                    <h2><a class="navbar-brand" href="/index.php">На главную </a></h2>
                </div>
            </div>
    </div>

</body>
