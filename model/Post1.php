<?php
// Include the database connection
require_once __DIR__ . '/../config.php';  // Adjusted path to config.php

class Post1 {
    private $pdo;

    public function __construct() {
        global $pdo;  // Using the global $pdo variable from config.php
        $this->pdo = new PDO('mysql:host=localhost;dbname=monument_site', 'root', '');
    }
    public function searchPostById($id) {
        $query = "SELECT id, comment AS title, likes, is_hidden FROM posts WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(['id' => $id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    

    public function createPost($imagePath, $comment) {
        $query = "INSERT INTO posts (image_path, comment) VALUES (:image_path, :comment)";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([
            ':image_path' => $imagePath,
            ':comment' => $comment,
        ]);
    }
    public function deletePost($postId) {
        $query = "DELETE FROM posts WHERE id = :post_id";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([':post_id' => $postId]);
    }
    
    public function deleteComment($commentId) {
        $query = "DELETE FROM comments WHERE id = :comment_id";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([':comment_id' => $commentId]);
    }
    public function getAllPosts() {
        $query = "SELECT * FROM posts ORDER BY created_at DESC";
        $stmt = $this->pdo->query($query);
        return $stmt->fetchAll();
    }

    public function incrementLikes($postId) {
        $query = "UPDATE posts SET likes = likes + 1 WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([':id' => $postId]);
    }
    
    public function getLikesCount($postId) {
        $query = "SELECT likes FROM posts WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([':id' => $postId]);
        return $stmt->fetchColumn(); // Returns the updated likes count
    }
    

    public function addComment($postId, $comment) {
        $query = "INSERT INTO comments (post_id, comment) VALUES (:post_id, :comment)";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([
            ':post_id' => $postId,
            ':comment' => $comment,
        ]);
    }

    public function getCommentsByPostId($postId) {
        $query = "SELECT * FROM comments WHERE post_id = :post_id ORDER BY created_at ASC";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([':post_id' => $postId]);
        return $stmt->fetchAll();
    }   
    public function updateComment($commentId, $commentText) {
        $query = "UPDATE comments SET comment = :comment WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([
            ':comment' => $commentText,
            ':id' => $commentId,
        ]);
    }
    
}
?>
