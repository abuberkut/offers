<?php

namespace App\Services\FromFileToDBCopier;

use Illuminate\Support\Facades\DB;

class FromFileToDBCopier implements IFromFileToDBCopier {
    /**
     * @inheritDoc
     */
    public function copy(string $filepath, string $tableName, string $delimiter = ","): void {
        DB::statement("COPY $tableName FROM '$filepath' DELIMITER '$delimiter' NULL ''");
    }
}
