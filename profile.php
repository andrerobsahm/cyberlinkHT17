<?php require __DIR__.'/views/header.php'; ?>
<?php

$getUserInfo = $pdo->prepare('SELECT * FROM users WHERE id = :id');
$getUserInfo->bindParam(':id', $_SESSION['user']['id'], PDO::PARAM_STR);
$getUserInfo->execute();

// Fetch the user as an associative array.
$user = $getUserInfo->fetch(PDO::FETCH_ASSOC);
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

<!-- SHOW PROFILE PIC -->
<div>

<img class="img-thumbnail rounded" src="
        <?php if(file_exists(__DIR__. '/app/auth/profile_pic/'.$user['profile_pic'])):
        echo $user['profile_pic'];
        else: echo "/images/default_pic.png"; ?>
    <?php endif; ?>
" alt="no profile picture...">

</div>


<!-- SHOW BIO TEXT -->
<hr class="mt-5 mb-5">
<article>
    <h4>Bio:</h4>
    <p><?php echo $user['bio']; ?></p>
</article>

<hr class="mt-5 mb-5">


<!-- TO UPDATE THE PROFILE -->
<button class="btn btn-sm btn-dark" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">Update profile</button>

<div class="collapse" id="collapseExample">
    <div class="card card-body">
        <h5>Change bio text</h5>
        <p><?php echo $user['bio'];?></p>

    <form action="/app/auth/updateprofile.php" method="post" enctype="multipart/form-data">
        <h5>Change profile picture</h5>
        <input type="file" name="profile_pic" accept=".jpg, .jpeg, .gif, .png">
        <button type="submit" class="btn btn-sm btn-dark">Save</button>
    </form>
    </div>
</div>



<?php require __DIR__.'/views/footer.php'; ?>
