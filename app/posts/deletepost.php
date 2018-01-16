<?php
declare(strict_types=1);
require __DIR__.'/../autoload.php';

$post_id = $_GET['id'];

//Here we delete the post. We also delete the comments and votes associated with the post so that we don't leave any orphaned data in the database
$deletePost = $pdo->prepare("DELETE FROM comments WHERE post_id = :post_id");
$deletePost->bindParam(':post_id', $post_id, PDO::PARAM_INT);
$deletePost->execute();

$deletePost = $pdo->prepare("DELETE FROM votes WHERE post_id = :post_id");
$deletePost->bindParam(':post_id', $post_id, PDO::PARAM_INT);
$deletePost->execute();

$deletePost = $pdo->prepare("DELETE FROM posts WHERE post_id = :post_id");
$deletePost->bindParam(':post_id', $post_id, PDO::PARAM_INT);
$deletePost->execute();

	if (!$deletePost) {
		die(var_dump($pdo->errorInfo()));
	}

redirect('/index.php');
