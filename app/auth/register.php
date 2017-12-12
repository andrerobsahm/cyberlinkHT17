<?php
declare(strict_types=1);
require __DIR__.'/../autoload.php';
// In this file we register users.
// 1. Check if the email and password exists in the request.
// 2. Fetch and sanitize the email address value and store it in an variable called $email.
// 3. Fetch the user in the database by the given email address.
// 4. If the user wasn't found in the database, redirect the user back to the login page.
// 5. If the user was found in the database, verify the password from the request against the one in the database.
// 6. If the password was valid, store the user's id, name and email in a session variable called user.
// 7. Redirect the user back to the start page.


if (isset($_POST['name'], $_POST['username'], $_POST['email'], $_POST['password'])) {

    $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
    $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $password = filter_var($_POST['password']);

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);


    $registerUser = $pdo->prepare("INSERT INTO users(username, name, email, password) VALUES (:name, :username, :email, :password)");

        if (!$registerUser) {
            die(var_dump($pdo->errorInfo()));
        }

    $registerUser->bindParam(':username', $username, PDO::PARAM_STR);
    $registerUser->bindParam(':name', $name, PDO::PARAM_STR);
    $registerUser->bindParam(':email', $email, PDO::PARAM_STR);
    $registerUser->bindParam(':password', $password, PDO::PARAM_STR);

    $registerUser->execute();

    redirect('/pages/login.php');

        // if ($registerUser($username, $name, $email, $password)) {
        //     redirect('/pages/login.php');
        // }
        // else {
        //     redirect('/pages/register.php');
        // }

}
