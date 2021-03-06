<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, [
                'label' => 'Email : ',
                'constraints' => [
                    new NotBlank()
                ]
            ])
            ->add('nickname', TextType::class, [
                'label' => 'Pseudo : ',
                'constraints' => [
                    new NotBlank(),
                ]
            ])
            ->add('zipcode', TextType::class, [
                'label'=>"Code postal : ",
                'constraints' => new Regex('/[0-9]{5}/'),
                'help' => 'Un code postal doit avoir 5 chiffres',
            ])
            
            ->add('roles', ChoiceType::class, [
                'choices' => [
                    'Utilisateur' => 'ROLE_USER',
                    'Manager' => 'ROLE_MANAGER',
                    'Administrateur' => 'ROLE_ADMIN',
                ],
                'constraints' => [
                    new NotBlank(),
                ],
                'label' => 'Rôles : ',
                'multiple' => true,
                'expanded' => true,
            ])

            ->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {

                $user = $event->getData();
                $form = $event->getForm();

                if ($user->getId() === null) {
                    $form->add('password', PasswordType::class, [
                        'empty_data' => '',
                        'constraints' => [
                            new Regex('/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[-+!*$@%_])([-+!*$@%_\w]{8,16})$/'),
                        ],
                        'label' => 'Mot de passe *',
                        'help' => 'Entre 8 et 16 caractères, une majuscule, une minuscule, un chiffre, $@%*+-_!',
                    ]);
                } else {
                    $form->add('password', PasswordType::class, [
                        'empty_data' => '',
                        'attr' => [
                            'placeholder' => 'Laissez vide si inchangé',
                        ],
                        'constraints' => [
                        new Regex('/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[-+!*$@%_])([-+!*$@%_\w]{8,16})$/'),
                    ],
                        'label' => 'Mot de passe *',
                        'help' => 'Entre 8 et 16 caractères, une majuscule, une minuscule, un chiffre, $@%*+-_!',
                            'mapped' => false,
                        ]);
                }
        })
    ;        
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}