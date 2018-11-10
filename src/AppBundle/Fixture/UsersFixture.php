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
        $user = new User();
        $password = $this->encoder->encodePassword($user, 'admin');
        $user
            ->setUsername('admin')
            ->setPassword($password);
        
        $manager->persist($user);
        $manager->flush();
    }
}