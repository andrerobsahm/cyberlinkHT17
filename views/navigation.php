<nav class="navbar navbar-expand-lg sticky-top navbar-dark bg-dark d-flex justify-content-between">

    <a class="navbar-brand" href="/index.php">
        <!-- <img src="" width="30" height="30" class="d-inline-block align-top" alt="C"> -->
        <?php echo $config['title']; ?>
    </a>

    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" href="/index.php">Feed</a>
        </li>

        <li class="nav-item">
            <?php if (isset($_SESSION['user'])): ?>
                <a class="nav-link" href="/profile.php">Profile</a>
        </li>
        <?php endif; ?>

        <li class="nav-item">
            <?php if (!isset($_SESSION['user'])): ?>
            <a class="nav-link" href="/register.php">Register</a>
            <?php endif; ?>
        </li>

        <li class="nav-item">
            <?php if (isset($_SESSION['user'])): ?>
                <a class="nav-link" href="/app/auth/logout.php">Logout</a>
            <?php else: ?>
                <a class="nav-link" href="/login.php">Login</a>
            </li>
        <?php endif; ?>

    </ul><!-- /navbar-nav -->

    <?php if (isset($_SESSION['user'])): ?>
        <span class="navbar-text text-warning">
            Logged in as: <?php echo $_SESSION['user']['username']; ?>
        </span>
    <?php endif; ?>

</nav><!-- /navbar -->
