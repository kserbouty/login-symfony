<?php

namespace App\DataFixtures;

use App\Entity\Workspace;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class WorkspaceFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $workspace = new Workspace();
        $workspace->setName('Main Projects');
        $workspace->setDescription('Lorem ipsum dolor sit amet.');

        $manager->persist($workspace);
        $manager->flush();
    }
}
