<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CustomersControllerTest extends WebTestCase
{
    protected $client;

    public function setUp()
    {
        $this->client = static::createClient();
        $this->client->followRedirects();
    }

    public function testCreateCustomers()
    {
        $customers = [
            ['name' => 'Lamon', 'age' => 31],
            ['name' => 'Dany', 'age' => 31]
        ];
        $customers = json_encode($customers);

        $this->client->request('POST', '/customers/', [], [], ['CONTENT_TYPE' => 'application/json'], $customers);

        $this->assertTrue($this->client->getResponse()->isSuccessful());
    }

    public function testGetCustomers()
    {
        $this->client->request('GET', '/customers/', [], [], ['CONTENT_TYPE' => 'application/json']);
        $this->assertNotEquals('[]', $this->client->getResponse()->getContent());
    }

    public function testDeleteCustomers()
    {
        $this->client->request('DELETE', '/customers/', [], [], ['CONTENT_TYPE' => 'application/json']);
        $this->assertTrue($this->client->getResponse()->isSuccessful());
    }

}
