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

        if (!$statement) {
          die(var_dump($pdo->errorInfo()));
        }

    unset($user['password']);
        return $user;
}

// GET COMMENTS FUNCTION
function getComments($pdo, $post_id){
    $statement = $pdo->query("SELECT username, comment_id, comment, comment_date FROM users INNER JOIN comments ON users.id = comments.user_id WHERE post_id = '$post_id' ");
    $comments = $statement->fetchAll(PDO::FETCH_ASSOC);

        if (!$statement) {
          die(var_dump($pdo->errorInfo()));
        }

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



// Get post for post page
function getPosts($pdo, $post_id) {
    $getPost = $pdo->query("SELECT title, link, description, post_id, post_date, username FROM posts INNER JOIN users ON users.id = posts.user_id WHERE post_id = '$post_id'");
    $post = $getPost->fetch(PDO::FETCH_ASSOC);

        if (!$getPost) {
          die(var_dump($pdo->errorInfo()));
        }

    return $post;
}


function getVotes($pdo) {
    $statement = $pdo->prepare("SELECT vote_id, post_id, user_id FROM votes WHERE post_id = post_id");
    $statement->execute();
    $votes = $statement->fetchAll(PDO::FETCH_ASSOC);

        if (!$statement) {
          die(var_dump($pdo->errorInfo()));
        }

        return $votes;
}

// TO GET INFO ON LATEST CREATED POST
function lastNewPost($pdo) {
    $statement = $pdo->prepare("SELECT post_id FROM posts ORDER BY post_id DESC LIMIT 1");
    $statement->execute();
    $result = $statement->fetch(PDO::FETCH_ASSOC);

        if (!$statement) {
        die(var_dump($pdo->errorInfo()));
        }

    return $result;
}

// Get post info for index page
function getPostInfo($pdo) {
    $statement = $pdo->prepare("SELECT posts.*, users.*, (SELECT sum(vote_dir) FROM votes
    WHERE posts.post_id=votes.post_id) AS score FROM posts
    JOIN votes ON posts.post_id=votes.post_id
    JOIN users ON posts.user_id=users.id GROUP BY posts.post_id ORDER BY post_id DESC");
    $statement->execute();
    $getPostInfo = $statement->fetchAll(PDO::FETCH_ASSOC);

        if (!$statement) {
        die(var_dump($pdo->errorInfo()));
        }

    return $getPostInfo;
}
