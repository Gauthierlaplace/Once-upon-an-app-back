<?php

namespace App\Form;

use App\Entity\Hero;
use App\Entity\Item;
use App\Entity\Npc;
use App\Entity\Picture;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
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
            ->add('picture', EntityType::class, [
                "multiple" => false,
                "expanded" => false,
                "class" => Picture::class,
                'label' => "Image de l'item",
                'placeholder' => 'Sélectionnez une image',
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('p')
                        ->orderBy('p.name', 'ASC');
                },
            ])
            ->add('health', NumberType::class, ["label" => "Santé"])
            ->add('strength', NumberType::class, ["label" => "Force"])
            ->add('intelligence', NumberType::class, ["label" => "Intelligence"])
            ->add('dexterity', NumberType::class, ["label" => "Dextérité"])
            ->add('defense', NumberType::class, ["label" => "Défense"])
            ->add('karma', NumberType::class, ["label" => "Karma"])
            ->add('xp', NumberType::class, ["label" => "Expérience"])
            ->add('heroes', EntityType::class, [
                "multiple" => true,
                "expanded" => false,
                "class" => Hero::class,
                "label" => false,
                'attr' => [
                    'style' => 'display: none;', // Masquer visuellement le champ
                ],
            ])
            ->add('npcs', EntityType::class, [
                "multiple" => true,
                "expanded" => false,
                "class" => Npc::class,
                "label" => false,
                'attr' => [
                    'style' => 'display: none;', // Masquer visuellement le champ
                ],
            ])
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
