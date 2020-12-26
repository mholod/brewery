<?php

namespace App\DataFixtures;

use App\Entity\Customer;
use App\Entity\Order;
use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $customer = new Customer();
        $customer->setName('Sam Speed');
        $customer->setEmail('sam@example.com');
        $customer->setPhone('00000000000');
        $manager->persist($customer);

        $product =  false;
        for ($i = 1; $i <= 3; $i++) {
            $product = new Product();
            $product->setPrice(100 + $i);
            $product->setCode("{$i}_Code");
            $product->setTitle("$i Title");
            $product->setDescription("$i Lorem ipsum");
            $manager->persist($product);
        }

        $order = new Order();
        $order->setCreatedAt(new \DateTime());
        $order->setCustomer($customer);
        $order->addProduct($product);
        $manager->persist($order);

        $manager->flush();
    }
}
