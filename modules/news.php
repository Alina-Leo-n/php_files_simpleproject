<?php
$id = (int)$_GET['id'];
$content = file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/". $id . '.txt');
$news = unserialize($content);
require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/header.php';
?>
     <body>

        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/menu.php'; ?>

        <main role="main">

            <div class="jumbotron">
                <div class="container">
                    <h1 id=$i class="display-3">Новость №  <?=$id?></h1>
                    <p>и да, я не Дроздов.</p>
                    <p><a class="btn btn-primary btn-lg" href="/templates/buttonlink.php" role="button">не надо жмать на эту кнопку, она не работает &raquo;</a></p>
                </div>
            </div>

            <div class="container">
                <!-- Example row of columns -->
                <div class="row">
                    <h1><?=$news['title']?></h1>
                    <p>
                       <?=$news['text']?>  
                    </p>
                    
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
