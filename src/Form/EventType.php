<?php

namespace App\Form;

use App\Entity\Biome;
use App\Entity\Event;
use App\Entity\EventType as EntityEventType;
use App\Entity\Npc;
use App\Entity\Picture;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EventType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, ["label" => "Titre de l'évènement"])
            ->add('picture', EntityType::class, [
                "multiple" => false,
                "expanded" => false,
                "class" => Picture::class,
                'label' => "Image de l'évènement",
                'placeholder' => 'Sélectionnez une image',
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('p')
                        ->orderBy('p.name', 'ASC');
                },
            ])
            ->add('description', TextareaType::class, ["label" => "Description de L'évènement"])
            ->add('opening', TextareaType::class, ["label" => "Opening"])
            ->add('eventType', EntityType::class, [
                "multiple" => false,
                "expanded" => true,
                "class" => EntityEventType::class,
                "label" => "Type de l'évènement"
            ])
            ->add('biome', EntityType::class, [
                "multiple" => false,
                "expanded" => true,
                "class" => Biome::class,
                'label' => "Biome"
            ])
            ->add('npc', EntityType::class, [
                "multiple" => true,
                "expanded" => false,
                "class" => Npc::class,
                'label' => "Npc"
            ])
            // ->add('heroes', EntityType::class, [
            //     "multiple" => false,
            //     "expanded" => false,
            //     "class" => Hero::class,
            //     'label' => "Héro"
            // ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Event::class,
            "attr" => ["novalidate" => 'novalidate']
        ]);
    }
}
