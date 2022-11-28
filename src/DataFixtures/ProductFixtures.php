<?php

namespace App\DataFixtures;

use App\Context\Products\Domain\Category;
use App\Context\Products\Domain\Product;
use App\Context\Products\Domain\ValueObject\Name;
use App\Context\Products\Domain\ValueObject\Weight;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Uid\Uuid;

class ProductFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $this->addToCategory($manager, 15, $this->getReference('category_0'));
        $this->addToCategory($manager, 30, $this->getReference('category_1'));

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            CategoryFixtures::class,
        ];
    }

    private function addToCategory(ObjectManager $manager, int $number, Category $category) {
        for ($i = 0; $i < $number; $i++) {
            $name = Name::fromString('name_'.$i);
            $description = 'product_'.$i;
            $weight = $this->weight();

            $product = Product::create($name, $description, $weight, $category);

            $manager->persist($product);
        }
    }

    private function weight(): Weight {
        $unit = Weight::UNITS[array_rand(Weight::UNITS, 1)];
        $weight = match ($unit) {
            'g' => rand(10, 999),
            'kg' => rand(1, 100),
        };

        return Weight::fromString(sprintf('%d %s', $weight, $unit));
    }
}
