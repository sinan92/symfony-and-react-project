<?php
/**
 * Created by PhpStorm.
 * User: QuanDar
 * Date: 25/10/2018
 * Time: 08:53
 */

namespace App\Form;

use App\Entity\Message;
use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MessageForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('id', HiddenType::class)
            ->add('content', TextType::class, array('label' => false))
            ->add('date', HiddenType::class, array('required' => false))
            ->add('upVotes', HiddenType::class, array('required' => false))
            ->add('downVotes', HiddenType::class, array('required' => false))
            ->add('user', UserForm::class, array('label' => false));

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Message::class,
        ]);
    }
}
