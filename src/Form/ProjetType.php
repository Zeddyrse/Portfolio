<?php

namespace App\Form;

use App\Entity\Project;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ProjetType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('name', TextType::class, [
            'attr' => [
                'class' => 'form-control mb-3'
            ],
            'label' => "Ajout d'un nom de projet",
            'label_attr' => [
                'class' => 'mb-2 '
            ]
            ])
            ->add('technology', TextType::class, [
                'attr' => [
                    'class' => 'form-control mb-3'
                ],
                'label' => "Ajout des technologies utilisées",
                'label_attr' => [
                'class' => 'mb-2 '
            ]
            ])
            ->add('description', TextType::class, [
                'attr' => [
                    'class' => 'form-control mb-3'
                ],
                'label' => "Ajout de la description du projet",
                'label_attr' => [
                'class' => 'mb-2 '
            ]
            ])
            ->add('startedAt', DateType::class, [
                'attr' => [
                    'class' => ' mb-3 js-datepicker offset-5 mt-3 ',
                ],
                'label' => "Ajout de la date du commencement du projet",
                'label_attr' => [
                'class' => 'mb-2 '
            ]   
            ])
            ->add('endedAt',  DateType::class, [
                'attr' => [
                    'class' => ' mb-3 js-datepicker offset-5 mt-3 ' 
                ],
                'label' => "Ajout de la date de fin du projet",
                'label_attr' => [
                'class' => 'mb-2 '
            ]
            ])
            ->add('imageFile', VichImageType::class, [
                'attr' => ['class' => 'form-control-file offset-5 mt-3 mb-3 '],
                'label' => "Ajout d'une image du projet",
                'label_attr' => ['form-label']
            ])
            ->add('link', UrlType::class, [
                'attr' => [
                    'class' => 'form-control mb-3'
                ],
                'label' => "Ajout d'un lien gitHub",
                'label_attr' => [
                'class' => 'mb-2 '
            ]
            ])
            ->add('save', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-secondary d-flex justify-content-center mt-5',],
                'label' => 'Soumettre',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Project::class,
        ]);
    }
}
