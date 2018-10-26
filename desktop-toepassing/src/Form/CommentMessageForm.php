<?php
/**
 * Created by PhpStorm.
 * User: QuanDar
 * Date: 26/10/2018
 * Time: 10:32
 */

namespace App\Form;
use App\Entity\Message;
use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\FormTypeInterface;

class CommentMessageForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('id', HiddenType::class)
            ->add('content', HiddenType::class, array('required' => false))
            ->add('date', HiddenType::class, array('required' => false))
            ->add('upVotes', HiddenType::class, array('required' => false))
            ->add('downVotes', HiddenType::class, array('required' => false))
        ->add('user', CommentUserForm::class, array('required' => false));

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Message::class,
        ]);
    }
}
