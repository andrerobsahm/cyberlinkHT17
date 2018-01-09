<?php
declare(strict_types=1);

require __DIR__.'/../autoload.php';

// In this file we update posts in the database.

if (isset($_POST['title'], $_POST['link'], $_POST['description'])) {
    $post_title = filter_var($_POST['title'], FILTER_SANITIZE_STRING);
    $post_link = filter_var($_POST['link'], FILTER_SANITIZE_URL);
    $post_description = filter_var($_POST['description'], FILTER_SANITIZE_STRING);
    $post_id = filter_var($_POST['post_id'], FILTER_SANITIZE_NUMBER_INT);

    $editPost = $pdo->prepare("UPDATE posts SET title = :title, link = :link, description = :description WHERE post_id = :post_id");

    $editPost->bindParam(':title', $post_title, PDO::PARAM_STR);
    $editPost->bindParam(':link', $post_link, PDO::PARAM_STR);
    $editPost->bindParam(':description', $post_description, PDO::PARAM_STR);
    $editPost->bindParam(':post_id', $post_id, PDO::PARAM_INT);
    // $editPost->bindParam(':post_date', $post_date, PDO::PARAM_STR);
    $editPost->execute();

        if (!$editPost) {
            die(var_dump($pdo->errorInfo()));
        }
}


redirect("/../../post.php?id=$post_id");
