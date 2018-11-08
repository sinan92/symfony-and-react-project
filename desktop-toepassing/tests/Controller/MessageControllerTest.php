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
    public function testDeleteAllMessagesFromPosterNoModel()
    {
        $client = static::createClient();

        $client->request('POST', '/message/poster/delete');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testDeleteAllMessagesFromPosterWithModel()
    {
        $messageId = uniqid();

        $response = $this->client->post('/message/poster/delete', [
            'json' => [
                'id'    => $messageId ]
        ]);

        $this->assertEquals(201, $response->getStatusCode());

        $data = json_decode($response->getBody(), true);

        $this->assertEquals($messageId, $data['id']);    }

    public function testGetMessages()
    {
        $client = static::createClient();

        $client->request('GET', '/message/getAll');

        $this->assertEquals(500, $client->getResponse()->getStatusCode());
    }

    public function testPostMessageWithModel()
    {
        $messageId = uniqid();

        $response = $this->client->post('/message/post', [
            'json' => [
                'id'    => $messageId,
                'content'     => 'Random message content',
                'upVotes'    => 2
            ]
        ]);

        $this->assertEquals(201, $response->getStatusCode());

        $data = json_decode($response->getBody(), true);

        $this->assertEquals($messageId, $data['id']);
    }

    public function testUpdateMessageNoModel()
    {
        $client = static::createClient();

        $client->request('POST', '/message/post');

        $this->assertEquals(400, $client->getResponse()->getStatusCode());
    }

    public function testUpdateMessageWithModel()
    {
        $messageId = uniqid();

        $response = $this->client->post('/message/update', [
            'json' => [
                'id'    => $messageId,
                'content'     => "new updated content",
            ]
        ]);

        $this->assertEquals(200, $response->getStatusCode());

        $data = json_decode($response->getBody(), true);

        $this->assertEquals($messageId, $data['id']);
    }

    public function testDownVoteMessageNoModel()
    {
        $client = static::createClient();

        $client->request('POST', '/message/downVoteMessage');

        $this->assertEquals(302, $client->getResponse()->getStatusCode());
    }

    public function testDownVoteMessageWithModel()
    {
        $messageId = uniqid();

        $response = $this->client->post('/message/downVoteMessage', [
            'json' => [
                'id'    => $messageId,
                'downVotes'     => 55,
            ]
        ]);

        $this->assertEquals(302, $response->getStatusCode());

        $data = json_decode($response->getBody(), true);

        $this->assertEquals($messageId, $data['id']);
    }


    public function testUpVoteMessageNoModel()
    {
        $client = static::createClient();

        $client->request('POST', '/message/upVoteMessage');

        $this->assertEquals(302, $client->getResponse()->getStatusCode());
    }

    public function testUpVoteMessageWithModel()
    {
        $messageId = uniqid();

        $response = $this->client->post('/message/upVoteMessage', [
            'json' => [
                'id'    => $messageId,
                'upVotes'     => 33,
            ]
        ]);

        $this->assertEquals(302, $response->getStatusCode());

        $data = json_decode($response->getBody(), true);

        $this->assertEquals($messageId, $data['id']);
    }

    public function testDeleteMessage()
    {
        $client = static::createClient();

        $client->request('GET', '/message/delete');

        $this->assertEquals(302, $client->getResponse()->getStatusCode());
    }

    public function noRouteFound()
    {
        $client = static::createClient();

        $client->request('GET', '/thisIsNotAnRoute');

        $this->assertEquals(404, $client->getResponse()->getStatusCode());
    }
}