<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;


class UserPasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('plainPassword', RepeatedType::class, [
            'type' => PasswordType::class,
            'first_options' => [
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Mot de passe',
            ],
            'second_options' => [
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'confirmation du mot de passe',
            ],
            'invalid_message' => 'Les mots de passes ne sont pas identiques'
        ])
        ->add('newPassword', PasswordType::class,[
            'attr' => ['class' => 'form-control'],
            'label' => 'Nouveau mot de passe',
            'label_attr' => ['class' => 'form-label mt-4'],

        ])
        ->add('submit', SubmitType::class, [
            'attr' => [
                'class' => 'mt-3 btn btn-success'
            ]
        ]);
    }
}