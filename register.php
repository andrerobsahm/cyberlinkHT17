<?php require __DIR__.'/views/header.php'; ?>

<section class="container py-4">

    <article>
        <h1>Register</h1>

        <form action="/app/auth/register.php" method="post">
            <div class="form-group">
                <label for="name">Full Name</label>
                <input class="form-control" type="text" name="name" placeholder="your name" required>
                <small class="form-text text-muted">Enter your name</small>
            </div><!-- /form-group -->

            <div class="form-group">
                <label for="username">Username</label>
                <input class="form-control" type="text" name="username" placeholder="your username" required>
                <small class="form-text text-muted">Enter a username</small>
            </div><!-- /form-group -->

            <div class="form-group">
                <label for="email">Email</label>
                <input class="form-control" type="email" name="email" placeholder="hey@hoo.com" required>
                <small class="form-text text-muted">Enter your email address</small>
            </div><!-- /form-group -->

            <div class="form-group">
                <label for="password">Password</label>
                <input class="form-control" type="password" name="password" placeholder="your passphrase" required>
                <small class="form-text text-muted">Enter a password</small>
            </div><!-- /form-group -->

            <button type="submit" class="btn btn-dark">Register</button>
        </form>
    </article>

    <hr class="mt-5 mb-5">
    <article>
        <h3>Already a Cyberlinker!?</h3>
        <h5>Log in <a href="/login.php">here</a>.</h5>
    </article>

</section><!--en container-->

<?php require __DIR__.'/views/footer.php'; ?>
