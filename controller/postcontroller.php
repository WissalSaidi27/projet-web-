<?php
require_once __DIR__ . '/../model/Post1.php'; // Include the model file

class PostController {
    private $postModel;

    public function __construct() {
        $this->postModel = new Post1(); // Instantiate the Post model
    }

    // Method to upload a new post
    public function uploadPost($imagePath, $comment) {
        $this->postModel->createPost($imagePath, $comment);  // Call the model method to create a new post
    }

    // Method to like a post
    public function likePost($postId) {
        $this->postModel->incrementLikes($postId);
        // Fetch the updated like count
        return $this->postModel->getLikesCount($postId);
    }

    // Method to modify a comment
    public function modifyComment($commentId, $modifiedComment) {
        // Validate and sanitize inputs
        $commentId = filter_var($commentId, FILTER_VALIDATE_INT);
        if ($commentId === false) {
            throw new Exception("Invalid comment ID.");
        }

        $modifiedComment = trim($modifiedComment);
        if (empty($modifiedComment)) {
            throw new Exception("Comment cannot be empty.");
        }

        // Delegate the update to the model
        $this->postModel->updateComment($commentId, $modifiedComment);
    }

    // Method to add a comment to a post
    public function addComment($postId, $commentText) {
        $this->postModel->addComment($postId, $commentText);  // Call the model method to add a comment
    }

    // Method to remove a post
    public function removePost($postId) {
        $this->postModel->deletePost($postId);
    }

    // Method to toggle post visibility
    public function togglePostVisibility($postId) {
        $this->postModel->toggleVisibility($postId); // Delegate to the model
    }

    // Method to remove a comment
    public function removeComment($commentId) {
        $this->postModel->deleteComment($commentId);
    }

    // Method to fetch all posts
    public function fetchPosts() {
        return $this->postModel->getAllPosts();  // Call the model method to fetch all posts
    }

    // Method to fetch comments for a specific post
    public function fetchComments($postId) {
        return $this->postModel->getCommentsByPostId($postId);  // Call the model method to fetch comments for a specific post
    }

    // Method to search for posts by ID
    public function searchPostsById($id) {
        $id = filter_var($id, FILTER_VALIDATE_INT);
        if ($id === false) {
            throw new Exception("Invalid Post ID.");
        }
        return $this->postModel->searchPostById($id);
    }
}
?>
