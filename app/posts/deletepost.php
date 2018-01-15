<?php
declare(strict_types=1);
require __DIR__.'/../autoload.php';

$post_id = $_GET['id'];
$deletePost = $pdo->prepare("DELETE FROM posts WHERE post_id = :post_id");

    if (!$deletePost) {
      die(var_dump($pdo->errorInfo()));
    }

$deletePost->bindParam(':post_id', $post_id, PDO::PARAM_INT);
$deletePost->execute();

redirect('/index.php');
