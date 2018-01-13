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

<header class="jumbotron d-flex align-items-center justify-content-center">
    <div class="text-center">
        <h2>Welcome to</h2>
        <h1><?php echo $config['title']; ?></h1>
        <p class="lead">This is where shit happens</p>
    </div>
</header>

<div class="container py-4 my-4">

    <?php if (!isset($_SESSION['user'])): ?>
            <h2>Do you have an account?</h2>
            <h4>Otherwise, become a cyberlinker <a href="/register.php">here</a>.</h4>
            <hr>

    <?php endif; ?>

    <article class="d-flex justify-content-between">
        <h3>Shared cyberlinks</h3>

        <?php if (isset($_SESSION['user'])): ?>
            <h5>Post a new <a href="/newpost.php">cyberlink</a>!</h5>
        <?php endif; ?>
    </article>

    <!-- The feed -->
    <section>
    <?php foreach ($postInfo as $post): ?>
        <article class="border bg-light p-2 mb-3">


        <?php if (isset($_SESSION['user'])): ?>
            <a href="/post.php?id=<?php echo $post['post_id']; ?>">
                <h5><?php echo $post['title']; ?> </h5>
            </a>
        <?php endif; ?>
        <?php if (!isset($_SESSION['user'])): ?>
            <h5><?php echo $post['title']; ?> </h5>
        <?php endif; ?>


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
                        <p>Score:</p>
                        <p class="sum"><?php echo $post['score'];?></p>
                    </div>

            <?php endif; ?>

        </div>

        </article>
    <?php endforeach; ?>

    </section><!-- /the feed -->

</div><!-- end container -->

<?php require __DIR__.'/views/footer.php'; ?>
