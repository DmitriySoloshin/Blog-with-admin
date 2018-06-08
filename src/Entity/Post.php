<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Persistence\ObjectManagerAware;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PostRepository")
 */
class Post
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @ORM\Column(type="text", length=50)
     */
    private $title;
    /**
     * @ORM\Column(type="string", length=255)
     */
    private  $text;
    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;
    /**
     * @ORM\Column(type="boolean")
     */
    private $active;
    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="posts")
     */
    private $user;
    /**
     * @ORM\OneToMany(targetEntity="Comment", mappedBy="post")
     */
    private $comments;
    public function __construct()
    {
        $this->comments = new ArrayCollection();
        $this->created_at = new \DateTime();
        $this->active = false;
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
    public function getCreatedAt()
    {
        return $this->created_at->format('H:i:s d-m-Y');
    }

    /**
     * @param mixed $create_date
     */
    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;
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

    public function getId()
    {
        return $this->id;
    }
    /*public function __toString()
    {
        //$a = $this->comments->count();
        //return "$a";
        //return $this->text;

    }*/

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * @param mixed $comments
     */
    public function setComments($comments)
    {
        $this->comments = $comments;
    }
    public function countComments()
    {
        return $this->comments->count();
    }



}
