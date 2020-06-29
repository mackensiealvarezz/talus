<?php

namespace Mackensiealvarezz\Talus\Console;

use Illuminate\Console\GeneratorCommand;

class MakeTaskCommand extends GeneratorCommand
{
    use withStub;

    protected $name = 'talus:task';

    protected $description = 'Create a new Talus Task';


    protected $type = 'Task';


    protected function getStub()
    {
        return $this->resolveStubPath('/stubs/make.task.stub');
    }


    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\Tasks';
    }


    protected function buildClass($name)
    {
        $replace = [];

        return str_replace(
            array_keys($replace),
            array_values($replace),
            parent::buildClass($name)
        );
    }
}
