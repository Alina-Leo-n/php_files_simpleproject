<?php
$connection = new mysqli('localhost', 'blog', '40>IRnS[', 'blog');
if ($connection->connect_error)
    die("Ошибка подключения: " . $connection->connect_error);

$result = $connection->query("SELECT * FROM posts WHERE is_deleted = 0 ORDER BY created_at DESC");
?>
<!doctype html>
<div class="container py-4">
    <div class="row g-4"> 
        <?php if ($result->num_rows > 0): ?>
            <?php while ($post = $result->fetch_assoc()): ?>
                <div class="col-md-4"> 
                    <div class="card h-100 shadow-sm"> 
                        <svg class="bd-placeholder-img card-img-top" width="100%" height="200" xmlns="http://www.w3.org/2000/svg" role="img" preserveAspectRatio="xMidYMid slice">
                        <title><?= htmlspecialchars($post['title']) ?></title>
                        <rect width="100%" height="100%" fill="#55595c"></rect>
                        <text x="50%" y="50%" fill="#eceeef" dy=".3em"><?= mb_substr(htmlspecialchars($post['title']), 0, 20) ?></text>
                        </svg>
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title"><?= htmlspecialchars($post['title']) ?></h5>
                            <p class="card-text flex-grow-1">
                                <?= nl2br(htmlspecialchars(mb_substr($post['content'], 0, 100))) ?>...
                            </p>
                            <div class="mt-auto">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">

                                        <form action="deletepost.php" method="GET">
                                            <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                                            <input type="hidden" name="id" value="<?= $post['id'] ?>">
                                            <button type="submit" class="btn btn-outline-primary" >Удалить</button>
                                            <a href="/templates/form.php?id=<?= $post['id'] ?>" role="button" class="btn btn-primary">Править</a>
                                        </form></div>
                                    <small class="text-muted">
                                        <?= date('d.m.Y', strtotime($post['created_at'])) ?>
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <div class="col-12">
                <div class="alert alert-info">Пока нет ни одного поста.</div>
            </div>
        <?php endif;
        $connection->close();
        ?>
    </div>
</div>