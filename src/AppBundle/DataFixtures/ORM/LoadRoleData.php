<?php

namespace Acme\HelloBundle\DataFixtures\ORM;

use AppBundle\Entity\Role;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadGroupData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $roleAdmin = new Role();
        $roleAdmin->setName('admin');
        $roleAdmin->setRole('ROLE_ADMIN');

        $manager->persist($roleAdmin);
        $manager->flush();

        $this->addReference('admin-role', $roleAdmin);

        $roleUser = new Role();
        $roleUser->setName('user');
        $roleUser->setRole('ROLE_USER');

        $manager->persist($roleUser);
        $manager->flush();

        $this->addReference('user-role', $roleUser);
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 1; // the order in which fixtures will be loaded
    }
}