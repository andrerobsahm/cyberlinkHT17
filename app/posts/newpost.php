<?php
declare(strict_types=1);

require __DIR__.'/../autoload.php';

// In this file we make new posts in the database.

// NEW POST
if (isset($_POST['title'], $_POST['link'])) {
    $post_title = filter_var($_POST['title'], FILTER_SANITIZE_STRING);
    $post_link = filter_var($_POST['link'], FILTER_SANITIZE_STRING);
    $user_id = $_SESSION['user']['id'];
    $post_date = date("F j, Y, g:i a");

    $newPost = $pdo->prepare('INSERT INTO posts (title, link, user_id, post_date) VALUES (:title, :link, :user_id, :post_date)');

    $newPost->bindParam(':title', $post_title, PDO::PARAM_STR);
    $newPost->bindParam(':link', $post_link, PDO::PARAM_STR);
    $newPost->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $newPost->bindParam(':post_date', $post_date, PDO::PARAM_STR);
    $newPost->execute();

        if (!$newPost) {
            die(var_dump($pdo->errorInfo()));
        }
}


redirect('/');
