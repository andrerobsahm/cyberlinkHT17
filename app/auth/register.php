<?php
declare(strict_types=1);
require __DIR__.'/../autoload.php';

if (isset($_POST['name'], $_POST['username'], $_POST['email'], $_POST['password'])) {

    $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $password = filter_var($_POST['password']);
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $registerUser = $pdo->prepare("INSERT INTO users(name, username, email, password) VALUES (:name, :username, :email, :password)");

        if (!$registerUser) {
            die(var_dump($pdo->errorInfo()));
        }

    $registerUser->bindParam(':name', $name, PDO::PARAM_STR);
    $registerUser->bindParam(':username', $username, PDO::PARAM_STR);
    $registerUser->bindParam(':email', $email, PDO::PARAM_STR);
    $registerUser->bindParam(':password', $hashed_password, PDO::PARAM_STR);

    $registerUser->execute();

    redirect('../../login.php');
}
