<?php

namespace Bark\Modules\Database\Database;

class Table
{
    private array $fields;
    private array $relations;
    private array $primaryKey;
    private string $name;

    public function __construct(
        private Connection $connection,
        string $name,
        array $fields = [],
        array $primaryKey = [],
        array $relations = [],
    ) {
        $this->name = $name;
        $this->fields = $fields;
        $this->primaryKey = $primaryKey;
        $this->relations = $relations;
    }

    public function select()
    {
        $this->connection->connect();


    }

    public function insert()
    {

    }

    public function update()
    {

    }

    public function delete()
    {

    }

}