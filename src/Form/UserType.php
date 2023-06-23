<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'label' => 'Email',
                "attr" => ["placeholder" => "hello@world.io"]])
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
            ->add('password', PasswordType::class, [
                'label' => 'Password',
                'constraints' => [
                    new Regex(
                        "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{4,}$/",
                        "Le mot de passe doit contenir au minimum 4 caractères, une majuscule, un chiffre et un caractère spécial"
                    ),
                ],            
                ])
            ->add('pseudo', TextType::class, ['label' => 'Nom d\'utilisateur'])
            ->add('avatar', TextType::class, ["label" => "Avatar"])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            "attr" => ["novalidate" => 'novalidate']
        ]);
    }
}
