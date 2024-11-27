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
        $this->postModel->incrementLikes($postId);  // Call the model method to increment likes
    }

    // Method to add a comment to a post
    public function addComment($postId, $commentText) {
        $this->postModel->addComment($postId, $commentText);  // Call the model method to add a comment
    }

    // Method to fetch all posts
    public function fetchPosts() {
        return $this->postModel->getAllPosts();  // Call the model method to fetch all posts
    }

    // Method to fetch comments for a specific post
    public function fetchComments($postId) {
        return $this->postModel->getCommentsByPostId($postId);  // Call the model method to fetch comments for a specific post
    }
}
?>
