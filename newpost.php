<?php require __DIR__.'/views/header.php';?>

<article>
    <h1>Make a new post</h1>

    <form action="app/posts/newpost.php" method="post">
        <div class="form-group">
            <label for="title">Titel</label>
            <input class="form-control" type="text" name="title" required>
        </div><!-- /form-group -->

        <div class="form-group">
            <label for="link">Link</label>
            <input class="form-control" type="text" name="link" required>
        </div><!-- /form-group -->

        <button type="submit" class="btn btn-dark">Post</button>
    </form>
</article>


<?php require __DIR__.'/views/footer.php'; ?>