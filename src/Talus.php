<?php

namespace Mackensiealvarezz\Talus;

use Mackensiealvarezz\Talus\Client\Client;

class Talus
{
    public static function parse($yaml)
    {
        //
        $client = new Client();
        $crawler = $client->request('GET', 'https://github.com/');
        return $crawler;
    }
}
