<?php
// Include your database configuration
require_once '../config.php'; // Adjust the path if necessary

// Admin access check
$adminKey = '123';

if (!isset($_GET['key']) || $_GET['key'] !== $adminKey) {
    die("Access denied. Invalid key.");
}

// Handle post deletion
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['delete_post'])) {
        $postId = $_POST['post_id'];
        try {
            $stmt = $pdo->prepare("DELETE FROM posts WHERE id = :id");
            $stmt->execute(['id' => $postId]);
            header('Location: admin.php?key=123');
            exit();
        } catch (PDOException $e) {
            die("Could not delete post: " . $e->getMessage());
        }
    } elseif (isset($_POST['toggle_visibility'])) {
        $postId = $_POST['post_id'];
        try {
            $stmt = $pdo->prepare("UPDATE posts SET is_hidden = NOT is_hidden WHERE id = :id");
            $stmt->execute(['id' => $postId]);
            header('Location: admin.php?key=123');
            exit();
        } catch (PDOException $e) {
            die("Could not update post visibility: " . $e->getMessage());
        }
    }
}

// Fetch posts from the database
try {
    $stmt = $pdo->query("SELECT id, comment AS title, likes, is_hidden FROM posts");
    $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Could not retrieve posts: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" type="text/css" href="admin.css"> <!-- Link to your CSS file -->
</head>
<body>
    <h1>Admin Dashboard</h1>
    <h2>Manage Posts</h2>
    
    <table>
        <tr>
            <th>Post ID</th>
            <th>Title</th>
            <th>Likes</th>
            <th>Visibility</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($posts as $post): ?>
            <tr>
                <td><?php echo $post['id']; ?></td>
                <td><?php echo htmlspecialchars($post['title']); ?></td>
                <td><?php echo $post['likes']; ?></td>
                <td><?php echo $post['is_hidden'] ? 'Hidden' : 'Visible'; ?></td>
                <td>
                    <!-- Delete Post Button -->
                    <form action="" method="POST" style="display:inline;">
                        <input type="hidden" name="post_id" value="<?php echo $post['id']; ?>">
                        <button type="submit" name="delete_post">Delete Post</button>
                    </form>
                    <!-- Toggle Visibility Button -->
                    <form action="" method="POST" style="display:inline;">
                        <input type="hidden" name="post_id" value="<?php echo $post['id']; ?>">
                        <button type="submit" name="toggle_visibility">
                            <?php echo $post['is_hidden'] ? 'Unhide Post' : 'Hide Post'; ?>
                        </button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>