<?php

namespace App\DataFixtures;

use App\Context\Products\Domain\Category;
use App\Context\Products\Domain\ValueObject\Name;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Uid\Uuid;

class CategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < 10; $i++) {
            $id = Uuid::v4();
            $name = Name::fromString('name_'.$i);

            $category = new Category($id, $name);

            $this->addReference('category_'.$i, $category);
            $manager->persist($category);
        }
        $manager->flush();
    }
}
