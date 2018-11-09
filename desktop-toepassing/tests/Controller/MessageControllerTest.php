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
    public function test_DeleteAllMessagesFromPoster_noModel_200()
    {
        $client = static::createClient();

        $client->request('POST', '/message/poster/delete');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }


    public function testGetMessages()
    {
        $client = static::createClient();

        $client->request('GET', '/message/getAll');

        $this->assertEquals(404, $client->getResponse()->getStatusCode());
    }

    public function testUpdateMessage_noModel()
    {
        $client = static::createClient();

        $client->request('POST', '/message/post');

        $this->assertEquals(400, $client->getResponse()->getStatusCode());
    }

    public function testDownVoteMessage_noModel()
    {
        $client = static::createClient();

        $client->request('POST', '/message/downVoteMessage');

        $this->assertEquals(302, $client->getResponse()->getStatusCode());
    }

    public function testUpVoteMessage_noModel()
    {
        $client = static::createClient();

        $client->request('POST', '/message/upVoteMessage');

        $this->assertEquals(302, $client->getResponse()->getStatusCode());
    }

    public function testDeleteMessage()
    {
        $client = static::createClient();

        $client->request('GET', '/message/delete');

        $this->assertEquals(302, $client->getResponse()->getStatusCode());
    }

    public function testDeleteMessage_postMesasge()
    {
        $client = static::createClient();

        $client->request('POST', '/message/delete');

        $this->assertEquals(302, $client->getResponse()->getStatusCode());
    }

    public function noRouteFound()
    {
        $client = static::createClient();

        $client->request('GET', '/thisIsNotAnRoute');

        $this->assertEquals(404, $client->getResponse()->getStatusCode());
    }
}
