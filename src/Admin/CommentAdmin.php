<?php
namespace App\Admin;

use App\Entity\Post;
use App\Entity\User;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class CommentAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('text', TextType::class,['label'=>'text of comment']);
        $formMapper->add('post', EntityType::class,[
            'class'=>Post::class,
            'choice_label' => 'title',
        ]);
        $formMapper->add('user', EntityType::class,[
            'class' => User::class,
            'choice_label' => 'username'
        ]);
        $formMapper->add('active', CheckboxType::class,['required'=> false ]);
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('text');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
                ->addIdentifier('user.username', null,['label'=>'Author'])
                ->addIdentifier('text',null,['label'=>'text of comment'])
                ->addIdentifier('post.title',null,['label'=>'Post'])
                ->addIdentifier('created_at')
                ->addIdentifier('active')
                ->addIdentifier('_action','actions',[
                'actions'=>['edit'=> [],'delete'=>[]]]);
    }
}