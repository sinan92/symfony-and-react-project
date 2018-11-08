<?php

namespace App\Test\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;


class UserControllerTest extends WebTestCase
{

    public function testUserController_200_user(){
        $client = static::createClient();

        $client->request('GET', '/user');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());

    }

    public function testUserController_200_userAdd(){
        $client = static::createClient();

        $client->request('GET', '/user/post/add');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());

    }

    public function testUserController_200_userUpdate(){
        $client = static::createClient();

        $client->request('GET', '/user/post/update');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());

    }

    public function testUserController_200_userDelete(){
        $client = static::createClient();

        $client->request('GET', '/user/post/delete');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());

    }

    public function testUserController_getRightPage(){
        $client = static::createClient();

        $crawler = $client->request('GET', '/user');

        $this->assertSame('User Controls', $crawler->filter('h1')->text());
    }

}