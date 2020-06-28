<?php

namespace Mackensiealvarezz\Talus\Console;

use Illuminate\Console\Command;
use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

class MakeCommand extends Command
{
    protected $signature = 'talus:make {view}';
    protected $description = 'Create a new Talus Task';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $view = $this->argument('view');

        $path = $this->viewPath($view);

        $this->createDir($path);

        if (File::exists($path)) {
            $this->error("File {$path} already exists!");
            return;
        }

        //Get stub content
        $content = file_get_contents(__DIR__ . '/stubs/make.task.stub');
        File::put($path, $content);
        //$this->createTask($view);
        $this->info("Task file {$path} created.");
    }

    public function createTask($view)
    {
        Artisan::call("talus:task {$view}");
    }

    public function viewPath($view)
    {
        $view = str_replace('.', '/', $view) . '.yaml';
        $path = "resources/tasks/{$view}";
        return $path;
    }

    public function createDir($path)
    {
        $dir = dirname($path);

        if (!file_exists($dir)) {
            mkdir($dir, 0777, true);
        }
    }
}
