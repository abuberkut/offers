<?php

namespace App\Services\DBTableFiller;


use Illuminate\Console\OutputStyle;

interface IDBTableFiller {
    /**
     * @param string $tableName
     * @param OutputStyle $outputStyle
     * @return void
     */
    public function fill(string $tableName, OutputStyle $outputStyle): void;
}
