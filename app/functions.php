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


//function to show database info on profile page
function userInfo($pdo){
    $user_id = (int)$_SESSION['user']['id'];
    $query = "SELECT * FROM users WHERE id = :id";
    $statement = $pdo->prepare($query);
    $statement->bindParam(':id', $id, PDO::PARAM_INT);
    $statement->execute();

    $resultQuery = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $resultQuery;
}



//insert into database
// $update = "UPDATE IN users WHERE id = :id";
