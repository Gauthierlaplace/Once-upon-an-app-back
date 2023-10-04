<?php

namespace App\Form;

use App\Entity\Event;
use App\Entity\Item;
use App\Entity\Npc;
use App\Entity\Picture;
use App\Entity\Race;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NpcType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, ["label" => "Nom du personnage"])
            ->add('picture', EntityType::class, [
                "multiple" => false,
                "expanded" => false,
                "class" => Picture::class,
                'label' => "Image du personnage",
                'placeholder' => 'Sélectionnez une image',
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('p')
                        ->orderBy('p.name', 'ASC');
                },
            ])
            ->add('description', TextareaType::class, ["label" => "Description du personnage"])
            ->add('maxHealth', NumberType::class, ["label" => "Santé Maximum"])
            ->add('health', NumberType::class, ["label" => "Santé"])
            ->add('strength', NumberType::class, ["label" => "Force"])
            ->add('intelligence', NumberType::class, ["label" => "Intelligence"])
            ->add('dexterity', NumberType::class, ["label" => "Dextérité"])
            ->add('defense', NumberType::class, ["label" => "Défense"])
            ->add('karma', NumberType::class, ["label" => "Karma"])
            ->add('isBoss', ChoiceType::class, [
                "label" => 'Est ce un boss ?',
                "expanded" => true,
                "multiple" => false,
                "choices" => [
                    "Oui" => 1,
                    "Non" => 0,
                ],
            ])
            ->add('hostility', ChoiceType::class, [
                "label" => 'Est ce un ennemi ?',
                "expanded" => true,
                "multiple" => false,
                "choices" => [
                    "Oui" => 1,
                    "Non" => 0,
                ],
            ])
            ->add('xpEarned', NumberType::class, ["label" => "Expérience"])
            ->add('race', EntityType::class, [
                "multiple" => false,
                "expanded" => false,
                "class" => Race::class,
                'label' => "Race"
            ])
            ->add('item', EntityType::class, [
                "multiple" => true,
                "expanded" => true,
                "class" => Item::class,
                'label' => "Equipements"
            ])
            ->add('events', EntityType::class, [
                "multiple" => true,
                "expanded" => false,
                "class" => Event::class,
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
            'data_class' => Npc::class,
            "attr" => ["novalidate" => 'novalidate']
        ]);
    }
}
