<?php

namespace Bark\Modules\Database\Database;

class Where
{


    public function __construct(
        private string $field,
        private string $operator,
        private mixed $value,
    ) {

    }



}