<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Post;
use App\Form\CommentType;
use App\Repository\PostRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MainController extends Controller
{
    /**
     * @Route("/posts", name="posts")
     */
    public function index(Request $request)
    {
        $posts= $this->getDoctrine()->getRepository(Post::class)->findAll();
        return $this->render('posts/posts.html.twig',['posts'=>$posts]);
    }
    /**
     * @Route("post/{id}/comment/create", name="comment")
     */
    public function comment(Request $request,$id)
    {
        $comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $post=$this->getDoctrine()->getRepository(Post::class)->find($id);
            $em=$this->getDoctrine()->getManager();
            $comment->setActive(false);
            $comment->setUser($this->getUser());
            $comment->setPost($post);
            $em->persist($comment);
            $em->flush();

            return $this->redirectToRoute('posts');
        }
        return $this->render('comments/comment.html.twig',['form'=>$form->createView()]);
    }

    /**
     * @Route("/post/{post_id}/comment/{id}/delete", name="delete_comment")
     */
    public function deleteComment($id)
    {
        $comment = $this->getDoctrine()->getRepository(Comment::class)->find($id);
        
        $em = $this->getDoctrine()->getManager();
        $em->remove($comment);
        $em->flush();

        return $this->redirectToRoute('posts');

    }

    /**
     * @Route("/post/{post_id}/comment/{id}/edit", name="edit_comment")
     */
    public function editComment($id,Request $request,$post_id)
    {
        $comment = $this->getDoctrine()->getRepository(Comment::class)->find($id);
        $form=$this->createForm(CommentType::class, $comment);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $post=$this->getDoctrine()->getRepository(Post::class)->find($post_id);
            $em=$this->getDoctrine()->getManager();
            $comment->setActive(false);
            $comment->setUser($this->getUser());
            $comment->setPost($post);
            $em->persist($comment);
            $em->flush();

            return $this->redirectToRoute('posts');
        }
        return $this->render('comments/comment.html.twig',['form'=>$form->createView()]);
    }

    /**
     * @Route("/")
     */
    public function home(){
        return $this->redirectToRoute('posts');
    }

}
