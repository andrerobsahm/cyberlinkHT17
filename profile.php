<?php require __DIR__.'/views/header.php';

// $getUserInfo = $pdo->prepare('SELECT * FROM users WHERE id = :id');
// $getUserInfo->bindParam(':id', $_SESSION['user']['id'], PDO::PARAM_STR);
// $getUserInfo->execute();

// Fetch the user as an associative array.
// $user = $getUserInfo->fetch(PDO::FETCH_ASSOC);


// Get user info
$user = userInfo($pdo);

?>


<article>
    <h1>My Profile</h1>
    <hr class="mt-5 mb-5">
</article>
<article>
    <h3>Hi there, <?php echo $user['name'];?> (aka <?php echo $user['username']; ?>)!</h3>
    <p>Here is you own page where you can edit you profile or, why you would want that - delete you account.</p>
    <h5>Keep on <a href="/index.php">cyberlinking!</a></h5>
</article>

<hr class="mt-5 mb-5">

<section class="d-flex justify-content-between">
    <article><!-- BIO TEXT -->
        <h4>Bio:</h4>
        <p><?php echo $user['bio']; ?></p>
    </article>

    <article><!-- PROFILE PIC -->
        <?php if (!$user['profile_pic']): ?>
        <img src="/images/default_pic.png";
        <?php else: ?>
        <img class="img-thumbnail" src="/app/auth/profile_pic/<?php echo $user['profile_pic'] ?>">
        <?php endif; ?>
    </article>

</section>

<hr class="mt-5 mb-5">


<!-- TO UPDATE THE PROFILE -->
<button class="btn btn-sm btn-dark" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">Update profile</button>

<div class="collapse" id="collapseExample">
    <div class="card card-body">
        <form action="/app/auth/updateprofile.php" method="post" enctype="multipart/form-data">
            <label for="input">Change profile picture</label>
            <input type="file" name="profile_pic" accept=".jpg, .jpeg, .gif, .png">
            <br>
            <button type="submit" class="btn btn-sm btn-dark">Save picture</button>
        </form>

        <form action="/app/auth/updateprofile.php" method="post">
            <label for="textarea">Change bio text</label>
            <textarea class="form-control" id="updateProfileText" name="bio" rows="3"></textarea>
            <button type="submit" class="btn btn-sm btn-dark">Save bio</button>
        </form>

        <form action="/app/auth/updateprofile.php" method="post">
            <label for="input">Change password</label>
            <input class="form-control" id="updatePassword" name="password"></input>
            <button type="submit" class="btn btn-sm btn-dark">Save password</button>
        </form>
    </div>
</div>


<?php require __DIR__.'/views/footer.php'; ?>
