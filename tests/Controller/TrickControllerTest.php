<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TrickControllerTest extends WebTestCase
{
    public function testAddTrick()
    {
        $client = static::createClient();
        $crawler = $client->request('POST', '/add');

        $buttonCrawlerNode = $crawler->selectButton('Ajouter');

        $form = $buttonCrawlerNode->form();

        $form['trick[name]'] = 'frontflip';
        $form['trick[description]'] = 'aka Tamedog.A Tamedog is a cartwheel style Front Flip on your 
        snowboard that instantly makes you look pro or like you\'ve been shredding for years.';
        $form['trick[category]']->select('Categorie N°1');
        $form['trick[images][0][uploadFile]']->upload('image.png');
        $form['videos'] = 'https://www.youtube.com/embed/X9DIG3Ux79E';

        $client->submit($form);

        $client->followRedirect();

    }

}