<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once 'config.php';
session_start();

$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

//    if (!empty(@$_GET['act']) && @$_GET['act'] == 'news') {
//    require_once $_SERVER['DOCUMENT_ROOT'] . '/modules/news.php';
//    die();
//    }
//$news = [];
//require_once $_SERVER['DOCUMENT_ROOT'] . '/modules/readnews.php';


require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/header.php';
?>
    <body>
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/menu.php'; ?>
        

        <main role="main">
            <div class="jumbotron">
                <div class="container">
                    <h1 class="display-3">Новости из мира животных</h1>
                    <p>и да, я не Дроздов.</p>
                    <p><a class="btn btn-primary btn-lg" href="/templates/buttonlink.php" role="button">не надо жмать на эту кнопку, она не работает &raquo;</a></p>
                </div>
            </div>
<?=require_once $_SERVER['DOCUMENT_ROOT'] . '/action/readposts.php';?>
            <div class="container">
                <!-- Example row of columns -->
<!--                <div class="row">
                    <?php foreach ($news as $item): ?>
                        <div class="col-md-4">
                            <h2><?= $item['title'] ?></h2>
                            <p><?= mb_substr($item['text'], 0, 100) ?></p>
                            <p><a class="btn btn-secondary" href="/?act=news&id=<?= $item['id'] ?>" role="button">Жмяк &raquo;</a></p>
                        </div>
                    <?php endforeach ?>
                </div>-->

                <hr>

            </div> <!-- /container -->

        </main>
       <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="/js/bootstrap.min.js"></script>
    </body>
</html>
