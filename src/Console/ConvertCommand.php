<?php

namespace Mackensiealvarezz\Talus\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Mackensiealvarezz\Talus\Talus;
use Symfony\Component\Yaml\Exception\ParseException;
use Symfony\Component\Yaml\Yaml;

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
        $path = $this->viewPath($this->argument('task'));

        //Find the file
        if (!File::exists($path)) {
            $this->error('File not found' . $path);
            return;
        }

        //Vaildate file is YAML
        try {
            $yaml = Yaml::parseFile($path);
        } catch (ParseException $e) {
            $this->error('Unable to parse the YAML: ' . $e->getMessage());
        }
        //Parse
        $parse = Talus::parse($yaml);

        dd($parse);
    }

    public function viewPath($view)
    {
        $view = str_replace('.', '/', $view) . '.yaml';
        $path = "resources/tasks/{$view}";
        return $path;
    }
}
