<?php

namespace App\Support;

use InvalidArgumentException;

/**
 * Configuration class.
 *
 * This class MUST be used as static.
 */
class Config
{
    protected static array $container = [];

    /**
     * Set the container from the configuration array with default values
     *
     * @param  array  $config  The config array
     */
    public static function of(array $config = []): void
    {
        self::$container = [...config('document2'), ...array_filter($config)];
    }

    /**
     * Get config values for a given key
     *
     * @param  string  $key  The config key
     * @return mixed The method returns the config value of the given key
     */
    public static function get(string $key): mixed
    {
        if (! isset(self::$container[$key])) {
            self::of();
        }

        assert(
            isset(self::$container[$key]),
            new InvalidArgumentException(sprintf('The key "%s" is not defined.', $key))
        );

        return self::$container[$key];
    }

    public static function all(): mixed
    {
        if (! isset(self::$container['template'])) {
            self::of();
        }

        return self::$container;
    }
}
