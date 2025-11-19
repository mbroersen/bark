<?php

namespace Bark\Modules\Database\Database;

use Bark\Modules\Config\Config;
use Pdo\Mysql;

class Connection
{
    private Mysql $pdo;

    private Config $config;

    public function __construct()
    {
        $this->config = new Config(basename(__DIR__));

        $this->pdo = new Mysql(
            'mysql:host=' . $this->config->get('host') . ';port=' . $this->config->get('port'),
            $this->config->get('user'),
            $this->config->get('password'),
            [
                'db' => $this->config->get('database'),
                'charset' => 'utf8mb4',
                'driver' => 'pdo',
                'timezone' => 'Europe/Amsterdam',
            ]
        );

        $this->useSchema();

    }

    private function useSchema(): void
    {
        $this->pdo->query('USE ' . $this->config->get('database'));
    }


    public function connect()
    {
        $this->pdo->connect($this->config->host);
    }

    public function select($query, $params = []): \Iterator
    {
        // add statement execute and bind params
        $stmt = $this->pdo->prepare($query);

        //escape $param values;
        foreach ($params as &$value) {
            $value = $this->pdo->quote($value);
        }

        $stmt->fetchObject();

        while ($row = $stmt->fetchObject(Campaign::class)) {
            yield $row;
        }
    }

}