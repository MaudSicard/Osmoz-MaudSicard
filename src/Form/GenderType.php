<?php

namespace App\Form;

use App\Entity\Gender;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class GenderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('name', TextType::class, [
            'label' => 'Nom du genre : ',
            'constraints' => [
                new NotBlank(),
            ]
        ])
        ->add('media', ChoiceType::class, [
            'constraints' => [
                new NotBlank(),
            ],
            'label' => 'Média : ',
            'choices' => [
                'Livre' => 'book',
                'Film' => 'movie',
                'Musique' => 'music',
            ],
            // Plusieurs choix possibles
            'multiple' => true,
            // Plusieurs éléments de form
            'expanded' => true,
        ])
        
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Gender::class,
        ]);
    }
}