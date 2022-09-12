<?php

namespace App\Services\DBTableFiller\DBTableFillerFactory;

use App\Services\DBTableFiller\IDBTableFiller;

interface IDBTableFillerFactory {
    /**
     * @param string $type
     * @return IDBTableFiller
     */
    public function make(string $type): IDBTableFiller;
}
