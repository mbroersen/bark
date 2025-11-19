<?php

namespace Bark\Modules\Database\Database\Table;

use Bark\Modules\Database\Database\Table;

class Relation
{
    public function __construct(
        private Table $table2,
    ) {
    }

}