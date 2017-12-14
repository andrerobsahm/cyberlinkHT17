<?php
declare(strict_types=1);

require __DIR__.'/../autoload.php';

// In this file we update profile in the database.

// $statement = $pdo->query('SELECT * FROM users WHERE id = :id');
// $currentUser = $statement->fetch(PDO::FETCH_ASSOC);


// UPDATE BIO TEXT
if (isset($_POST['bio'])) {
    $bio = filter_var($_POST['bio'], FILTER_SANITIZE_STRING);
}
else {
    $bio = "";
}

$query = 'INSERT INTO users(bio, profile_pic) VALUES (:bio, :profile_pic)';
$updateUser = $pdo->prepare($query);

$updateUser->bindParam(':bio', $bio, PDO::PARAM_STR);
$updateUser->bindParam(':profile_pic', $profile_pic, PDO::PARAM_STR);

$updateUser->execute();


// UPDATE PROFILE PIC
if (isset($_FILES['profile_pic'])) {
  $profile_pic = $_FILES['profile_pic'];
  $info = pathinfo($_FILES['profile_pic']['name']); //Skapar array ur 'name'
  $ext = $info['extension']; //Väljer 'extension' ur 'name'
  $fileName = $_SESSION['user']['username'].'.'.$ext;

  move_uploaded_file($profile_pic['tmp_name'], __DIR__.'/profile_pic/'.$fileName);
}

$updateUser = $pdo->prepare("UPDATE users SET profile_pic = :profile_pic WHERE id = :id");
$updateUser->bindParam(':profile_pic', $fileName, PDO::PARAM_STR);
$updateUser->execute();


if (!$updateUser) {
    die(var_dump($pdo->errorInfo()));
}

redirect('/profile.php');
