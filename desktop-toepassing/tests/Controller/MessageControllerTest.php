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

    public function testPostMessageInvalidModel()
    {
        $client = static::createClient();

        $client->request('POST', '/message/post');

        $this->assertEquals(400, $client->getResponse()->getStatusCode());
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

        $client->request('GET', '/message/post');

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

        $this->assertEquals(201, $client->getResponse()->getStatusCode());
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

        $this->assertEquals(200, $response->getStatusCode());

        $data = json_decode($response->getBody(), true);

        $this->assertEquals($messageId, $data['id']);
    }


    public function testUpVoteMessageNoModel()
    {
        $client = static::createClient();

        $client->request('POST', '/message/upVoteMessage');

        $this->assertEquals(201, $client->getResponse()->getStatusCode());
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

        $this->assertEquals(200, $response->getStatusCode());

        $data = json_decode($response->getBody(), true);

        $this->assertEquals($messageId, $data['id']);
    }

    public function testDeleteMessage()
    {
        $client = static::createClient();

        $client->request('GET', '/message/delete');

        $this->assertEquals(302, $client->getResponse()->getStatusCode());
    }

    public function testPostCommentWithModel()
    {
        $commentId = uniqid();

        $response = $this->client->post('/message/comment/post', [
            'json' => [
                'id'    => $commentId,
                'content'     => 'Random message content',
            ]
        ]);

        $this->assertEquals(201, $response->getStatusCode());

        $data = json_decode($response->getBody(), true);

        $this->assertEquals($commentId, $data['id']);
    }

    public function testPostCommentNoModel()
    {
        $client = static::createClient();

        $client->request('POST', '/message/comment/post');

        $this->assertEquals(400, $client->getResponse()->getStatusCode());
    }


    public function testUpdateCommentNoModelBadRequest()
    {
        $client = static::createClient();

        $client->request('POST', '/message/comment/update');

        $this->assertEquals(400, $client->getResponse()->getStatusCode());
    }

    public function testUpdateCommentNoModelPostSuccess()
    {
        $client = static::createClient();

        $client->request('POST', '/message/comment/update');

        $this->assertEquals(400, $client->getResponse()->getStatusCode());
    }

    public function testDeleteComment()
    {
        $client = static::createClient();

        $client->request('DELETE', '/message/comment/delete');

        $this->assertEquals(202, $client->getResponse()->getStatusCode());
    }
}