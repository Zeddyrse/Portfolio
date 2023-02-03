<?php

namespace App\Form;

use App\Entity\Experience;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ExperienceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
            'attr' => [
                'class' => 'form-control'
            ],
            ])
            ->add('compagny', TextType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
            ])
            ->add('description', TextType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
            ])
            ->add('startedAt', DateType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
            ])
            ->add('endedAt',  DateType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
            ])
            ->add('save', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-secondary ',],
                'label' => 'Soumettre',
            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Experience::class,
        ]);
    }
}
