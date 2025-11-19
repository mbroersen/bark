<?php

namespace Bark\Modules\Routing;

use Bark\Modules\Models\DTO;

abstract class Controller
{
    protected $fp;

    public function __construct()
    {
    }

    public function delete(): void {

    }

    public function get(): void
    {

    }

    public function post(): void
    {

    }



    public function render(string $view, array $params = []): string
    {
        extract($params);
        ob_start();
        include_once __DIR__ . "/../../Views/$view.php";
        return ob_get_clean();
    }


    public function streamJson(iterable $data = [], int $status = 200, array $headers = []): void
    {
        //stream response
        //
        if (!isset($headers['Content-Type'])) {
            $headers['Content-Type'] = 'application/json';
        }

        http_response_code($status);
        foreach ($headers as $name => $value) {
            header("$name: $value");
        }
        header('Content-Type: application/json');

        $rowSeparation = '';

        //start output stream using file writer

        // use an object-oriented version of fopen
        $this->fp = fopen('php://output', 'w+');
        fwrite($this->fp, '[');


        $this->streamData($data);

        fwrite($this->fp, ']');
        fclose($this->fp);
    }

    private function streamData(iterable $data, $type = 'array'): void
    {
        foreach ($data as $row) {
            if (is_iterable($row)) {
                $this->streamData($row);
            }
        }

        fwrite($this->fp, json_encode($data, JSON_UNESCAPED_UNICODE));
        fflush($this->fp);
    }


}