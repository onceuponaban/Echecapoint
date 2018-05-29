<?php
namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use AppBundle\Entity\User;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options){
        $builder->add('username',TextType::class)->add('password',PasswordType::class);
    }
    
    public function configureOptions(OptionsResolver $resolver){
        $resolver->setDefaults([
            'data_class' => User::class
        ]);
    }
    
}

