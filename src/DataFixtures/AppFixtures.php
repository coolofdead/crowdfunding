<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');

        $user = new User();
        $user->setEmail('toto')
            ->setRoles(['ROLE_USER'])
            ->setPassword($this->encoder->encodePassword($user, 'test')) // '$argon2i$v=19$m=16,t=2,p=1$MDAwMDAwMDA$AEVAlhksDscRJAbpK1VPpA'
        ;
        $manager->persist($user);
        
        $manager->flush();
    }
}
