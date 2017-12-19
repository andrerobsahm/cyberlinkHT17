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
    // $statement_post = $pdo->query("SELECT * FROM posts WHERE post_id='post_id' ");
    // $posts = $statement_post->fetch(PDO::FETCH_ASSOC);
    // return $posts;

    $statement = $pdo->query("SELECT username, comment, comment_date FROM users INNER JOIN comments ON users.id = comments.user_id WHERE post_id = post_id ORDER BY comment_id DESC");

    $comments = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $comments;
}

// GET ALL POST INFO
function GetPostInfo($pdo) {
$statement = $pdo->prepare("SELECT username, title, link, post_date, post_id FROM users INNER JOIN posts ON users.id = posts.user_id ORDER BY post_date ASC");

$statement->execute();
$postInfo = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $postInfo;
}


//SORT POSTS BY DATE
// function sortPostsByDate($a, $b) {
//     return strtotime($a['post_date']) < strtotime($b['post_date']);
// }
