<nav class="navbar navbar-expand-lg sticky-top navbar-dark bg-dark">

    <a class="navbar-brand" href="/index.php">
        <img src="" width="30" height="30" class="d-inline-block align-top" alt="C"><?php echo $config['title']; ?>
    </a>

    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" href="/index.php">Home</a>
        </li>

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

    <li class="nav-item">
        <?php if (isset($_SESSION['user'])): ?>
            <a class="nav-link" href="/profile.php">Profile</a>
    </li>
    <?php endif; ?>

    </ul><!-- /navbar-nav -->
</nav><!-- /navbar -->


<!-- Update the Login link in the navigation to show Logout if the session variable user exists. When the user clicks on the logout link they should be taken to app/auth/logout.php. -->
