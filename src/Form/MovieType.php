<?php

namespace App\Form;

use App\Entity\Type;
use App\Entity\Movie;
use App\Entity\Gender;
use App\Repository\TypeRepository;
use App\Repository\GenderRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class MovieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom',
                'constraints' => [
                    new NotBlank(),
                ]
            ])
            ->add('picture', TextType::class, [
                'label' => 'image',     
            ])
            ->add('gender', EntityType::class, [
                'class' => Gender::class,
                'choice_label' => 'name',
                'query_builder' => function (GenderRepository $er) {
                    return $er->createQueryBuilder('g')
                        ->orderBy('g.name', 'ASC');
                },        
                'multiple' => true,
                'expanded' => true,
            ])
            ->add('type', EntityType::class, [
                'class' => Type::class,
                'choice_label' => 'name',
                'query_builder' => function (TypeRepository $er) {
                    return $er->createQueryBuilder('t')
                        ->orderBy('t.name', 'ASC');
                },        
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