<?php

// namespace App\DataFixtures;

// use App\Entity\User;
// use Doctrine\Bundle\FixturesBundle\Fixture;
// use Doctrine\Persistence\ObjectManager;
// use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

// class UserFixture extends Fixture
// {
//     /**
//      * @var UserPasswordEncoderInterface
//      */
//     private $encoder;

//     public function __construct(UserPasswordHasherInterface $encoder)
//     {
//         $this->encoder = $encoder;
//     }

//     public function load(ObjectManager $manager, $encoder): void
//     {
//         $user = new User();
//         $user->setUsername('demo');
//         // $user->setPassword($this->encoder->encodePassword($user, 'demo'));
//         $passwordHash = $encoder->encodePassword($user, $user->getPassword());
//         $user->setPassword($passwordHash);
//         $manager->persist($user);

//         $manager->flush();
//     }
// }
