<?php

namespace App\Form;

use App\Entity\Answer;
use App\Entity\Dialogue;
use App\Entity\Effect;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AnswerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('content', TextareaType::class, ["label" => "Contenu de la réponse"])
            ->add('dialogue', EntityType::class, [
                "multiple" => false,
                "expanded" => false,
                "class" => Dialogue::class,
                'label' => "Dialogue"
            ])
            ->add('effect', EntityType::class, [
                "multiple" => true,
                "expanded" => true,
                "class" => Effect::class,
                'label' => "Effets"
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Answer::class,
            "attr" => ["novalidate" => 'novalidate']
        ]);
    }
}
