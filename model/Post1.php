<?php
// Include the database connection
require_once __DIR__ . '/../config.php';  // Adjusted path to config.php

class Post1 {
    private $conn;

    public function __construct() {
        global $conn;  // Using the global $conn variable from config.php
        $this->conn = $conn;
    }

    public function createPost($imagePath, $comment) {
        $stmt = $this->conn->prepare("INSERT INTO posts (image_path, comment) VALUES (?, ?)");
        $stmt->bind_param('ss', $imagePath, $comment);
        $stmt->execute();
    }

    public function getAllPosts() {
        $result = $this->conn->query("SELECT * FROM posts ORDER BY created_at DESC");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function incrementLikes($postId) {
        $stmt = $this->conn->prepare("UPDATE posts SET likes = likes + 1 WHERE id = ?");
        $stmt->bind_param('i', $postId);
        $stmt->execute();
    }

    public function addComment($postId, $comment) {
        $stmt = $this->conn->prepare("INSERT INTO comments (post_id, comment) VALUES (?, ?)");
        $stmt->bind_param('is', $postId, $comment);
        $stmt->execute();
    }

    public function getCommentsByPostId($postId) {
        $stmt = $this->conn->prepare("SELECT * FROM comments WHERE post_id = ? ORDER BY created_at ASC");
        $stmt->bind_param('i', $postId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
?>
