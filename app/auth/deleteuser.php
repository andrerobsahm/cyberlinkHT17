<?php
declare(strict_types=1);

require __DIR__.'/../autoload.php';

$user_id = $_GET['id'];
$deleteUser = $pdo->prepare("DELETE FROM users WHERE id = :id");

    if (!$deleteUser) {
      die(var_dump($pdo->errorInfo()));
    }

$deleteUser->bindParam(':id', $user_id, PDO::PARAM_INT);
$deleteUser->execute();

unset($_SESSION['user']);

redirect('/');
