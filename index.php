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

?>

<header>
    <h1>Welcome to <?php echo $config['title']; ?></h1>
    <hr>
</header>

<?php if (!isset($_SESSION['user'])): ?>
    <article>
    <h2>Do you have an account?</h2>
    <h4>Otherwise, become a cyberlinker <a href="/register.php">here</a>.</h4>
    </article>
<?php endif; ?>

<?php if (isset($_SESSION['user'])): ?>
    <h5>Post a new <a href="/newpost.php">cyberlink</a>!</h5>
<?php endif; ?>
    <hr>

<!-- The feed -->
<section>
    <h2>Shared cyberlinks</h2>

    <?php foreach ($postInfo as $post): ?>

    <article class="border bg-light p-2 mb-3">

        <a href="/post.php?id=<?php echo $post['post_id']; ?>">
            <h5><?php echo $post['title']; ?> </h5>
        </a>

        <?php if (isset($post['description'])): ?>
            <p><?php echo $post['description']; ?></p>
        <?php endif; ?>

        <small>Posted by:
            <strong>
                <?php echo $post['username']; ?>
            </strong>
                on
            <strong>
                <?php echo $post['post_date']; ?>
            </strong>
        </small>
        <br>

    <div class="d-flex mt-2">

        <?php if (isset($_SESSION['user'])): ?>
            <form action="/post.php" method="GET">
                <a href="/post.php">
                    <button class="btn btn-sm btn-dark mr-1" type="submit" name="id" value="<?php echo $post['post_id']; ?>">Comment</button>
                </a>
            </form>
            <small>
                Comments:
                <span class="badge badge-warning badge-pill">1</span>
            </small>

                <button class="btn btn-sm btn-dark voteUp" type="button" name="up" data-dir="1" value="<?php echo $post['post_id'] ?>">Like</button>

                <button class="btn btn-sm btn-dark voteDown" type="button" name="down" data-dir="-1" value="<?php echo $post['post_id'] ?>">Dislike</button>

                <div class="voteScore">
                    <p class="sum">Score: <?php echo $post['score'];?></p>
                </div>

        <?php endif; ?>

    </div>

    </article>
<?php endforeach; ?>

</section><!-- /the feed -->


<?php require __DIR__.'/views/footer.php'; ?>
