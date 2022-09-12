<?php

namespace App\Services\FromFileToDBCopier;

interface IFromFileToDBCopier {
    /**
     * @param string $filepath
     * @param string $tableName
     * @param string $delimiter
     * @return void
     */
    public function copy(string $filepath, string $tableName, string $delimiter): void;
}
