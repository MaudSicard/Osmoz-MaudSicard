<?php

namespace App\Form;

use App\Entity\Type;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class TypeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('name', TextType::class, [
            'label' => 'Nom du type',
            'constraints' => [
                new NotBlank(),
            ]
        ])
        ->add('media', ChoiceType::class, [
            'constraints' => [
                new NotBlank(),
            ],
            'choices' => [
                'Livre' => 'book',
                'Film' => 'movie',
                'Music' => 'music',
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
            'data_class' => Type::class,
        ]);
    }
}
