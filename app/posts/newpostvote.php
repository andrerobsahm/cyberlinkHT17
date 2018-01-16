<?php
declare(strict_types=1);
require __DIR__.'/../autoload.php';

//ADD A NEW VOTE WHEN A POST IS MADE, WITH A DEFAULT VALUE OF 0.
$latestPost = lastNewPost($pdo);
  $id = (int)$_SESSION['user']['id'];
  $post_id = $latestPost['post_id'];

  $statement = $pdo->prepare("INSERT INTO votes (post_id, user_id, vote_dir) VALUES (:post_id, :id, 0)");

      if (!$statement) {
        die(var_dump($pdo->errorInfo()));
      }

  $statement->bindParam(':id', $id, PDO::PARAM_INT);
  $statement->bindParam(':post_id', $post_id, PDO::PARAM_INT);
  $statement->execute();

  redirect('/');
