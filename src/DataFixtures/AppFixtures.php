<?php
namespace App\DataFixtures;

use App\Entity\Player;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // create 20 products! Bam!
        for ($i = 0; $i < 20; $i++) {
            $player = new Player();
            $player>setName('player '.$i);
            $player>setUsername('player '.$i);
            $player>setEmail('player '.$i);
            $player>setPassword('player '.$i);
            $manager->persist($player);
        }

        $manager->flush();
    }
}