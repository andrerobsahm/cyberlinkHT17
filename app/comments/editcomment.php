<?php
declare(strict_types=1);

require __DIR__.'/../autoload.php';

// In this file we edit comments in the database

if (isset($_POST['comment'])) {
    $comment = filter_var($_POST['comment'], FILTER_SANITIZE_STRING);
    $post_id = filter_var($_POST['post_id'], FILTER_SANITIZE_NUMBER_INT);

    $comment_id = $_POST['id'];
    $comment_date = date('F j, Y, g:i a');

    $editComment = $pdo->prepare("UPDATE comments SET comment = :comment, comment_date = :comment_date WHERE comment_id = :comment_id");

    $editComment->bindParam(':comment', $comment, PDO::PARAM_STR);
    $editComment->bindParam(':comment_date', $comment_date, PDO::PARAM_STR);
    $editComment->bindParam(':comment_id', $comment_id, PDO::PARAM_INT);
    $editComment->execute();



        if (!$editComment) {
            die(var_dump($pdo->errorInfo()));
        }

        redirect("/../../post.php?id=$post_id");
}

redirect('/');
