<?php

namespace App\Tests\Functional;

use App\DataFixtures\AppFixtures;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Liip\TestFixturesBundle\Test\FixturesTrait;

class BreweryTestCase extends WebTestCase
{
    use FixturesTrait;

    protected $endpoint;
    protected $client;

    protected function setUp(): void
    {
        parent::setUp();

        $this->endpoint = '/api/brewery';

        $this->client = static::createClient();

        $this->loadFixtures([
            AppFixtures::class,
        ]);
    }

    public function tearDown(): void
    {
        parent::tearDown();
    }
}
