<nav class="navbar navbar-expand-lg navbar-dark bg-dark">

    <a class="navbar-brand" href="#">
        <img src="/assets/brand/bootstrap-solid.svg" width="30" height="30" class="d-inline-block align-top" alt="">CYBERLINK<!--<?php echo $config['title']; ?>-->
    </a>

    <ul class="navbar-nav ">
        <li class="nav-item">
            <a class="nav-link" href="/index.php">Home</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="/about.php">About</a>
        </li>

        <li class="nav-item ">
            <a class="nav-link" href="/login.php">Login</a>
        </li>
    </ul><!-- /navbar-nav -->
</nav><!-- /navbar -->


<!-- Update the Login link in the navigation to show Logout if the session variable user exists. When the user clicks on the logout link they should be taken to app/auth/logout.php. -->
