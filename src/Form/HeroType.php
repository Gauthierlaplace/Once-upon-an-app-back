<?php

namespace App\Form;

use App\Entity\Hero;
use App\Entity\HeroClass;
use App\Entity\Item;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class HeroType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, ["label" => "Nom du héro"])
            ->add('maxHealth', NumberType::class, ["label" => "Santé Maximum"])
            ->add('health', NumberType::class, ["label" => "Santé"])
            ->add('strength', NumberType::class, ["label" => "Force"])
            ->add('intelligence', NumberType::class, ["label" => "Intelligence"])
            ->add('dexterity', NumberType::class, ["label" => "Dextérité"])
            ->add('defense', NumberType::class, ["label" => "Défense"])
            ->add('karma', NumberType::class, ["label" => "Karma"])
            ->add('xp', NumberType::class, ["label" => "Expérience"])
            ->add('picture', TextType::class, ["label" => "Image du Héro"])
            ->add('progress', NumberType::class, ["label" => "Niveau atteint"])
            ->add('heroClass', EntityType::class, [
                "multiple" => false,
                "expanded" => true,
                "class" => HeroClass::class,
                'label' => "Class"
            ])
            ->add('user', EntityType::class, [
                "multiple" => false,
                "expanded" => false,
                "class" => User::class,
                'label' => "Utilisateur"
            ])

            ->add('item', EntityType::class, [
                "multiple" => true,
                "expanded" => true,
                "class" => Item::class,
                'label' => "Equipements"
            ])

            // ->add('event')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Hero::class,
            "attr" => ["novalidate" => 'novalidate']
        ]);
    }
}
