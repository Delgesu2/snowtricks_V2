<?php
/**
 * Created by PhpStorm.
 * User: ronsard
 * Date: 08/01/19
 * Time: 15:38
 */

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserControllerTest extends WebTestCase
{
    public function testRegister()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/register');

        $form = $crawler->selectButton('register[submit]')->form();
        $form['register[pseudo]'] = ['Marcel'];
        $form['register[_email]'] = ['marcel@email.com'];
        $form['register[plainPassword]'] = ['Tartelette15'];
        $client->submit($form);

        $client->followRedirect();

        echo $client->getResponse()->getContent();

    }
}