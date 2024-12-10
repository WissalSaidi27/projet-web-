<?php
include "../Controller/PostController.php";

$postController = new PostController();
$posts = $postController->getAllPosts();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post List</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>All Posts</h1>
    <a href="addPost.php">Add New Post</a>
    <div class="posts">
        <?php foreach ($posts as $post) { ?>
            <div class="post">
                <img src="<?= htmlspecialchars($post['contenu_post']) ?>" alt="Post Image">
                <p><?= htmlspecialchars($post['comments']) ?></p>
                <p>Likes: <?= $post['likes'] ?></p>
                <form action="updatePost.php" method="POST">
                    <input type="hidden" name="id_post" value="<?= $post['id_post'] ?>">
                    <button type="submit">Update</button>
                </form>
                <a href="deletePost.php?id_post=<?= $post['id_post'] ?>">Delete</a>
            </div>
        <?php } ?>
    </div>
</body>
</html>