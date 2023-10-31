<?php

namespace NotesEnot\Core\utils;

trait Singleton
{
    private static ?self $instance = null;

    final public static function getInstance(): static
    {
        if (static::$instance === null) {
            static::$instance = new static;
        }

        return static::$instance;
    }

    protected function __construct()
    {
    }

    final protected function __clone()
    {
    }

    final protected function __wakeup()
    {
    }
}