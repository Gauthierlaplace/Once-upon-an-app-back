<?php

namespace App\Form;

use App\Entity\Answer;
use App\Entity\Effect;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

class EffectType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, ["label" => "Nom de l'effet"])
            ->add('description', TextareaType::class, ["label" => "Description de l'effet"])
            ->add('health', NumberType::class, ["label" => "Santé"])
            ->add('strength', NumberType::class, ["label" => "Force"])
            ->add('intelligence', NumberType::class, ["label" => "Intelligence"])
            ->add('dexterity', NumberType::class, ["label" => "Dextérité"])
            ->add('defense', NumberType::class, ["label" => "Défense"])
            ->add('karma', NumberType::class, ["label" => "Karma"])
            ->add('xp', NumberType::class, ["label" => "Expérience"])
            ->add('answers', EntityType::class, [
                "multiple" => true,
                "expanded" => false,
                "class" => Answer::class,
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
            'data_class' => Effect::class,
            "attr" => ["novalidate" => 'novalidate']
        ]);
    }
}
