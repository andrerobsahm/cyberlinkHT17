<?php
declare(strict_types=1);
require __DIR__.'/views/header.php';
?>

<article>
    <h1>Welcome to <?php echo $config['title']; ?></h1>
    <p>This is the home page.</p>
</article>
    <hr>
<article class="">
    <h2>Do you have an account?</h2>
    <h4>Otherwise, become a cyberlinker <a href="/login.php">here</a>.</h4>
</article>
    <hr>

<!-- The feed -->
<section class="border">
    - title
    - description
    - url
    - id
</section><!-- /the feed -->


<?php require __DIR__.'/views/footer.php'; ?>
