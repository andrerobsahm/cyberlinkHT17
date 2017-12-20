<?php
require __DIR__.'/views/header.php';

$postId = $_GET['id'];

$user = GetUser($pdo);

// Get post
$statement = $pdo->query("SELECT * FROM posts INNER JOIN users WHERE post_id = '$postId' ");
$post = $statement->fetch(PDO::FETCH_ASSOC);

// Get comments
// $comments = GetCommentsOnPost($pdo);
$getComments = $pdo->query("SELECT username, comment, comment_date FROM users INNER JOIN comments ON users.id = comments.user_id WHERE post_id = '$postId' ");

$comments = $getComments->fetchAll(PDO::FETCH_ASSOC);

?>

<h2><?php echo $post['title']; ?></h2>
<article class="border bg-light p-2 mb-3">

    <a href="<?php echo $post['link']; ?>">
        <?php echo $post['link']; ?>
    </a>
    <br>
    <small>Posted by:
        <strong>
            <?php echo $post['username']; ?>
            on
            <?php echo $post['post_date']; ?>
        </strong>
    </small>
</article>

<?php foreach ($comments as $comment): ?>
    <article class="card card-body" style="width: 30rem">
        <p><?php echo $comment['comment']; ?></p>

        <small>Commented by: <?php echo $comment['username']; ?> on <?php echo $comment['comment_date']; ?></small>

        <!-- EDIT COMMENT -->
        <button class="btn btn-sm btn-dark" type="button" data-toggle="collapse" data-target="#showForm" aria-expanded="false" aria-controls="showForm">Edit comment</button>
         <?php if (isset($_SESSION['user']) && $comment['username'] === $_SESSION['user']['username']): ?>
             <div class="collapse" id="showForm">

                <form action="editcomment.php?id=<?php echo $comment['comment_id']?>" method="post">

                    <input type="text" name="post_id" value="<?php echo $_GET['id']?> ">

                    <button class="btn btn-sm btn-dark m-1" type="submit" name="button">Submit</button>
                </form>

            </div>
        <?php endif; ?>
    </article>

<?php endforeach; ?>

<article class="card card-body mt-1" style="width: 30rem">
    <form action="/app/comments/newcomment.php?id=<?php echo $post['post_id']?>" method="POST">
        <label for="comment">Add a comment</label>
        <textarea class="form-control" name="comment" rows="2"></textarea>
        <button type="submit" class="btn btn-sm btn-dark mt-1">Save</button>
    </form>
</article>

<?php require __DIR__.'/views/footer.php'; ?>
