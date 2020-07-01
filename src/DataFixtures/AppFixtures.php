<?php

namespace App\DataFixtures;

use App\Entity\Payement;
use App\Entity\Project;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');

        $projects = [];
        for ($i = 0; $i < 5; $i++) {
            $project = new Project();

            $project
                ->setName($faker->name)
                ->setStartDate(new DateTime($faker->date()))
                ->setEndDate(new DateTime($faker->date()))
                ->setPicture($faker->url)
                ->setDescription($faker->text())
                ->setGoal($faker->numberBetween(0, 50000))
                ->setCreated(new DateTime($faker->date()))
            ;

            $projects[] = $project;

            $manager->persist($project);
        }

        for ($i = 0; $i < 10; $i++) {
            $payement = new Payement();

            $projectId = rand(0, count($projects) - 1);

            $payement
                ->setDonatorName($faker->name)
                ->setAmount($faker->numberBetween(1, 100))
                ->setComment($faker->text(100))
                ->setPayementDate(new DateTime($faker->date()))
                ->setProject($projects[$projectId])
                ->setCreated(new DateTime($faker->date()))
            ;

            $manager->persist($payement);
        }
        
        $manager->flush();
    }
}
