<?php
declare(strict_types=1);

require __DIR__.'/../autoload.php';

$user_id = $_GET['id'];

// Deleting comments
$deleteUser = $pdo->prepare("DELETE FROM comments WHERE user_id = :id");
$deleteUser->bindParam(':id', $user_id, PDO::PARAM_INT);
$deleteUser->execute();

// Deleting posts
$deleteUser = $pdo->prepare("DELETE FROM posts WHERE user_id = :id");
$deleteUser->bindParam(':id', $user_id, PDO::PARAM_INT);
$deleteUser->execute();

//Deleting votes
$deleteUser = $pdo->prepare("DELETE FROM votes WHERE user_id = :id");
$deleteUser->bindParam(':id', $user_id, PDO::PARAM_INT);
$deleteUser->execute();


//Deleting user
$deleteUser = $pdo->prepare("DELETE FROM users WHERE id = :id");
$deleteUser->bindParam(':id', $user_id, PDO::PARAM_INT);
$deleteUser->execute();

if (!$deleteUser) {
    die(var_dump($pdo->errorInfo()));
}

session_destroy();

redirect('/');
