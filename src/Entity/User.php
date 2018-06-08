<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @ORM\Column(type="string", length=255, unique=true)
     * @Assert\NotBlank()
     */
    private $username;
    /**
     * @ORM\Column(type="string", length=255, unique=true)
     * @Assert\NotBlank()
     * @Assert\Email()
     */
    private $email;
    /**
     * @Assert\NotBlank()
     * @Assert\Length(max=4096)
     */
    private $plainPassword;
    /**
     * @ORM\Column(type="string", length=64)
     */
    private $password;
    /**
     * @ORM\OneToMany(targetEntity="Post", mappedBy="user")
     */
    private $posts;
    /**
     * @ORM\OneToMany(targetEntity="Comment", mappedBy="user")
     */
    private $comments;

    /**
     * @ORM\Column(type="json_array")
     */
    private $roles=array();
    
    public function __construct()
    {
        $this->comments = new ArrayCollection();
        $this->posts = new ArrayCollection();
        //$this->roles[] = array('ROLE_USER');
    }

    /**
     * @return mixed
     */
    public function getPosts()
    {
        return $this->posts;
    }

    /**
     * @param mixed $posts
     */
    public function setPosts(Post $posts)
    {
        $this->posts = $posts;
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
    public function setComments(Comment $comments)
    {
        $this->comments = $comments;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    /**
     * @param mixed $plainPassword
     */
    public function setPlainPassword($plainPassword)
    {
        $this->plainPassword = $plainPassword;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }

    /**
     * @param mixed $roles
     */
    public function setRoles(array $roles)
    {
        $this->roles = $roles;
    }

    public function getRoles()
    {
        return $this->roles;
        //return array('ROLE_USER','ROLE_ADMIN');
    }
    public function getSalt()
    {
        // TODO: Implement getSalt() method.
    }
    public function __toString()
    {
        return "$this->username";
    }
    public function commentsCount()
    {
        return $this->comments->count();
    }
    public function postCount()
    {
        return $this->posts->count();
    }



}
