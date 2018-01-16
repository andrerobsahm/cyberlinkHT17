<?php
declare(strict_types=1);
require __DIR__.'/../autoload.php';

// IF THE USER LIKES
if (isset($_POST['up'])) {
    $id = $_SESSION["user"]["id"];
    $post_id = (int)$_POST['up'];
    $vote_dir = (int)$_POST['dir'];

    // CHECK IF USER HAS ALREADY LIKED
    $voteCheckQuery = "SELECT user_id, vote_dir, post_id FROM votes
    WHERE user_id=:user_id AND post_id=:post_id";
    $voteCheck = $pdo->prepare($voteCheckQuery);

        if (!$voteCheck) {
        die(var_dump($pdo->errorInfo()));
        }

    $voteCheck->bindParam(':user_id', $id, PDO::PARAM_INT);
    // $voteCheck->bindParam(':vote_dir', $vote_dir, PDO::PARAM_INT);
    $voteCheck->bindParam(':post_id', $post_id, PDO::PARAM_INT);
    $voteCheck->execute();
    $resultQuery = $voteCheck->fetch(PDO::FETCH_ASSOC);

    // IF USER HAS LIKED ON POST, DO NOTHING
    if ((int)$resultQuery['vote_dir'] === $vote_dir) {
      echo json_encode("nothing");
    }

    // IF USER HAS DISLIKED EARLIER, UPDATE TO LIKES
    else if (isset($resultQuery['vote_dir']) && (int)$resultQuery['vote_dir'] !== $vote_dir) {
    $query = "UPDATE votes SET vote_dir = :vote_dir WHERE user_id=:user_id AND post_id=:post_id";
    $statement = $pdo->prepare($query);

        if (!$statement) {
          die(var_dump($pdo->errorInfo()));
        }

    $statement->bindParam(':user_id', $id, PDO::PARAM_INT);
    $statement->bindParam(':vote_dir', $vote_dir, PDO::PARAM_INT);
    $statement->bindParam(':post_id', $post_id, PDO::PARAM_INT);
    $statement->execute();
    echo json_encode($id);
    }

    // IF USER NEVER VOTE BEFORE, INSERT LIKES
    else if ($resultQuery === false) {
        $query = "INSERT INTO votes (user_id, vote_dir, post_id) VALUES (:user_id, :vote_dir, :post_id)";
        $statement = $pdo->prepare($query);

            if (!$statement) {
              die(var_dump($pdo->errorInfo()));
            }

$statement->bindParam(':user_id', $id, PDO::PARAM_INT);
$statement->bindParam(':vote_dir', $vote_dir, PDO::PARAM_INT);
$statement->bindParam(':post_id', $post_id, PDO::PARAM_INT);
$statement->execute();
echo json_encode($id);
        }
}

// IF USER PRESSES DISLIKE
if (isset($_POST['down'])) {
    $id = $_SESSION['user']['id'];
    $post_id = (int)$_POST['down'];
    $vote_dir = (int)$_POST['dir'];
    $voteCheck = $pdo->prepare("SELECT user_id, vote_dir, post_id FROM votes
    WHERE user_id=:user_id AND post_id=:post_id");

        if (!$voteCheck) {
        die(var_dump($pdo->errorInfo()));
        }

    $voteCheck->bindParam(':user_id', $id, PDO::PARAM_INT);
    // $voteCheck->bindParam(':vote_dir', $vote_dir, PDO::PARAM_INT);
    $voteCheck->bindParam(':post_id', $post_id, PDO::PARAM_INT);
    $voteCheck->execute();
    $resultQuery = $voteCheck->fetch(PDO::FETCH_ASSOC);

    // IF USER HAS DISLIKED ON POST, DO NOTHING
    if ((int)$resultQuery['vote_dir'] === $vote_dir) {
      echo json_encode("Already voted");
    }

        // IF USER HAS LIKED EARLIER, UPDATE TO DISLIKE
        else if (isset($resultQuery['vote_dir']) && (int)$resultQuery['vote_dir'] !== $vote_dir) {
            $query = "UPDATE votes SET vote_dir=:vote_dir WHERE user_id=:user_id AND post_id=:post_id";
            $statement = $pdo->prepare($query);
            if (!$statement) {
            die(var_dump($pdo->errorInfo()));
            }
            $statement->bindParam(':user_id', $id, PDO::PARAM_INT);
            $statement->bindParam(':vote_dir', $vote_dir, PDO::PARAM_INT);
            $statement->bindParam(':post_id', $post_id, PDO::PARAM_INT);
            $statement->execute();
            echo json_encode($id);
        }

        // IF USER NEVER VOTE BEFORE, INSERT DISLIKE
        else if (!$resultQuery) {
            $query = "INSERT INTO votes (user_id, vote_dir, post_id) VALUES (:user_id, :vote_dir, :post_id)";
            $statement = $pdo->prepare($query);

                if (!$statement) {
                die(var_dump($pdo->errorInfo()));
                }

            $statement->bindParam(':user_id', $id, PDO::PARAM_INT);
            $statement->bindParam(':vote_dir', $vote_dir, PDO::PARAM_INT);
            $statement->bindParam(':post_id', $post_id, PDO::PARAM_INT);
            $statement->execute();
                echo json_encode($id);
            }
        }
