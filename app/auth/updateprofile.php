<?php
declare(strict_types=1);
require __DIR__.'/../autoload.php';

// UPDATE PROFILE BIO TEXT
if (isset($_POST['bio'])) {
    $bio = filter_var($_POST['bio'], FILTER_SANITIZE_STRING);

    $updateUserBio = $pdo->prepare("UPDATE users SET bio=:bio WHERE id=:id");

    $id = $_SESSION['user']['id'];
    $updateUserBio->bindParam(':id', $id, PDO::PARAM_INT);
    $updateUserBio->bindParam(':bio', $bio, PDO::PARAM_STR);
    $updateUserBio->execute();

        if (!$updateUserBio) {
            die(var_dump($pdo->errorInfo()));
        }
}

// UPDATE PROFILE PIC
if (isset($_FILES['profile_pic'])) {
    $profile_pic = $_FILES['profile_pic'];
    $info = pathinfo($_FILES['profile_pic']['name']); //Skapar array ur 'name'
    $ext = $info['extension']; //Väljer 'extension' ur 'name'
    $fileName = $_SESSION['user']['username'].'.'.$ext;

    move_uploaded_file($profile_pic['tmp_name'], __DIR__.'/profile_pic/'.$fileName);

    $id = $_SESSION['user']['id'];
    $updateUserPic = $pdo->prepare("UPDATE users SET profile_pic=:profile_pic WHERE id=:id");

    $updateUserPic->bindParam(':id', $id, PDO::PARAM_INT);
    $updateUserPic->bindParam(':profile_pic', $fileName, PDO::PARAM_STR);
    $updateUserPic->execute();

    if (!$updateUserPic) {
      die(var_dump($pdo->errorInfo()));
    }

}

// UPDATE PASSWORD

//Lägg till att en måste skriva sitt gamla lösenord för att kuna ändra. Lösenordet ska också vara dolt när en skriver.
if (isset($_POST['password'])) {
    $password = filter_var($_POST['password']);
    $id = $_SESSION['user']['id'];

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $updatePassword = $pdo->prepare("UPDATE users SET password=:password WHERE id=:id");

    $updatePassword->bindParam(':id', $id, PDO::PARAM_INT);
    $updatePassword->bindParam(':password', $hashed_password, PDO::PARAM_STR);
    $updatePassword->execute();

        if (!$updatePassword) {
            die(var_dump($pdo->errorInfo()));
        }
}


// UPDATE EMAIL
if (isset($_POST['email'])) {
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);

    $updateEmail = $pdo->prepare("UPDATE users SET email=:email WHERE id=:id");

    $id = $_SESSION['user']['id'];
    $updateEmail->bindParam(':id', $id, PDO::PARAM_INT);
    $updateEmail->bindParam(':email', $email, PDO::PARAM_STR);
    $updateEmail->execute();

        if (!$updateEmail) {
            die(var_dump($pdo->errorInfo()));
        }
}


redirect('/profile.php');
