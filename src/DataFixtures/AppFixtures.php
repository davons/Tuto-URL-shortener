<?php

namespace App\DataFixtures;

use App\Factory\UserFactory;
use App\Factory\LinkFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // create 3 User's
        UserFactory::createMany(3);

        // create 10 link's
        LinkFactory::createMany(10);

    }
}
