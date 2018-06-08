<?php
namespace App\Admin;

use App\Entity\User;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class PostAdmin extends AbstractAdmin
{

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('title', TextType::class)
            ->add('text', TextType::class)
            ->add('active', CheckboxType::class,['required'=> false ])
            ->add('user', EntityType::class,['class' => User::class,
                'choice_label'=>'username',
            ]);
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('text');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        //$listMapper->addIdentifier('countActive');
        $listMapper
            ->addIdentifier('title')
            ->addIdentifier('text')
            ->addIdentifier('user.username')
            ->addIdentifier('created_at')
            ->addIdentifier('countComments')
            ->addIdentifier('active')
            ->addIdentifier('_action','actions',[
                'actions'=>['edit'=> [],'delete'=>[]]
    ]);
    }
    
}