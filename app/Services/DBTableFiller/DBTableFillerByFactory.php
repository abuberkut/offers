<?php

namespace App\Services\DBTableFiller;

use App\Constants\IntegerNumbers;
use App\Constants\TableNames;
use App\Models\Product;
use App\Models\Seller;
use Illuminate\Console\OutputStyle;

class DBTableFillerByFactory extends ADBTableFiller implements IDBTableFiller {
    /**
     * @inheritDoc
     */
    public function fill(string $tableName, OutputStyle $outputStyle): void {
        $start = microtime(true);

        $this->truncateTable($tableName);

        $outputStyle->progressStart(IntegerNumbers::ONE_MILLION); // 1000 000
        $i = 0;
        while ($i < IntegerNumbers::ONE_HUNDRED) { // 100
            $tableName === TableNames::SELLERS
                ? Seller::factory(IntegerNumbers::TEN_THOUSAND)->create() // 10 000
                : Product::factory(IntegerNumbers::TEN_THOUSAND)->create(); // 10 000
            $i++;
            $outputStyle->progressAdvance(IntegerNumbers::TEN_THOUSAND); // 10 000
        }
        $outputStyle->progressFinish();

        $time = microtime(true) - $start;
        $outputStyle->info("Table $tableName filled in $time second(s)");
    }
}
