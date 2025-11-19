<?php

namespace Bark\Modules\Core;

use Bark\Modules\Database\Database\Connection;
use Bark\Modules\Routing\Request;

class App
{
    private Request $request;

    private array $controllers = [];

    public function __construct()
    {
        $this->request = new Request();
    }

    // use attribute to select right route controller action routes
    public function run(): void
    {
        $this->request->uri;


        $connection = new Connection();
        $a = $connection->select('SELECT * FROM user WHERE id = ?', [1]);

        foreach ($a as $row) {
            echo $row->name;
        }

        echo "Hello from Bark!";
    }

    private function matchRoute()
    {

    }


}