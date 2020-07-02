<?php

namespace Mackensiealvarezz\Talus;

use Mackensiealvarezz\Talus\Client\Client;
use Nette\PhpGenerator\ClassType;

class Talus
{
    public static function parse($yaml)
    {
        //
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
}
