<?php

namespace App\Form;

use App\Entity\Type;
use App\Entity\Gender;
use App\Repository\TypeRepository;
use App\Repository\GenderRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;


class MovieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class, [
                'label' => 'Nom',
                'constraints' => [
                    new NotBlank(),
                ]
            ])
            ->add('picture', FileType::class, [
                'label' => 'image',
                'constraints' => [
                        new File([
                            'maxSize' => '4096k',
                            'mimeTypes' => [
                                'image/png',
                                'image/jpeg',
                            ],
                            'mimeTypesMessage' => 'Le fichier n\'est pas au bon format (formats acceptés: .png, .jpg, .jpeg)',
                        ]),
                    ]
            ])
            ->add('genres', EntityType::class, [
                'class' => Gender::class,
                'choice_label' => 'genre',
                // Order by
                // @see https://symfony.com/doc/current/reference/forms/types/entity.html#using-a-custom-query-for-the-entities
                'query_builder' => function (GenderRepository $er) {
                    return $er->createQueryBuilder('g')
                        ->orderBy('g.name', 'ASC');
                },        
                'multiple' => true,

                'expanded' => true,
                'constraints' => [
                    new NotBlank(),
                ],
            ])
            ->add('type', EntityType::class, [
                'class' => Type::class,
                'choice_label' => 'type',
                'query_builder' => function (TypeRepository $er) {
                    return $er->createQueryBuilder('t')
                        ->orderBy('t.name', 'ASC');
                },        
                'multiple' => true,

                'expanded' => true,
                'constraints' => [
                    new NotBlank(),
                ],
            ])
            ->add('status', ChoiceType::class, [
                'label' =>'statuts',
                'choices' => [
                    'dispo pour échange' => 1,
                    'dispo pour prêt' => 2,
                    'pas dispo' => 3,
                ],
                'constraints' => [
                    new NotBlank(),  
                ],
            ])
            ->add('state', ChoiceType::class, [
                'label' =>'état',
                'choices' => [
                    'excellent' => 1,
                    'bon' => 2,
                    'moyen' => 3,
                ],
                'constraints' => [
                    new NotBlank(),  
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Movie::class,
        ]);
    }
}
