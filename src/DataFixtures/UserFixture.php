<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Utilisateur;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixture extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $user = new Utilisateur();

        $user->setEmail('admin@twyrael.fr');

        $user->setMdp(
            $this->encoder->encodePassword($user, 'twyrael123')
        );

        $user->setNom('admin');
        $user->setPrenom('');
        $user->setPrive(false);

        $manager->persist($user);

        $manager->flush();
    }
}
