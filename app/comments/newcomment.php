<?php
declare(strict_types=1);

require __DIR__.'/../autoload.php';

// INSERT A NEW POST TO THE DATABASE
if (isset($_POST['comment'])) {
    $add_comment = filter_var($_POST['comment'], FILTER_SANITIZE_STRING);

    $user_id = $_SESSION['user']['id'];
    $post_id = $_POST['post_id'];
    $comment_date = date("F j, Y, g:i a");

    $newComment = $pdo->prepare("INSERT INTO comments (user_id, post_id, comment, comment_date) VALUES (:user_id, :post_id, :comment, :comment_date)");

    $newComment->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $newComment->bindParam(':post_id', $post_id, PDO::PARAM_INT);
    $newComment->bindParam(':comment', $add_comment, PDO::PARAM_STR);
    $newComment->bindParam(':comment_date', $comment_date, PDO::PARAM_STR);
    $newComment->execute();

        if (!$newComment) {
            die(var_dump($pdo->errorInfo()));
        }
}

redirect("/../../post.php?id=$post_id");
