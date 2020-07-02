<?php

namespace Mackensiealvarezz\Talus\Console;

use Exception;
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
            Talus::vaildate($yaml);
        } catch (ParseException $e) {
            $this->error('Unable to parse the YAML: ' . $e->getMessage());
            return;
        } catch (Exception $e) {
            $this->error($e->getMessage());
            return;
        }

        $parse = Talus::parse($yaml);


        //dd($parse["host"]);

        $this->info($parse);
        //  dd($parse);
    }

    public function viewPath($view)
    {
        $view = str_replace('.', '/', $view) . '.yaml';
        $path = "resources/tasks/{$view}";
        return $path;
    }
}
