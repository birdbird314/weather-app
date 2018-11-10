<?php

namespace AppBundle\Service;

use AppBundle\Entity\User;
use AppBundle\Repository\UserRepository;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserService
{
    /** @var UserRepository */
    private $repository;
    /** @var UserPasswordEncoderInterface */
    private $encoder;

    public function __construct(UserRepository $repository, UserPasswordEncoderInterface $encoder) {
        $this->repository = $repository;
        $this->encoder = $encoder;
    }

    public function register($username, $password)
    {
        $user = new User();
        $encodedPassword = $this->encoder->encodePassword($user, $password);
        $user
            ->setUsername($username)
            ->setPassword($encodedPassword)
            ->setRole('ROLE_USER');
        $this->repository->add($user);
    }
}