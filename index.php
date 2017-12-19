<?php
declare(strict_types=1);
require __DIR__.'/views/header.php';

if (isset($_SESSION['user'])) {
    // Get user info
    $user = GetUser($pdo);
}

// Get posts
$postInfo = GetPostInfo($pdo);

// Get comments
// $comments = GetCommentsOnPost($pdo);

// usort($postInfo, 'sortByDate');
?>

<header>
    <h1>Welcome to <?php echo $config['title']; ?></h1>
</header>

<?php if (!isset($_SESSION['user'])): ?>
    <article>
    <h2>Do you have an account?</h2>
    <h4>Otherwise, become a cyberlinker <a href="/register.php">here</a>.</h4>
    </article>
<?php endif; ?>

    <hr>

<!-- The feed -->
<section>
    <h5>Shared links</h5>

    <?php foreach ($postInfo as $post => $value): ?>

    <article class="border bg-light p-2 mb-3">

        <img class="" src="<?php echo $value['profile_pic']; ?>" alt="">

        <h5><?php echo $value['title']; ?> </h5>

        <a href="<?php echo $value['link']; ?>">
            <?php echo $value['link']; ?>
        </a>
        <br>
        <small>Posted by:
            <strong>
                <?php echo $value['username']; ?>
                on
                <?php echo $value['post_date']; ?>
            </strong>
        </small>
        <br>
        <form action="/post.php" method="GET">
            <a href="/post.php"><button class="btn btn-sm btn-dark mt-1" type="submit" name="id" value="<?php echo $value['post_id']; ?>">Comment</button></a>
            <!-- <a href="/post.php" class="btn btn-sm btn-dark mt-1" role="button" aria-pressed="true">Comment</a> -->
        </form>
    </article>
<?php endforeach; ?>

</section><!-- /the feed -->


<?php require __DIR__.'/views/footer.php'; ?>
