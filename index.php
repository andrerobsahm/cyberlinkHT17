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
$comments = GetComments($pdo);

// usort($postInfo, 'sortByDate');
?>

<article>
    <h1>Welcome to <?php echo $config['title']; ?></h1>
</article>
    <hr>

<article>
    <h2>Do you have an account?</h2>
    <h4>Otherwise, become a cyberlinker <a href="/register.php">here</a>.</h4>
</article>
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

        <small>Posted by:
            <strong>
                <?php echo $value['username']; ?>
                on
                <?php echo $value['post_date']; ?>
            </strong>
        </small>
        <br>
        <button class="btn btn-sm btn-dark mt-1"type="button" name="button">Comment</button>
    </article>
<?php endforeach; ?>

</section><!-- /the feed -->


<?php require __DIR__.'/views/footer.php'; ?>
