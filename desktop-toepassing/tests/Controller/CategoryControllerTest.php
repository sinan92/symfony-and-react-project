<?php

namespace App\Test\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Goutte\Client;


class CategoryControllerTest extends WebTestCase
{
//    public function testShowAddCategory(){
//        $client = static::createClient();
//
//        $client->request('GET', '/category/add');
//
//        $this->assertEquals(200, $client->getResponse()->getStatusCode());
//
//    }
//
//    public function testAddCategory(){
//
//        $client = new Client();
//        $crawler = $client->request('GET', 'https://github.com/login');
//
//        $form = $crawler->selectButton('Log in')->form();
//        $form['login'] = 'symfonyfan';
//        $form['password'] = 'anypass';
//
//        $crawler = $client->submit($form);
//        $this->assertTrue($crawler->filter('html:contains("Welcome Back")')->count() > 0);


//        $client = static::createClient();
//        $crawler = $client->request('GET', '/category/add');
//
//        $form  = $crawler->selectButton('submit')->form();
//
//        $form['name'] = 'TestCat';
//
//        $crawler = $client->submit($form, array('name' => 'Test'));
//
//        $this->assertContains('Category added', $client->getResponse()->getContent());
//    }

}