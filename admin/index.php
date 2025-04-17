<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
//if (!empty($_GET['act']) && $_GET['act'] == 'login') { //* переход на страницу со входом в админку. сейчас ввод логина и пароля не нужен, все могут редактировать все посты*/
//    require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/login.php';
//    die();
//}
//if (empty($_SESSION['login'])) {
//    header('Location: /admin/?act=login');
//    die();
//}
require_once $_SERVER['DOCUMENT_ROOT'] . '/modules/readnews.php';
if (!empty($_GET['act']) && $_GET['act'] == 'edit') {
    $id = (float)$_GET['id'];
    $contentItem = file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/". $id . '.txt');
    $newsItem = unserialize($contentItem);
    /** @var array $news */
}
if (!empty($_POST['title']) && !empty($_POST['text']) && !empty($_POST['id'])) {
    $id = (float)$_POST['id'];
    
    $data = [
        'id' => $id,
        'title' => $_POST['title'],
        'text' => $_POST['text'],
    ];
    /** @var type $data */
    $data = serialize($data);
     $file_put_contents = file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/data/' . $id . '.txt', $data);
    header('Location: /admin');
    die();
} elseif (!empty($_POST['title']) && !empty($_POST['text'])) {
    $files = scandir($_SERVER['DOCUMENT_ROOT'] . '/data');
    $i = 1;
    foreach ($files as $file) {
        if ($file == '.' || $file == '..') {
            continue;
        }
        $i++;
         }
    
    $data = [
        'id' => $i,
        'title' => $_POST['title'],
        'text' => $_POST['text'],
    ];
    $data = serialize($data);
    $file_put_contents = file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/data/' . $i . '.txt', $data);
    header('Location: /admin');
    die();
}
   
require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/header.php';
?>
    <body>

        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/menu.php'; ?>

        <main role="main">
            <div class="container">
                <table class="table">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Title</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
       <?php foreach ($news as $item): ?>
    <tr>
      <th scope="row"><?=$item['id']?></th>
      <td><?=$item['title']?></td>
      <td><a href="/admin/?act=edit&id=<?=$item['id']?>">Edit</a></td>
          </tr>
    <tr>
         <?php endforeach ?>
    </tbody>

                <form method="Post" action="">
                    <input type="hidden" name="id" value="<?php echo $newsItem['id'] ?? 0 ; ?>"/>
                    <div class="form-group">
                        <label for="titlename">Заголовок</label>
                        <input type="text" class="form-control" id="titlename"  placeholder="Введите имя поста..." name="title" value="<?php echo $newsItem['title'] ?? ''; ?>">
                    </div>
                    <div class="form-group">
                        <label for="content">Содержимое</label>
                        <textarea class="form-control" id="content" placeholder="Введите текст..." rows="15" name="text"><?php echo $newsItem['text'] ?? ''; ?></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Отправить</button>
                </form>   
    
    
            </div> <!-- /container -->
        <footer class="container">
            <p>&copy; Cumpany форева</p>
        </footer>
         <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="/js/bootstrap.min.js"></script>

    </body>
</html>
