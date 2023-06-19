<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class Rpg extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // USERS Fixtures
        $admin = new User();
        $admin->setEmail("pierre@admin.com");
        $admin->setPassword('$2y$13$h5/TrGHUNtiCzOSAVmfV..0KJllcpnPiB90XzVq0z86jPuehUQq0m');
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setPseudo('Pierre');
        $manager->persist($admin);

        $admin2 = new User();
        $admin2->setEmail("anthony@admin.com");
        $admin2->setPassword('$2y$13$h5/TrGHUNtiCzOSAVmfV..0KJllcpnPiB90XzVq0z86jPuehUQq0m');
        $admin2->setRoles(['ROLE_ADMIN']);
        $admin2->setPseudo('Anthony');
        $manager->persist($admin2);

        $gameMaster = new User();
        $gameMaster->setEmail("marine@gameMaster.com");
        $gameMaster->setPassword('$2y$13$LMDD1/gH0ONyuexKiVsxxu52Yx5p5q98qmmTOBgh11PcdXzUt4pf6');
        $gameMaster->setRoles(['ROLE_GAMEMASTER']);
        $gameMaster->setPseudo('Marine');
        $manager->persist($gameMaster);

        $gameMaster2 = new User();
        $gameMaster2->setEmail("sandra@gameMaster.com");
        $gameMaster2->setPassword('$2y$13$LMDD1/gH0ONyuexKiVsxxu52Yx5p5q98qmmTOBgh11PcdXzUt4pf6');
        $gameMaster2->setRoles(['ROLE_GAMEMASTER']);
        $gameMaster2->setPseudo('Sandra');
        $manager->persist($gameMaster2);

        $gameMaster3 = new User();
        $gameMaster3->setEmail("gauthier@gameMaster.com");
        $gameMaster3->setPassword('$2y$13$LMDD1/gH0ONyuexKiVsxxu52Yx5p5q98qmmTOBgh11PcdXzUt4pf6');
        $gameMaster3->setRoles(['ROLE_GAMEMASTER']);
        $gameMaster3->setPseudo('Gauthier');
        $manager->persist($gameMaster3);

        $player = new User();
        $player->setEmail("player@player.com");
        $player->setPassword('$2y$13$4dAjM04jIL1RxKLjZAkH/OJ0e6wPE4wSwrSP1ZnlvFN7TnBkZ5ZpK');
        $player->setRoles(['ROLE_PLAYER']);
        $player->setPseudo('Player');
        $manager->persist($player);

        // xxx Fixture

        $manager->flush();
    }
}

