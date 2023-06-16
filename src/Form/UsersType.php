<?php

namespace App\Form;

use App\Entity\Users;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class UsersType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('name', TextType::class, [
            'label' => 'Nombre',
            'attr' => [
                'placeholder' => 'Nombre',
                'autocomplete' => 'off',
                'class' => 'form-control',
                'required' => true
            ]
        ])
        ->add('apellido', TextType::class, [
            'label' => 'Apellido(s)',
            'attr' => [
                'placeholder' => 'Apellido(s)',
                'autocomplete' => 'off',
                'class' => 'form-control',
                'required' => true
            ]
        ])
        ->add('email', EmailType::class, [
            'label' => 'Correo electrónico',
            'attr' => [
                'placeholder' => 'Correo electrónico',
                'autocomplete' => 'off',
                'class' => 'form-control',
                'required' => true
            ]
        ])
        ->add('password', PasswordType::class, [
            'label' => 'Contraseña',
            'attr' => [
                'placeholder' => 'Contraseña',
                'autocomplete' => 'off',
                'class' => 'form-control',
                'required' => true
            ]
        ])
        ->add('submit', SubmitType::class, [
            'label' => 'Guardar',
            'attr' => [
                'class' => 'btn btn-primary'
            ]
        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Users::class,
        ]);
    }
}
