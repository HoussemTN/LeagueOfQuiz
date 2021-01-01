<?php
namespace App\DataFixtures;

use AppBundle\Entity\Question;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\ORMFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // create 20 products! Bam!
        for ($i = 1; $i < 22; $i++) {

            $question = new Question();
            $question->SetRank($i);
            $question->setResponse($i);
            $question->setReward(rand(100,250));
            $question->setImage1("1.JPG");
            $question->setImage2("2.JPG");
            $question->setImage3("3.JPG");
            $question->setImage4("4.JPG");
            $question->setHint("test");
            $manager->persist($question);
        }

        $manager->flush();
    }
}

