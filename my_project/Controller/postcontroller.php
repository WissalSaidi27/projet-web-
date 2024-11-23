<?php
require "../config.php";

class PostController
{
    public function addPost($post)
    {
        $sql = "INSERT INTO hawes (id_client, contenu_post, comments, likes) 
                VALUES (:id_client, :contenu_post, :comments, :likes)";
        $conn = config::getConnexion();
        try {
            $query = $conn->prepare($sql);
            $query->execute([
                'id_client' => $post->getIdClient(),
                'contenu_post' => $post->getContenuPost(),
                'comments' => $post->getComments(),
                'likes' => $post->getLikes(),
            ]);
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }

    public function updatePost($post, $id_post)
    {
        $sql = "UPDATE hawes 
                SET contenu_post = :contenu_post, comments = :comments 
                WHERE id_post = :id_post";
        $conn = config::getConnexion();
        try {
            $query = $conn->prepare($sql);
            $query->execute([
                'contenu_post' => $post->getContenuPost(),
                'comments' => $post->getComments(),
                'id_post' => $id_post,
            ]);
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }

    public function deletePost($id_post)
    {
        $sql = "DELETE FROM hawes WHERE id_post = :id_post";
        $conn = config::getConnexion();
        try {
            $query = $conn->prepare($sql);
            $query->execute(['id_post' => $id_post]);
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }

    public function getPostById($id_post)
    {
        $sql = "SELECT * FROM hawes WHERE id_post = :id_post";
        $conn = config::getConnexion();
        try {
            $query = $conn->prepare($sql);
            $query->execute(['id_post' => $id_post]);
            return $query->fetch();
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }

    public function getAllPosts()
    {
        $sql = "SELECT * FROM hawes";
        $conn = config::getConnexion();
        try {
            return $conn->query($sql);
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }
}
