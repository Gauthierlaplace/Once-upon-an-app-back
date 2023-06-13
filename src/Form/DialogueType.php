<?php

namespace App\Form;

use App\Entity\Dialogue;
use App\Entity\Npc;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DialogueType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('content', TextareaType::class, ["label" => "Contenu du Dialogue de NPC"])
            ->add('npc', EntityType::class, [
                "multiple" => false,
                "expanded" => false,
                "class" => Npc::class,
                'label' => "Personnage non joueur"
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Dialogue::class,
            "attr" => ["novalidate" => 'novalidate']
        ]);
    }
}
