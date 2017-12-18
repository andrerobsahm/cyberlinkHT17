<?php
declare(strict_types=1);

if (!function_exists('redirect')) {
    /**
     * Redirect the user to given path.
     *
     * @param string $path
     *
     * @return void
     */
    function redirect(string $path)
    {
        header("Location: ${path}");
        exit;
    }
}


// function to show database info on profile page
function userInfo($pdo){
    $id = $_SESSION['user']['id'];
    $statement = $pdo->prepare("SELECT * FROM users WHERE id=:id");
    $statement->bindParam(':id', $id, PDO::PARAM_INT);
    $statement->execute();

    $user = $statement->fetch(PDO::FETCH_ASSOC);
    unset($user['password']);
        return $user;
}


// function to show posts
function postInfo($pdo){
    $id = $_SESSION['user']['id'];
    $statement = $pdo->prepare("SELECT * FROM posts WHERE id=:id");
    $statement->bindParam(':id', $id, PDO::PARAM_INT);
    $statement->execute();

    $user = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $user;
}
