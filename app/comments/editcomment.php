<?php
declare(strict_types=1);

require __DIR__.'/../autoload.php';

// In this file we make new posts in the database.

// NEW POST
if (isset($_POST['comment'])) {
    $add_comment = filter_var($_POST['comment'], FILTER_SANITIZE_STRING);

    $user_id = $_SESSION['user']['id'];
    $post_id = $_GET['id'];
    $comment_date = date("F j, Y, g:i a");

    $newPost = $pdo->prepare("INSERT INTO comments (user_id, post_id, comment, comment_date) VALUES (:user_id, :post_id, :comment, :comment_date)");

    $newPost->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $newPost->bindParam(':post_id', $post_id, PDO::PARAM_INT);
    $newPost->bindParam(':comment', $add_comment, PDO::PARAM_STR);
    $newPost->bindParam(':comment_date', $comment_date, PDO::PARAM_STR);
    $newPost->execute();

        if (!$newPost) {
            die(var_dump($pdo->errorInfo()));
        }
}

// EDIT YOUR COMMENT
if (isset($_POST['comment'])) {
    $comment = filter_var($_POST['comment'], FILTER_SANITIZE_STRING);

    $editComment = $pdo->prepare("UPDATE comments SET comment=:comment, comment_date=:comment_date WHERE id=:id");

    $id = $_SESSION['user']['id'];
    $comment_date = date("F j, Y, g:i a");

    $editComment->bindParam(':id', $id, PDO::PARAM_INT);
    $editComment->bindParam(':comment', $comment, PDO::PARAM_STR);
    $editComment->bindParam(':comment_date', $comment_date, PDO::PARAM_STR);
    $editComment->execute();

        if (!$editComment) {
            die(var_dump($pdo->errorInfo()));
        }
}


redirect("/../../post.php?id=$post_id");
