<?php

namespace App\Test\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;


class CommentControllerTest extends WebTestCase
{
    public function testCommentController_200_comment(){
        $client = static::createClient();

        $client->request('GET', '/comment');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());

    }

    public function testCommentController_200_commentUpdate(){
        $client = static::createClient();

        $client->request('GET', '/comment/update');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());

    }

    public function testCommentController_200_commentDelete(){
        $client = static::createClient();

        $client->request('GET', '/comment/delete');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());

    }

    public function testCommentController_getRightPage(){
        $client = static::createClient();

        $crawler = $client->request('GET', '/comment');

        $this->assertSame('Comment Controls', $crawler->filter('h1')->text());

    }
}