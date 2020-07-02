<?php

namespace Mackensiealvarezz\Talus;

use Exception;
use Mackensiealvarezz\Talus\Client\Client;
use Nette\PhpGenerator\ClassType;

class Talus
{
    public static function parse($yaml)
    {

        //Vaildate yaml

        $class = new ClassType('Demo');

        $class->addMethod('count')
            ->addComment('Count it.')
            ->addComment('@return int')
            ->setFinal()
            ->setProtected()
            ->setBody('return count($items ?: $this->items);')
            ->addParameter('items', []) // $items = []
            ->setReference() // &$items = []
            ->setType('array');
        // array &$items = []
        $client = new Client();
        $crawler = $client->request('GET', 'https://github.com/');
        return $class;
    }

    public static function vaildate($yaml)
    {
        if (!key_exists('base', $yaml))
            throw new Exception("Error Processing Request: 'base' not found", 1);

        if (!key_exists('apis', $yaml))
            throw new Exception("Error Processing Request: 'api' not found", 1);

        if (!is_array($yaml))
            throw new Exception("Error Processing Request: api is not an array", 1);

        foreach ($yaml["apis"] as $i => $api) {
            if (!is_array($api))
                throw new Exception("Error Processing Request: api[$i] is not an array", 1);
            if (!key_exists('namxe', $api))
                throw new Exception("Error Processing Request: api[$i].name does not exist", 1);
        }
    }
}
