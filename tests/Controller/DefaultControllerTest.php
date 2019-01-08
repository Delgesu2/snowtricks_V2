<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HTTPFoundation\Response;

class DefaultControllerTest extends WebTestCase
{
    public function testHomepage()
    {
        $client = static::createClient();
        $client->request('GET', '/');

        echo $client->getResponse()->getContent();
    }


    public function testTrickspage()
    {
        $client = static::createClient();
        $client->request('GET', '/list');

        echo  $client->getResponse()->getContent();
    }
}