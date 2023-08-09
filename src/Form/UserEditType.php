<?php

namespace App\Form;

use App\Entity\Picture;
use App\Entity\User;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Regex;

class UserEditType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'label' => 'Email',
                "attr" => ["placeholder" => "hello@world.io"],
                "empty_data" => ''
            ])
            ->add('roles', ChoiceType::class,  [
                "label" => 'Attribuer des rôles',
                "expanded" => true,
                "multiple" => true,
                "choices" => [
                    "Administrateur" => 'ROLE_ADMIN',
                    "Game Master" => 'ROLE_GAMEMASTER',
                    "Visiteur" => 'ROLE_VISITOR',
                    "Joueur" => 'ROLE_PLAYER',
                ],
            ])

            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'Les mots de passe doivent correspondre.',
                'mapped' => false,
                'first_options' => [
                    'label' => 'Mot de passe',
                    'attr' => [
                        'placeholder' => 'Laisser vide pour ne pas modifier...'
                    ],
                ],
                'second_options' => [
                    'label' => 'Confirmer le mot de passe',
                    'attr' => [
                        'placeholder' => 'Laisser vide pour ne pas modifier...'
                    ],
                ],
                'constraints' => [
                    new Regex(
                        "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{4,}$/",
                        "Le mot de passe doit contenir au moins une majuscule, une minuscule, un chiffre et un caractère spécial."
                    ),
                ],
                ])




            ->add('pseudo', TextType::class, [
                'label' => 'Nom d\'utilisateur',
                "empty_data" => ''
            ])
            ->add('avatar', EntityType::class, [
                "multiple" => false,
                "expanded" => false,
                "class" => Picture::class,
                'label' => "Avatar de l'utilisateur",
                'placeholder' => 'Sélectionnez une image',
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('p')
                        ->orderBy('p.name', 'ASC');
                },
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            "attr" => ["novalidate" => 'novalidate']
        ]);
    }
}
