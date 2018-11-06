<?php

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
/**
 * Created by PhpStorm.
 * User: QuanDar
 * Date: 18/10/2018
 * Time: 10:32
 */

class MessageControllerTest extends WebTestCase
{
    public function testDeleteAllMessagesFromPoster()
    {
        $client = static::createClient();

        $client->request('GET', '/message/poster/delete');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testPostCategory()
    {
        $client = static::createClient();

        $client->request('GET', '/category/add');

        $this->assertEquals(201, $client->getResponse()->getStatusCode());
    }

    public function testGetCategories()
    {
        $client = static::createClient();

        $client->request('GET', '/message/categories');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testGetMessage()
    {
        $client = static::createClient();

        $client->request('GET', '/message/getAll');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testGetMessages()
    {
        $client = static::createClient();

        $client->request('GET', '/message/getAll');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testSearchMessages()
    {
        $client = static::createClient();

        $client->request('GET', '/message/searchmessage');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testPostMessage()
    {
        $client = static::createClient();

        $client->request('GET', '/message/post');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testUpdateMessage()
    {
        $client = static::createClient();

        $client->request('GET', '/message/post');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testDownVoteMessage()
    {
        $client = static::createClient();

        $client->request('GET', '/message/downVoteMessage');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testUpVoteMessage()
    {
        $client = static::createClient();

        $client->request('GET', '/message/upVoteMessage');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testDeleteMessage()
    {
        $client = static::createClient();

        $client->request('GET', '/message/delete');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testPostComment()
    {
        $client = static::createClient();

        $client->request('GET', '/message/comment/post');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testUpdateComment()
    {
        $client = static::createClient();

        $client->request('GET', '/message/comment/update');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testDeleteComment()
    {
        $client = static::createClient();

        $client->request('GET', '/message/comment/delete');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
}