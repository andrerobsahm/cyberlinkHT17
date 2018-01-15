<?php
declare(strict_types=1);
require __DIR__.'/../autoload.php';

$comment_id = $_GET['id'];

// Here we get the post id from the comment we're removing to enable a redirect back to the current post
$getPostId = $pdo->prepare("SELECT post_id FROM comments WHERE comment_id = :comment_id");
$getPostId->bindParam(':comment_id', $comment_id, PDO::PARAM_INT);
$getPostId->execute();
$post_id = $getPostId->fetch(PDO::FETCH_ASSOC);

//DELETING THE COMMENT
$deleteComment = $pdo->prepare("DELETE FROM comments WHERE comment_id = :comment_id");

    if (!$deleteComment) {
      die(var_dump($pdo->errorInfo()));
    }

$deleteComment->bindParam(':comment_id', $comment_id, PDO::PARAM_INT);
$deleteComment->execute();

redirect("/../../post.php?id=".$post_id['post_id']);
