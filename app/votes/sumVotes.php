<?php
declare(strict_types=1);
require __DIR__.'/../autoload.php';

// SHOW SUM OF VOTES ON CERTAIN POST
$post_id = (int)$_POST['post_id'];

$statement = $pdo->prepare("SELECT sum(vote_dir) AS score FROM votes WHERE post_id=:post_id");
$statement->bindParam(':post_id', $post_id, PDO::PARAM_INT);
$statement->execute();
$score = $statement->fetch(PDO::FETCH_ASSOC);

    if (!$statement) {
    die(var_dump($pdo->errorInfo()));
    }

echo json_encode($score);
