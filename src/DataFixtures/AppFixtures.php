<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Product;
use App\Entity\Country;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $ProductData = [
            ['name' => 'наушники', 'price' => 100],
            ['name' => 'чехол для телефона', 'price' => 20],
        ];
        $CountryData = [
            ['name' => 'Германия', 'prefix'=>'DE', 'tax_percentage' => 19],
            ['name' => 'Италия', 'prefix'=>'IT', 'tax_percentage' => 22],
            ['name' => 'Греция', 'prefix'=>'GR', 'tax_percentage' => 24],
        ];

        foreach ($ProductData as $data) {
            $product = new Product();
            $product->setName($data['name']);
            $product->setPrice($data['price']);
            $manager->persist($product);
        }
        foreach ($CountryData as $data) {
            $country = new Country();
            $country->setPrefix($data['prefix']);
            $country->setName($data['name']);
            $country->setTaxPercentage($data['tax_percentage']);
            $manager->persist($country);
        }

        $manager->flush();
    }
}
