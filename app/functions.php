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


// // GET POST INFO FUNCTION
// function GetPosts($pdo){
//     $statement = $pdo->prepare("SELECT * FROM posts");
//     $statement->execute();
//     $posts = $statement->fetchAll(PDO::FETCH_ASSOC);
//         return $posts;
// }


// GET POST INFO FUNCTION
function GetCommentsOnPost($pdo){
    $statement = $pdo->query("SELECT username, comment, comment_date
        FROM users
        INNER JOIN comments
        ON users.id = comments.user_id
        WHERE post_id = post_id
        ORDER BY comment_id
        DESC");

    $comments = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $comments;
}

// GET ALL POST INFO --- OLD ---
// function GetPostInfo($pdo) {
// $statement = $pdo->prepare("SELECT username, title, link, description, post_date, post_id FROM users INNER JOIN posts ON users.id = posts.user_id ORDER BY post_id DESC");
//
// // $query2 = "SELECT posts.*, users.*, (SELECT sum(vote_direction) FROM votes
// // WHERE posts.post_id=votes.post_id) AS score FROM posts
// // JOIN votes ON posts.post_id=votes.post_id
// // JOIN users ON posts.user_id=users.id GROUP BY posts.post_id ORDER BY post_id DESC";
//
//
// $statement->execute();
// $postInfo = $statement->fetchAll(PDO::FETCH_ASSOC);
//     return $postInfo;
// }

// function GetPostInfo($pdo) {
//     $query = "SELECT posts.*, users.*, (SELECT sum(vote_direction) FROM votes
//     WHERE posts.post_id=votes.post_id) AS score FROM posts
//     JOIN votes ON posts.post_id=votes.post_id
//     JOIN users ON posts.user_id=users.id GROUP BY posts.post_id ORDER BY post_id DESC";
//     $statement = $pdo->prepare($query);
//     $statement->execute();
//     $postInfo = $statement->fetchAll(PDO::FETCH_ASSOC);
//     if (!$statement) {
//       die(var_dump($pdo->errorInfo()));
//     }
//
//     return $postInfo;
// }


function getVotes($pdo) {
    $statement = $pdo->prepare("SELECT vote_id, post_id, user_id
        FROM votes
        WHERE post_id = post_id");
    $statement->execute();
    $votes = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $votes;
}

// TO GET INFO ON LATEST CREATED POST
function lastNewPost($pdo) {
    $query = "SELECT post_id
    FROM posts
    ORDER BY post_id
    DESC
    LIMIT 1";
    
    $statement = $pdo->prepare($query);
    $statement->execute();
    $resultQuery = $statement->fetch(PDO::FETCH_ASSOC);
    if (!$statement) {
    die(var_dump($pdo->errorInfo()));
    }
    return $resultQuery;
}


//
function GetPostInfo($pdo) {

    $statement = $pdo->prepare("SELECT posts.*, users.*, (SELECT sum(vote_dir) FROM votes
    WHERE posts.post_id=votes.post_id) AS score FROM posts
    JOIN votes ON posts.post_id=votes.post_id
    JOIN users ON posts.user_id=users.id GROUP BY posts.post_id ORDER BY post_id DESC");
    $statement->execute();
    $resultQuery = $statement->fetchAll(PDO::FETCH_ASSOC);
    if (!$statement) {
    die(var_dump($pdo->errorInfo()));
    }
    return $resultQuery;
}
// ---OLD--- $getPost = $pdo->query("SELECT title, link, description, post_id, post_date, username FROM posts INNER JOIN users ON users.id = posts.user_id WHERE post_id = '$postId'");
// $post = $getPost->fetch(PDO::FETCH_ASSOC);

// $query = "SELECT posts.*, users.*,  FROM posts JOIN users ON posts.user_id=users.id
// ORDER BY post_id DESC";
