<?php

namespace Mackensiealvarezz\Talus;

use Exception;
use Illuminate\Support\Str;
use Mackensiealvarezz\Talus\Client\Client;
use Mackensiealvarezz\Talus\Task\Task;
use Nette\PhpGenerator\ClassType;

class Talus
{
    public static function parse($yaml)
    {

        //setup the class
        $class = new ClassType($yaml['name']);
        $class->setExtends(Task::class)
            ->addProperty('base', $yaml['base'])
            ->setPrivate();

        //setup the apis
        foreach ($yaml['apis'] as $api) {
            $method = $class->addMethod($api['name']);
            //Setup parameters for the function
            foreach ($api['url_parameters'] as $param => $value) {
                $method->addParameter($param);
            }
            $method->setBody(self::methodBody($api));
        }

        return $class;
    }

    public static function vaildate($yaml)
    {
        if (!key_exists('name', $yaml))
            throw new Exception("Error Processing Request: 'name' not found", 1);

        if (!key_exists('base', $yaml))
            throw new Exception("Error Processing Request: 'base' not found", 1);

        if (!key_exists('apis', $yaml))
            throw new Exception("Error Processing Request: 'api' not found", 1);

        if (!is_array($yaml))
            throw new Exception("Error Processing Request: api is not an array", 1);

        foreach ($yaml["apis"] as $i => $api) {
            if (!is_array($api))
                throw new Exception("Error Processing Request: api[$i] is not an array", 1);
            if (!key_exists('name', $api))
                throw new Exception("Error Processing Request: api[$i].name does not exist", 1);
        }
    }


    public static function methodBody($api)
    {
        $body = "";
        $body .= "\$data = []; \n";
        $body .= "\$this->client->request('GET', \$this->base ." . self::urlParameters($api) . " ) \n";

        return $body;
    }


    public static function urlParameters($api)
    {
        if ($api['url_parameters'] == null)
            return "";

        $p = "'?";
        foreach ($api['url_parameters'] as $param => $value) {
            $p .= $param . "='.\$" . $param . ".'+'.";
        }
        //remove the extra plus and dot
        $p = substr_replace($p, "", -5);
        return $p;
    }
}
