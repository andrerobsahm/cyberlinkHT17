<?php require __DIR__.'/views/header.php'; ?>

<section class="container py-4 my-4">

    <article>
        <h1 class="mb-5">Register</h1>

        <form action="/app/auth/register.php" method="post">
            <div class="form-group">
                <label for="name">Enter your name</label>
                <input class="form-control" type="text" name="name" placeholder="Juri Gagarin" required>
            </div><!-- /form-group -->

            <div class="form-group">
                <label for="name">Enter a username</label>
                <input class="form-control" type="text" name="username" placeholder="gagarin_the_great" required>
            </div><!-- /form-group -->

            <div class="form-group">
                <label for="email">Enter your email address</label>
                <input class="form-control" type="email" name="email" placeholder="kosmonaut@space.org" required>
            </div><!-- /form-group -->

            <div class="form-group">
                <label for="password">Enter a password</label>
                <input class="form-control" type="password" name="password" placeholder="your passphrase" required>
            </div><!-- /form-group -->

            <button type="submit" class="btn btn-dark">Register</button>
        </form>
    </article>

    <hr class="mt-5 mb-5">
    <article>
        <h3>Already a Cyberlinker!?</h3>
        <h5>Log in <a href="/login.php">here</a>.</h5>
    </article>

</section><!--end container-->

<?php require __DIR__.'/views/footer.php'; ?>
