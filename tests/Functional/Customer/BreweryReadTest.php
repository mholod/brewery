<?php

namespace App\Tests\Functional\Customer;

use App\Tests\Functional\BreweryTestCase;

class BreweryReadTest extends BreweryTestCase
{
    /** @test */
    public function canReadCustomerDetails()
    {
        $this->client->request('GET', '/brew/1');

        $this->assertResponseIsSuccessful();
        $this->assertJson($this->client->getResponse()->getContent());
        $customer = json_decode($this->client->getResponse()->getContent());

        $this->assertEquals('Sam Speed', $customer->name);
        $this->assertEquals('sam@example.com', $customer->email);
        $this->assertEquals('00000000000', $customer->phone);
    }

    /** @test */
    public function canReadAllCustomerDetails()
    {
        $this->client->request('GET', '/brewery');

        $this->assertResponseIsSuccessful();
        $this->assertJson($this->client->getResponse()->getContent());
        $customer = json_decode($this->client->getResponse()->getContent())[0];

        $this->assertEquals('Sam Speed', $customer->name);
        $this->assertEquals('sam@example.com', $customer->email);
        $this->assertEquals('00000000000', $customer->phone);
    }
}
