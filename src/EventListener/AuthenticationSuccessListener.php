<?php

namespace App\EventListener;

use App\Entity\User;
use Lexik\Bundle\JWTAuthenticationBundle\Event\AuthenticationSuccessEvent;
use Symfony\Component\Security\Core\User\UserInterface;

class AuthenticationSuccessListener
{

  /**
   * Data user directly from JWT Token (route api/login_check)
   * 
   * @param AuthenticationSuccessEvent $event
   */
  public function onAuthenticationSuccessResponse(AuthenticationSuccessEvent $event)
  {
    $data = $event->getData();
    $user = $event->getUser();

    if (!$user instanceof User) {
      return;
    }

    $data['data'] = array(
      'id' => $user->getId(),
      'roles' => $user->getRoles(),
      'email' => $user->getEmail(),
      'pseudo' => $user->getPseudo(),
      'avatar' => $user->getAvatar(),
    );

    $event->setData($data);
  }
}
