<?php
error_reporting(E_ALL);
session_start();

echo 'ewwww<br/>';
    if (!empty(@$_GET['act']) && @$_GET['act'] == 'news') {
    require_once $_SERVER['DOCUMENT_ROOT'] . '/modules/news.php';
    die();
    }
$news = [];
require_once $_SERVER['DOCUMENT_ROOT'] . '/modules/readnews.php';

require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/header.php';
?>
    <body>
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/menu.php'; ?>
        

        <main role="main">

            <!-- Main jumbotron for a primary marketing message or call to action -->
            <div class="jumbotron">
                <div class="container">
                    <h1 class="display-3">Новости из мира животных</h1>
                    <p>и да, я не Дроздов.</p>
                    <p><a class="btn btn-primary btn-lg" href="/templates/buttonlink.php" role="button">не надо жмать на эту кнопку, она не работает &raquo;</a></p>
                </div>
            </div>

            <div class="container">
                <!-- Example row of columns -->
                <div class="row">
                    <?php foreach ($news as $item): ?>
                        <div class="col-md-4">
                            <h2><?= $item['title'] ?></h2>
                            <p><?= mb_substr($item['text'], 0, 200) ?></p>
                            <p><a class="btn btn-secondary" href="/?act=news&id=<?= $item['id'] ?>" role="button">Жмяк &raquo;</a></p>
                        </div>
                    <?php endforeach ?>
                </div>

                <hr>

            </div> <!-- /container -->

        </main>

        <footer class="container">
            <p>&copy; Company of shrex instructors</p>
        </footer>

        <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="/js/bootstrap.min.js"></script>
    </body>
</html>
