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

    // https://symfony.com/doc/current/testing.html#functional-tests
    public function testShowPost()
    {
        $client = static::createClient();

        $client->request('GET', '/post/hello-world');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testSecuredHello()
    {
        $client = static::createClient();
        $session = $client->getContainer()->get('session');

        $firewallName = 'secured_area';

        $authenticationManager= $client->getContainer()->get('public.authentication.manager');
        $token = $authenticationManager->authenticate(
            new UsernamePasswordToken(
                'test','test',
                $firewallName
            ));

        $session->set('_security_' . $firewallName, serialize($token));
        $session->save();

        $cookie = new Cookie($session->getName(), $session->getId());
        $client->getCookieJar()->set($cookie);
        $crawler = $client->request('GET', '/');

        $this->assertSame('homepage: test', $crawler->filter('h1')->text());
    }

    public function testYourAction()
    {
        $client = static::createClient();

        $user = null;//todo: load user for test from DB here

        /** @var Session $session */
        $session = $client->getContainer()->get('session');

        $firewall = 'main';
        $token = new UsernamePasswordToken($user, null, $firewall, $user->getRoles());
        $session->set('_security_'.$firewall, serialize($token));
        $session->save();

        $cookie = new Cookie($session->getName(), $session->getId());
        $this->client->getCookieJar()->set($cookie);

        $crawler = $client->request('GET', '/your_url');

        $response = $this->client->getResponse();
        $this->assertEquals(200, $response->getStatusCode());

        //todo: do other assertions. For example, check that some string is present in response, etc..
    }

    public function testGetMessages()
    {
        $client = static::createClient();

        $client->request('GET', '/post/hello-world');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
}