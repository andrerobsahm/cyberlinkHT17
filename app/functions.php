<?php
declare(strict_types=1);

if (!function_exists('redirect')) {
    /**
     * Redirect the user to given path.
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


// GET USER DATA FUNCTION
function GetUser($pdo){
    $id = $_SESSION['user']['id'];
    $statement = $pdo->prepare("SELECT * FROM users WHERE id=:id");
    $statement->bindParam(':id', $id, PDO::PARAM_INT);
    $statement->execute();

    $user = $statement->fetch(PDO::FETCH_ASSOC);
    unset($user['password']);
        return $user;
}


// GET POST INFO FUNCTION
function GetPosts($pdo){
    $statement = $pdo->prepare("SELECT * FROM posts");
    $statement->execute();
    $posts = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $posts;
}


// GET POST INFO FUNCTION
function GetCommentsOnPost($pdo){

    $statement = $pdo->query("SELECT username, comment, comment_date FROM users INNER JOIN comments ON users.id = comments.user_id WHERE post_id = post_id ORDER BY comment_id DESC");

    $comments = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $comments;
}

// GET ALL POST INFO
function GetPostInfo($pdo) {
$statement = $pdo->prepare("SELECT username, title, link, description, post_date, post_id FROM users INNER JOIN posts ON users.id = posts.user_id ORDER BY post_id DESC");

$statement->execute();
$postInfo = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $postInfo;
}
