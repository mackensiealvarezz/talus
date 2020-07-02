<?php

namespace Mackensiealvarezz\Talus\Task;

use Mackensiealvarezz\Talus\Client\Client;

class Task
{

    public $client;

    public function __construct()
    {
        $this->client = new Client();
    }
}
