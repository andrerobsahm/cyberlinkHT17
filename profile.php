<?php require __DIR__.'/views/header.php';

// Get user info
$user = GetUser($pdo);

?>

<article>
    <h1>My Profile</h1>
    <hr class="mt-5 mb-5">
</article>


<section class="d-flex">
    <article><!-- GREETING -->
        <h3>Hi there, <?php echo $user['name'];?> (aka <?php echo $user['username']; ?>)!</h3>
        <p>Here is you own page where you can edit you profile or, why you would want that - delete your account.</p>
        <h5>Make a new <a href="/newpost.php">cyberlink</a>!</h5>
    </article>

    <article><!-- PROFILE PIC -->
        <?php if (!$user['profile_pic']): ?>
        <img src="/images/default_pic.png">
        <?php else: ?>
        <img src="/app/auth/profile_pic/<?php echo $user['profile_pic'] ?>" class="img-thumbnail" style="max-height:30vw;">
        <?php endif; ?>
    </article>
</section>

<hr class="my-5">

<section>
    <article><!-- BIO TEXT -->
        <h4>Bio:</h4>
        <p><?php echo $user['bio']; ?></p>
    </article>
</section>

<hr class="mt-5 mb-5">


<!-- TO UPDATE THE PROFILE -->
<!-- <article class="d-flex"> -->

    <button class="btn btn-sm btn-dark mb-1" type="button" data-toggle="collapse" data-target="#showForm" aria-expanded="false" aria-controls="showForm">Update profile</button>

    <div class="collapse" id="showForm">
        <div class="card card-body" style="width:30rem;">
            <form action="/app/auth/updateprofile.php" method="POST" enctype="multipart/form-data">
                <label for="input">Change profile picture</label>
                <input type="file" name="profile_pic" accept=".jpg, .jpeg, .gif, .png">
                <br>
                <button type="submit" class="btn btn-sm btn-warning mt-1">Save picture</button>
            </form>

            <form action="/app/auth/updateprofile.php" method="POST">
                <label for="textarea">Change bio text</label>
                <textarea class="form-control" id="updateProfileText" name="bio" rows="3"></textarea>
                <button type="submit" class="btn btn-sm btn-warning mt-1">Save bio</button>
            </form>

            <form action="/app/auth/updateprofile.php" method="POST">
                <label for="input">Change password</label>
                <input class="form-control" id="updatePassword" name="password" type="password"></input>
                <button type="submit" class="btn btn-sm btn-warning mt-1">Save password</button>
            </form>
        </div>
    </div>
    <form action="/app/auth/deleteuser.php" method="GET">
        <button class="btn btn-sm btn-dark deletingUser" type="submit" name="id" value="<?php echo $user['id']; ?>">Delete account</button>
    </form>
<!-- </article> -->

<?php require __DIR__.'/views/footer.php'; ?>
