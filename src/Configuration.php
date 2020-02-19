<?php

namespace hr;

class Configuration
{
    private $ini_array;

    public function __construct()
    {
        $this->ini_array = parse_ini_file("application.ini");
    }

    public function value(string $key): string
    {
        $value = $this->ini_array[$key];
        return $value;
    }
}