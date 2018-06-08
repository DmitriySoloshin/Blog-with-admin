<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CommentRepository")
 */
class Comment
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @ORM\Column(type="text", length=255)
     */
    private $text;
    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="comments")
     */
    private $user;
    /**
     * @ORM\ManyToOne(targetEntity="Post", inversedBy="comments")
     */
    private $post;
    /**
     * @ORM\Column(type="boolean")
     */
    private $active;
    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    public function __construct()
    {
        $this->created_at= new \DateTime();
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->created_at->format('d-m-Y H:i:s');
    }

    /**
     * @param mixed $created_at
     */
    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;
    }

    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param mixed $text
     */
    public function setText($text)
    {
        $this->text = $text;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser(User $user)
    {
        $this->user = $user;
    }

    /**
     * @return mixed
     */
    public function getPost()
    {
        return $this->post;
    }

    /**
     * @param mixed $post
     */
    public function setPost(Post $post)
    {
        $this->post = $post;
    }

    /**
     * @return mixed
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * @param mixed $active
     */
    public function setActive($active)
    { 
        $this->active = $active;
    }
    public function __toString()
    {

        return "$this->text";
    }

}
