<?php

namespace App\Services;

use App\Entity\User;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class MailServices
{
    /** @var MailerInterface */
    private $mailer;

    /**
     * comme l'injection de dépendance va créer ce service
     * elle va être capable de détecter l'injection de dépendance dans le constructeur
     *
     * @param MailerInterface $mailerInterface
     */
    public function __construct(MailerInterface $mailerInterface)
    {
        $this->mailer = $mailerInterface;
    }

    
    public function newUserConfirm(User $user)
    {
        $newMail = new Email();
        
        $newMail->from("team@rpg-adventure.com")
                ->to($user->getEmail())
                ->subject("Création de Compte Utilisateur")
                ->text('Bonjour ' .$user->getPseudo() . ', vous venez de créer votre compte avec succès')
                ->html('Bienvenue sur Once upon an app ! Nous vous souhaitons de prendre du plaisir à jouer !');

        $this->mailer->send($newMail);
    }

}