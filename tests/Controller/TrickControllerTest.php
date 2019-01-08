<?php
/**
 * Created by PhpStorm.
 * User: ronsard
 * Date: 08/01/19
 * Time: 00:01
 */

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TrickControllerTest extends WebTestCase
{
    public function testAddTrick()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/add');

        $form = $crawler->selectButton('trick[submit]')->form();
        $form['trick[name]'] = ['backflip'];
        $form['trick[description]'] = ['Figure'];
        $client->submit($form);

        echo $client->getResponse()->getContent();
    }

}