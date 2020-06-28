<?php

namespace Mackensiealvarezz\Talus\Console;

use Illuminate\Console\Command;

class ConvertCommand extends Command
{

    protected $signature = 'talus:convert {task}';

    protected $description = 'Convert Talus Task to Dusk';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        echo "Testing";
    }
}
