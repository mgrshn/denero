<?php

class Singletone extends ParentClass implements InterfaceOne
{
    private static $instance = null;

    //prevent the creation of an object witn the 'new' operator.
    private function __construct() {}
    //prevent the copying of an object.
    private function __clone() {}

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
}

