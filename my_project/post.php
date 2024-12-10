<?php
// Include database connection
include 'db.php';

// Handle like functionality
if (isset($_POST['like'])) {
    $post_id = intval($_POST['post_id']);
    $conn->query("UPDATE hawes SET likes = likes + 1 WHERE id_post = $post_id");
    header("Location: post.php"); // Redirect to avoid form resubmission
    exit;
}

// Fetch recent posts
$result = $conn->query("SELECT * FROM hawes ORDER BY id_post DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monument Post</title>
    <link rel="stylesheet" href="post.css">
</head>
<body>

    <header>
        <h1>Discover Tunisia's Monuments</h1>
    </header>

    <main>
        <!-- Form for uploading a post -->
        <section class="form-section">
            <h2>Upload a Post</h2>
            <form action="post.php" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="image">Choose an image or enter URL:</label><br>
                    <input type="file" name="image" id="image" accept="image/*"><br>
                    <input type="text" name="image_url" id="image_url" placeholder="Or enter image URL">
                </div>
                <div class="form-group">
                    <label for="commentaire">Add a comment:</label><br>
                    <textarea name="commentaire" id="commentaire" rows="4" cols="40" placeholder="Write something..."></textarea>
                </div>
                <input type="hidden" name="id_client" value="1"> <!-- Set the client ID dynamically -->
                <div class="form-group">
                    <button type="submit" name="submit">Upload</button>
                </div>
            </form>
        </section>

        <!-- Display recent posts -->
        <section class="posts-section">
            <h2>Recent Posts</h2>
            <div class="posts-container">
                <?php if ($result && $result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <div class="post-item">
                            <!-- Post image -->
                            <img src="<?php echo htmlspecialchars($row['contenu_post']); ?>" alt="Post Image">
                            
                            <!-- Post comment -->
                            <p><?php echo htmlspecialchars($row['comments']); ?></p>
                            
                            <!-- Like button and counter -->
                            <form action="post.php" method="POST">
                                <input type="hidden" name="post_id" value="<?php echo $row['id_post']; ?>">
                                <button type="submit" name="like">Like</button>
                                <span>Likes: <?php echo $row['likes']; ?></span>
                            </form>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <p>No posts available. Be the first to share something!</p>
                <?php endif; ?>
            </div>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 Discover Tunisia Monuments</p>
    </footer>

    <script src="post.js"></script> 
</body>
</html>
