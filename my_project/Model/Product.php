<?php

class Post
{
    private $id_post;
    private $id_client;
    private $contenu_post;
    private $comments;
    private $likes;

    public function __construct($id_client, $contenu_post, $comments = null, $likes = 0)
    {
        $this->id_client = $id_client;
        $this->contenu_post = $contenu_post;
        $this->comments = $comments;
        $this->likes = $likes;
    }

    public function getIdPost()
    {
        return $this->id_post;
    }

    public function getIdClient()
    {
        return $this->id_client;
    }

    public function setIdClient($id_client)
    {
        $this->id_client = $id_client;
    }

    public function getContenuPost()
    {
        return $this->contenu_post;
    }

    public function setContenuPost($contenu_post)
    {
        $this->contenu_post = $contenu_post;
    }

    public function getComments()
    {
        return $this->comments;
    }

    public function setComments($comments)
    {
        $this->comments = $comments;
    }

    public function getLikes()
    {
        return $this->likes;
    }

    public function setLikes($likes)
    {
        $this->likes = $likes;
    }
}
