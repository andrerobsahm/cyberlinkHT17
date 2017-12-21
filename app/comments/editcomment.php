<?php
declare(strict_types=1);

require __DIR__.'/../autoload.php';

// In this file we edit comments in the database


// EDIT YOUR COMMENT
if (isset($_POST['comment'])) {

    $comment = filter_var($_POST['comment'], FILTER_SANITIZE_STRING);
    $comment_id = $_POST['post_id'];

    $editComment = $pdo->prepare("UPDATE comments SET comment = :comment, comment_date = :comment_date WHERE comment_id = :comment_id");

    $comment_date = date("F j, Y, g:i a");

    $editComment->bindParam(':comment', $comment, PDO::PARAM_STR);
    $editComment->bindParam(':comment_date', $comment_date, PDO::PARAM_STR);
    $editComment->bindParam(':comment_id', $comment_id, PDO::PARAM_INT);
    $editComment->execute();

        if (!$editComment) {
            die(var_dump($pdo->errorInfo()));
        }
}


redirect("/../../post.php?id=$comment_id");
