<?php
error_reporting(E_ALL);
session_start();
ini_set('display_errors', 1);
if (!empty($_GET['act']) && $_GET['act'] == 'login') {
    require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/login.php';
    die();
}
if (empty($_SESSION['login'])) {
    header('Location: /admin/?act=login');
    die();
}
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
       
</table>
                <form method="post" action="">
                    <input type="hidden" name="id" value="<?php echo $newsItem['id'] ?? 0 ; ?>"/>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Title</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter title" name="title" value="<?php echo $newsItem['title'] ?? ''; ?>">
                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else. да да да</small>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Тело новости????</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="15" name="text"><?php echo $newsItem['text'] ?? ''; ?></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Отправить</button>
                </form>          
            </div> <!-- /container -->
        </main>

        <footer class="container">
            <p>&copy; Cumpany 2024-2025</p>
        </footer>

        <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="/js/bootstrap.min.js"></script>

    </body>
</html>
