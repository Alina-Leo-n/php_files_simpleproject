<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
$error = '';
    var_dump($_POST);
if (!empty($_POST['email']) && !empty($_POST['password'])) {
    if ($_POST['email'] == 'alina17102001@gmail.ru' && $_POST['password'] == 'qwe') {
        $_SESSION['login'] = 'alina17102001@gmail.ru';
        header('Location: /admin/');     
        die();
    } else {
        $error = 'неверный логин или пароль';
    }
}
require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/header.php';
?>
<body>

    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/menu.php'; ?>

    <main role="main">

        <div class="jumbotron">


            <div class="container">
                <!-- Example row of columns -->
                <?= $error ?>
                <form action="" method="post">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email">
                        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="password" class="form-control" id="exampleInputPassword1" name="password">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>   
                <hr>

            </div> <!-- /container -->

    </main>

    <footer class="container">
        <p>&copy; Company of shrex instructors</p>
    </footer>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="/js/bootstrap.min.js"></script>
</body>
</html>
