<?php require __DIR__.'/views/header.php'; ?>

<article>
    <h1>Login</h1>

    <form action="app/auth/login.php" method="post">
        <div class="form-group">
            <label for="username">Username</label>
            <input class="form-control" type="text" name="username" required>
            <small class="form-text text-muted">Please provide the your email address</small>
        </div><!-- /form-group -->

        <div class="form-group">
            <label for="email">Email</label>
            <input class="form-control" type="email" name="email" required>
            <small class="form-text text-muted">Please provide the your email address</small>
        </div><!-- /form-group -->

        <div class="form-group">
            <label for="password">Password</label>
            <input class="form-control" type="password" name="password" required>
            <small class="form-text text-muted">Please provide the your password</small>
        </div><!-- /form-group -->

        <button type="submit" class="btn btn-dark">Login</button>
    </form>
</article>

<hr class="mt-5 mb-5">
<article>
    <h3>Not a Cyberlinker yet!?</h3>
    <h5>Set up your account <a href="/register.php">here</a>.</h5>
</article>


<?php require __DIR__.'/views/footer.php'; ?>
