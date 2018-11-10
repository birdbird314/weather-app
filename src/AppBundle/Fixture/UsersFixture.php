<?php

namespace AppBundle\Fixture;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use AppBundle\Entity\User;

class UsersFixture extends Fixture
{
    /** @var UserPasswordEncoderInterface */
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder) {
        $this->encoder = $encoder;
    }
    public function load(ObjectManager $manager)
    {
        $admin = new User();
        $adminPassword = $this->encoder->encodePassword($admin, 'pass');
        $admin
            ->setUsername('admin')
            ->setPassword($adminPassword)
            ->setRole('ROLE_ADMIN');

        $regularUser = new User();
        $regularUserPassword = $this->encoder->encodePassword($regularUser, 'pass');
        $regularUser
            ->setUsername('regularUser')
            ->setPassword($regularUserPassword)
            ->setRole('ROLE_USER');
        
        $manager->persist($admin);
        $manager->persist($regularUser);
        $manager->flush();
    }
}