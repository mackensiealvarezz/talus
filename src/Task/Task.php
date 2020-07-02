<?php

namespace Mackensiealvarezz\Talus\Task;

use Mackensiealvarezz\Talus\Client\Client;
use Symfony\Component\DomCrawler\Crawler;

class Task
{
    public $client;
    public function __construct()
    {
        $this->client = new Client();
        $this->client->setServerParameter('HTTP_USER_AGENT', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:73.0) Gecko/20100101 Firefox/73.0');
    }
    public function filterXPath($path, $type = "text", $value = "")
    {
        return $this->client->getCrawler()->filterXPath($path)->each(function (Crawler $node, $i) use ($type, $value) {
            if ($type == "text") {
                return $node->text($value);
            } elseif ($type == "attr") {
                return $node->attr($value);
            }
        });
    }

    public function formatData(array $data)
    {
        $d = [];
        foreach ($data  as $key => $array) {
            foreach ($array as $i => $value) {
                $d[$i][$key] = $value;
            }
        }
        return $d;
    }
}
