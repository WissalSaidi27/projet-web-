<?php
// Include the PostController
require_once __DIR__ . '/../controller/PostController.php';  // Adjust the path if necessary
$controller = new PostController();  // Create an instance of the PostController

// Handle POST requests (like uploading a post, adding a comment, or deleting)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {   
        if (isset($_POST['like'])) {
            header('Content-Type: application/json');
            $likeCount = $controller->likePost($_POST['post_id']);
            echo json_encode(['likes' => $likeCount]);
            exit;
        }
        
        if (isset($_POST['upload'])) {
            $imagePath = '../public/uploads/' . basename($_FILES['image']['name']);
            if (move_uploaded_file($_FILES['image']['tmp_name'], $imagePath)) {
                $controller->uploadPost($imagePath, $_POST['comment']);
            } else {
                throw new Exception("Failed to upload image.");
            }
        } elseif (isset($_POST['like'])) {
            $likeCount = $controller->likePost($_POST['post_id']); // Get the updated like count
            echo $likeCount; // Output the like count
            exit;
        } elseif (isset($_POST['add_comment'])) {
            $controller->addComment($_POST['post_id'], $_POST['comment_text']);
        } elseif (isset($_POST['delete_post'])) {
            $controller->removePost($_POST['post_id']);
        } elseif (isset($_POST['delete_comment'])) {
            $controller->removeComment($_POST['comment_id']);
        } elseif (isset($_POST['modify_comment'])) {
            // Handle comment modification
            $commentId = $_POST['comment_id'];
            $modifiedComment = $_POST['modified_comment'];
            $controller->modifyComment($commentId, $modifiedComment); // Call the method to update the comment
        }
    } catch (Exception $e) {
        echo "<p>Error: " . htmlspecialchars($e->getMessage()) . "</p>";
        exit;
    }
}

// Fetch posts to display
try {
    $posts = $controller->fetchPosts(); // Fetch posts using the controller
} catch (Exception $e) {
    echo "<p>Error fetching posts: " . htmlspecialchars($e->getMessage()) . "</p>";
    $posts = [];
}
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
                <form action="" method="POST" enctype="multipart/form-data" id="postForm" novalidate>
                    <input type="file" name="image" id="image" /> <!-- Removed required attribute -->
                    <textarea name="comment" id="comment" placeholder="Add a description"></textarea> <!-- Removed required attribute -->
                    <button type="submit" name="upload">Upload</button>
                </form>
            </section>

            <section class="posts-section">
                <h2>Recent Posts</h2>
                <?php if (!empty($posts)): ?>
                    <?php foreach ($posts as $post): ?>
                        <div class="post-item">
                            <img src="<?php echo htmlspecialchars($post['image_path']); ?>" alt="Post Image">
                            <p><?php echo htmlspecialchars($post['comment']); ?></p>
                            <p>Likes: <span id="like-count-<?php echo $post['id']; ?>"><?php echo $post['likes']; ?></span></p>
                            
                            <!-- Single like form for each post -->
                            <form action="" method="POST" class="like-form">
                                <input type="hidden" name="post_id" value="<?php echo $post['id']; ?>">
                                <button type="submit" name="like">Like</button>
                            </form>

                            <div class="comments">
    <?php
    try {
        $comments = $controller->fetchComments($post['id']);
        foreach ($comments as $comment): ?>
            <div class="comment-item">
                <p><?php echo htmlspecialchars($comment['comment']); ?></p>
                <!-- Delete Comment Button -->
                <form action="" method="POST" style="display:inline;">
                    <input type="hidden" name="comment_id" value="<?php echo $comment['id']; ?>">
                    <button type="submit" name="delete_comment">Delete Comment</button>
                </form>
                <!-- Modify Comment Button -->
                <button onclick="toggleModifyField('<?php echo $comment['id']; ?>')">Modify</button>
                <form action="" method="POST" id="modify-form-<?php echo $comment['id']; ?>" style="display:none;">
                    <input type="hidden" name="comment_id" value="<?php echo $comment['id']; ?>">
                    <input type="text" name="modified_comment" placeholder="Modify comment" required>
                    <button type="submit" name="modify_comment">Save</button>
                </form>
            </div>
        <?php endforeach;
    } catch (Exception $e) {
        echo "<p>Error fetching comments: " . htmlspecialchars($e->getMessage()) . "</p>";
    }
    ?>
    <form action="" method="POST">
        <input type="hidden" name="post_id" value="<?php echo $post['id']; ?>">
        <textarea name="comment_text" placeholder="Write a comment" required></textarea>
        <button type="submit" name="add_comment">Comment</button>
    </form>
</div>

<script>
function toggleModifyField(commentId) {
    const modifyForm = document.getElementById(`modify-form-${commentId}`);
    if (modifyForm.style.display === "none" || modifyForm.style.display === "") {
        modifyForm.style.display = "block"; // Show the modify form
    } else {
        modifyForm.style.display = "none"; // Hide the modify form
    }
}
</script>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No posts available.</p>
                <?php endif; ?>
            </section>
        </main>

        <?php include 'partials/footer.php'; ?>
    </div>
</body>
</html>