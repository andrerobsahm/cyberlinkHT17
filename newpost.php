<?php require __DIR__.'/views/header.php';?>

<article class="container py-4 my-4">
    <h1>Make a new cyberlink</h1>

    <form action="app/posts/newpost.php" method="post">
        <div class="form-group">
            <label for="title">Titel</label>
            <input class="form-control" type="text" name="title" required>
        </div><!-- /form-group -->

        <div class="form-group">
            <label for="link">Link</label>
            <input class="form-control" type="text" name="link" required>
        </div><!-- /form-group -->

        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" type="text" name="description"></textarea>
        </div><!-- /form-group -->

        <button type="submit" class="btn btn-dark">Post</button>
    </form>
</article><!-- end container-->
<?php require __DIR__.'/views/footer.php'; ?>
