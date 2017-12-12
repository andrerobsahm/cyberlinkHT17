<?php require __DIR__.'/views/header.php'; ?>

<article>
    <h1>My Profile</h1>
    <hr class="mt-5 mb-5">
</article>
<article class="">
    <h3>Hi, <?php echo $_SESSION['user']['name']; ?>!</h3>
    <p>Here is you own page where you can edit you profile or, why you would want that - delete you account.</p>
    <p>Keep on cyberlinking!</p>
</article>


<hr class="mt-5 mb-5">


<?php require __DIR__.'/views/footer.php'; ?>
