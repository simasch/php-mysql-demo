<?php

namespace hr;

class Configuration
{
    private $ini_array;

    public function __construct()
    {
        $path = dirname(__DIR__) . '/config/application.ini';
        $this->ini_array = parse_ini_file($path);
    }

    public function value(string $key): string
    {
        $value = $this->ini_array[$key];
        return $value;
    }
}