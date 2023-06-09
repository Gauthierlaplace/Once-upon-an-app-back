<?php

namespace App\Form;

use App\Entity\Ending;
use App\Entity\Event;
use App\Entity\EventType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EndingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('content', TextareaType::class, ["label" => "Ending"])
            ->add('event', EntityType::class, [
                "multiple" => false,
                "expanded" => false,
                "class" => Event::class,
                'label' => "Evènement"
            ])
            ->add('eventType', EntityType::class, [
                "multiple" => false,
                "expanded" => true,
                "class" => EventType::class,
                'label' => "Renvoie vers le type d'évènement"
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Ending::class,
            "attr" => ["novalidate" => 'novalidate']
        ]);
    }
}
