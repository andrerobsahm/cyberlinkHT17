<?php
require __DIR__.'/views/header.php';

$postId = $_GET['id'];
$user = GetUser($pdo);

// Get post
$getPost = $pdo->query("SELECT title, link, description, post_id, post_date, username FROM posts INNER JOIN users ON users.id = posts.user_id WHERE post_id = '$postId'");
$post = $getPost->fetch(PDO::FETCH_ASSOC);

// Get comments
$getComments = $pdo->query("SELECT username, comment_id, comment, comment_date FROM users INNER JOIN comments ON users.id = comments.user_id WHERE post_id = '$postId' ");

$comments = $getComments->fetchAll(PDO::FETCH_ASSOC);

?>

<!-- SHOW POST INFO -->
<h2><?php echo $post['title']; ?></h2>
<section class="border bg-light p-2 mb-3">

    <a href="<?php echo $post['link']; ?>">
        <?php echo $post['link']; ?>
    </a>
    <p><?php echo $post['description']; ?></p>
    <br>
    <small>Posted by:
        <strong>
            <?php echo $post['username']; ?>
            on
            <?php echo $post['post_date']; ?>
        </strong>
    </small>
    <br>

<article class="d-flex">

    <?php if(isset($_SESSION['user']) && $post['username'] === $user['username']): //ID istället? ?>

        <button class="btn btn-sm btn-dark mr-1" type="button" data-toggle="collapse" data-target="#showForm" aria-expanded="false" aria-controls="showForm">Update post</button>

        <div class="collapse" id="showForm">

           <form action="/app/posts/editpost.php" method="POST">

               <textarea class="form-control" type="text" name="title"><?php echo $post['title']; ?></textarea>

               <textarea class="form-control" type="text" name="link"><?php echo $post['link']; ?></textarea>

               <textarea class="form-control" type="text" name="description"><?php echo $post['description']; ?></textarea>

               <input type="hidden" name="post_id" value="<?php echo $post['post_id']; ?>">

               <button class="btn btn-sm btn-dark m-1" type="submit" name="id" value="<?php echo $post['post_id']; ?>">Save changes</button>
           </form>

       </div>
       <form action="/app/posts/deletepost.php" method="GET">
           <button class="btn btn-sm btn-dark" type="submit" name="id" value="<?php echo $post['post_id']; ?>">Delete post</button>
       </form>

    <?php endif; ?>
    </article>
</section>


<!-- SHOW COMMENTS -->
<?php foreach ($comments as $comment): ?>
    <article class="card card-body mb-1" style="width: 30rem">
        <p><?php echo $comment['comment']; ?></p>

        <small>Commented by: <?php echo $comment['username']; ?> on <?php echo $comment['comment_date']; ?></small>


        <!-- EDIT COMMENT -->
         <?php if (isset($_SESSION['user']) && $comment['username'] === $_SESSION['user']['username']): ?>

             <button class="btn btn-sm btn-dark" type="button" data-toggle="collapse" data-target=".showForm-<?php echo $comment['comment_id'];?>" aria-expanded="false" aria-controls="showForm">Edit comment</button>

             <div class="collapse showForm-<?php echo $comment['comment_id'];?>">

                <form action="/app/comments/editcomment.php" method="POST">

                    <textarea class="form-control" type="text" name="comment"><?php echo $comment['comment'];?></textarea>
                    <input type="hidden" name="id" value="<?php echo $comment['comment_id']; ?>">
                    <input type="hidden" name="post_id" value="<?php echo $post['post_id']; ?>">

                    <button class="btn btn-sm btn-dark m-1" type="submit" name="button">Submit</button>
                </form>

            </div>
        <?php endif; ?>
    </article>

<?php endforeach; ?>


<!-- NEW COMMENT -->
<article class="card card-body mt-1" style="width: 30rem">

    <form action="/app/comments/newcomment.php" method="POST">
        <input type="hidden" name="post_id" value="<?php echo $post['post_id']; ?>">
        <label for="comment">Add a comment</label>
        <textarea class="form-control" name="comment" rows="2"></textarea>
        <button type="submit" class="btn btn-sm btn-dark mt-1">Add</button>
    </form>
</article>


<?php require __DIR__.'/views/footer.php'; ?>
