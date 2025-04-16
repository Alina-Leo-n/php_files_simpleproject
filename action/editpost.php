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
</form>