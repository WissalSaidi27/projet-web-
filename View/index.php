<?php
// Include the PostController
require_once __DIR__ . '/../controller/PostController.php';  // Adjust the path if necessary
$controller = new PostController();  // Create an instance of the PostController

// Handle POST requests (like uploading a post or adding a comment)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['upload'])) {
        $imagePath = '../public/uploads/' . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], $imagePath);
        $controller->uploadPost($imagePath, $_POST['comment']);
    } elseif (isset($_POST['like'])) {
        $controller->likePost($_POST['post_id']);
    } elseif (isset($_POST['add_comment'])) {
        $controller->addComment($_POST['post_id'], $_POST['comment_text']);
    }
}

// Fetch posts to display
$posts = $controller->fetchPosts();  // This should now work, because fetchPosts is defined in PostController
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/css/style.css">
    <script src="../public/js/app.js" defer></script>
    <title>Discover Tunisia</title>
</head>
<body>
    <div class="main-container">
        <?php include 'partials/header.php'; ?>

        <main>
            <section class="form-section">
                <h2>Upload a Post</h2>
                <form action="" method="POST" enctype="multipart/form-data">
                    <input type="file" name="image" required>
                    <textarea name="comment" placeholder="Add a comment" required></textarea>
                    <button type="submit" name="upload">Upload</button>
                </form>
            </section>

            <section class="posts-section">
                <h2>Recent Posts</h2>
                <?php foreach ($posts as $post): ?>
                    <div class="post-item">
                        <img src="<?php echo htmlspecialchars($post['image_path']); ?>" alt="Post Image">
                        <p><?php echo htmlspecialchars($post['comment']); ?></p>
                        <form action="" method="POST">
                            <input type="hidden" name="post_id" value="<?php echo $post['id']; ?>">
                            <button type="submit" name="like">Like</button>
                            <span><?php echo $post['likes']; ?> Likes</span>
                        </form>
                        <div class="comments">
                            <?php
                            $comments = $controller->fetchComments($post['id']);
                            foreach ($comments as $comment): ?>
                                <p><?php echo htmlspecialchars($comment['comment']); ?></p>
                            <?php endforeach; ?>
                            <form action="" method="POST">
                                <input type="hidden" name="post_id" value="<?php echo $post['id']; ?>">
                                <textarea name="comment_text" placeholder="Write a comment" required></textarea>
                                <button type="submit" name="add_comment">Comment</button>
                            </form>
                        </div>
                    </div>
                <?php endforeach; ?>
            </section>
        </main>

        <?php include 'partials/footer.php'; ?>
    </div>
</body>
</html>
