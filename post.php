<?php
require __DIR__.'/views/header.php';

// Get posts
// $postInfo = GetPostInfo($pdo);

// Get comments
$comments = GetCommentsOnPost($pdo);

$postId = $_GET['id'];

// Get posts
$statement = $pdo->query("SELECT * FROM posts INNER JOIN users WHERE post_id = '$postId' ");
$post = $statement->fetch(PDO::FETCH_ASSOC);

?>

    <article class="border bg-light p-2 mb-3">

        <h5><?php echo $post['title']; ?> </h5>

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

<?php foreach ($comments as $comment => $value): ?>
<article>
    <p><?php $value['comment']; ?></p>
</article>
<?php endforeach; ?>


<?php require __DIR__.'/views/footer.php'; ?>
