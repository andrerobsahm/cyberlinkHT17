<?php
declare(strict_types=1);
require __DIR__.'/../autoload.php';

if (isset($_POST['username'], $_POST['email'], $_POST['password'])) {
    $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

    $statement = $pdo->prepare("SELECT * FROM users WHERE email = :email AND username = :username");
    $statement->bindParam(':email', $email, PDO::PARAM_STR);
    $statement->bindParam(':username', $username, PDO::PARAM_STR);
    $statement->execute();

    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }
    $user = $statement->fetch(PDO::FETCH_ASSOC);


    // If user doesn't exist, redirect back to login page
    if (!$user) {
        redirect('../../login.php');
    }

    //Check if password is correct
    if (password_verify($_POST['password'], $user['password'])){
        unset($user['password']);
        $_SESSION['user'] = $user;
    }
    else {
        redirect('../../login.php');
    }
}

redirect('/profile.php');
