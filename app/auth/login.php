<?php
declare(strict_types=1);
require __DIR__.'/../autoload.php';
// In this file we login users.
// 1. Check if the email and password exists in the request.
// 2. Fetch and sanitize the email address value and store it in an variable called $email.
// 3. Fetch the user in the database by the given email address.
// 4. If the user wasn't found in the database, redirect the user back to the login page.
// 5. If the user was found in the database, verify the password from the request against the one in the database.
// 6. If the password was valid, store the user's id, name and email in a session variable called user.
// 7. Redirect the user back to the start page.


if (isset($_POST['username'], $_POST['email'], $_POST['password'])) {
    $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);

    $statement = $pdo->prepare('SELECT * FROM users WHERE email = :email');
    $statement->bindParam(':email', $email, PDO::PARAM_STR);
    $statement->execute();

    $user = $statement->fetch(PDO::FETCH_ASSOC);

    // if (!$statement) {
    //     die(var_dump($pdo->errorInfo()));
    // }


    if (!$user) {
        redirect('../../login.php');
    }
    if (password_verify($_POST['password'], $user['password'])){
        unset($user['password']);
        $_SESSION['user'] = $user;
    }
}
redirect('/profile.php');
