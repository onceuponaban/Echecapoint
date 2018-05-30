<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ChallengeControllerTest extends WebTestCase
{
    public function testChallenge()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/Challenge');
    }

}
