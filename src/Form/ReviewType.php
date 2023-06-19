<?php

namespace App\Form;

use App\Entity\Review;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReviewType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, ["label" => "Titre de l'avis"])
            ->add('content', TextareaType::class, ["label" => "Contenu de l'avis"])
            ->add('rating', 
            ChoiceType::class,
            [
                "label" => "Votre note :",
                "choices" => [
                    "Excellent !" => 5,         
                    "Très bon !" => 4,         
                    "Bon !" => 3,       
                    "Moyen !" => 2,         
                    "Décevant !" => 1,
                    "Fuyez ! Pauvre fou !" => 0
                ],
                "multiple" => false,
                "expanded" => true,
            ],)
            ->add('createdAt', 
            DateType::class,
            [
                "label" => "Créé le",
                "widget" => "single_text",
                "input" => "datetime",
            ],)
            ->add('user', EntityType::class, [
                "multiple" => false,
                "expanded" => false,
                "class" => User::class,
                'label' => "Utilisateur"
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Review::class,
            "attr" => ["novalidate" => 'novalidate']
        ]);
    }
}
