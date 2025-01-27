<?php

namespace AbdelrhmanSaeed\Tpo\Services;


class Singleton
{
    private static array $instances = [];

    public static function getInstance(string $className): object
    {
        if (!isset(self::$instances[$className])) {
            self::$instances[$className] = new $className();
        }

        return self::$instances[$className];
    }

    public static function set(string $className, object $instance): void
    {
        self::$instances[$className] = $instance;
    }
}