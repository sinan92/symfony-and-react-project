<?php

namespace App\Test\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserControllerTest extends WebTestCase
{
    public function testShowPostUser(){
        $client = static::createClient();

        $client->request('GET', '/user');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
}