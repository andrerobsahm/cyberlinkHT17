<nav class="navbar navbar-expand-md sticky-top navbar-dark bg-dark d-flex">

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggler" aria-controls="navbarToggler" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <a class="navbar-brand justify-self-left" href="/index.php">
        [ <?php echo $config['title']; ?> ]
    </a>

    <div class="collapse navbar-collapse justify-content-between" id="navbarToggler">

        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="/index.php">CyberFeed</a>
            </li>

            <?php if (isset($_SESSION['user'])): ?>
                <li class="nav-item">
                    <a class="nav-link" href="/profile.php">Profile</a>
                </li>
            <?php endif; ?>

            <?php if (!isset($_SESSION['user'])): ?>
                <li class="nav-item">
                    <a class="nav-link" href="/register.php">Register</a>
                </li>
            <?php endif; ?>

            <li class="nav-item">
                <?php if (isset($_SESSION['user'])): ?>
                    <a class="nav-link" href="/app/auth/logout.php">Logout</a>
                <?php else: ?>
                    <a class="nav-link" href="/login.php">Login</a>
                <?php endif; ?>
            </li>

        </ul><!-- /navbar-nav -->

        <?php if (isset($_SESSION['user'])): ?>
            <span class="navbar-text text-warning">
                Logged in as: <?php echo $_SESSION['user']['username']; ?>
            </span>
        <?php endif; ?>
    </div><!-- end mobile toggler -->
</nav><!-- end navbar -->
