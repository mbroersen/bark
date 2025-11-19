<?php

namespace Bark\Modules\Config;

class Config
{
    private array $config;

    public function __construct(private string $name = 'database')
    {
       // get array from file
        $this->config = require __DIR__ . "/../../config/$this->name.php";
    }

    public function config(): array
    {
        return $this->config;
    }

    public function __get(string $name)
    {
        return $this->get($name);
    }

    public function get($key): string|int|array|null
    {
        if (str_contains($key, ".")) {
            $keys = explode(".", $key);
            $value = $this->config;
            foreach ($keys as $subKey) {
                if (!isset($value[$subKey])) {
                    return null;
                }
                $value = $value[$subKey];
            }
            return $value;
        }

        return $this->config[$key] ?? null;
    }

}