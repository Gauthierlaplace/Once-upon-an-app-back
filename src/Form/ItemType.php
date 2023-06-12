<?php

namespace App\Form;

use App\Entity\Item;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ItemType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, ["label" => "Nom de l'objet"])
            ->add('picture', TextType::class, ["label" => "Image de l'objet"])
            ->add('health', NumberType::class, ["label" => "Santé"])
            ->add('strength', NumberType::class, ["label" => "Force"])
            ->add('intelligence', NumberType::class, ["label" => "Intelligence"])
            ->add('dexterity', NumberType::class, ["label" => "Dextérité"])
            ->add('defense', NumberType::class, ["label" => "Défense"])
            ->add('karma', NumberType::class, ["label" => "Karma"])
            ->add('xp', NumberType::class, ["label" => "Expérience"])
            // ->add('heroes')
            // ->add('npcs')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Item::class,
            "attr" => ["novalidate" => 'novalidate']
        ]);
    }
}
