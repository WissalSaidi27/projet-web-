<?php
include "../Model/Post.php";
include "../Controller/PostController.php";

if (isset($_POST["submit"])) {
    $id_client = 1; // Example user ID, replace with actual session data
    $comments = $_POST["comments"];

    if (!empty($_FILES["image"]["name"])) {
        $image = $_FILES["image"]["name"];
        $target = "../uploads/" . basename($image);

        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target)) {
            $post = new Post($id_client, $target, $comments);
            $postController = new PostController();
            $postController->addPost($post);
            header("Location: postList.php");
        } else {
            echo "Failed to upload image.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Post</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form action="" method="POST" enctype="multipart/form-data">
        <label for="image">Upload Image:</label>
        <input type="file" name="image" accept="image/*">
        <label for="comments">Comment:</label>
        <textarea name="comments" rows="4" cols="40"></textarea>
        <button type="submit" name="submit">Post</button>
    </form>
</body>
</html>
