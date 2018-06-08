<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Post;
use App\Form\PostType;
use Doctrine\ORM\Mapping\PostPersist;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PostController extends Controller
{
    /**
     * @Route("/create_post", name="make_post")
     */
    public function create(Request $request)
    {
        $post = new Post();

        $form = $this->createForm(PostType::class, $post);

        $form->handleRequest($request);

        if( $form->isSubmitted() && $form->isValid())
        {
            $this->addFlash(
                'created', 'Вы создали пост, после проверки администратором он будет отображен'
            );
            $em = $this->getDoctrine()->getManager();
            $post->setUser($this->getUser());
            $em->persist($post);
            $em->flush();

            return $this->redirectToRoute('posts');

        }
        return $this->render('posts/create_post.html.twig',['form'=>$form->createView()]);
    }

    /**
     * @Route("/post/{id}/edit", name="edit_post")
     */
    public function editPost($id, Request $request)
    {
        $post = $this->getDoctrine()->getRepository(Post::class)->find($id);
        $form = $this->createForm(PostType::class,$post);
        $form->handleRequest($request);
        if( $form->isSubmitted() && $form->isValid())
        {
            $this->addFlash('edit' , 'Вы редактировали пост после проверки админом он будет активирован');
            $em = $this->getDoctrine()->getManager();
            $post->setActive(false);
            $em->persist($post);
            $em->flush();

            return $this->redirectToRoute('posts');

        }
        return $this->render('/posts/edit_post.html.twig', ['form'=> $form->createView()]);
    }

    /**
     * @Route("/post/{id}/delete", name="delete_post")
     */
    public function deletePost(Post $post)
    {

        $em = $this->getDoctrine()->getManager();
        $em->remove($post);
        $em->flush();
        $this->addFlash('delete', 'You delete you post, named'.$post->getTitle());
        return $this->redirectToRoute('posts');

    }
}
