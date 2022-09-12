<?php

namespace Database\Seeders;

use App\Constants\DBTableFillerTypes;
use App\Constants\TableNames;
use App\Services\DBTableFiller\DBTableFillerFactory\IDBTableFillerFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {

    public function __construct(
        private IDBTableFillerFactory $dbTableFillerFactory,
    ) {}

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void {
//        $outputStyle = $this->command->getOutput();

//        [Time: ~37 minutes]
//        $dbFillerByFactory = $this->dbTableFillerFactory->make(DBTableFillerTypes::FACTORY);
//        $dbFillerByFactory->fill(TableNames::SELLERS, $outputStyle); // ~ 9 minutes
//        $dbFillerByFactory->fill(TableNames::PRODUCTS, $outputStyle); // ~ 28 minutes

//        [Time: ~3 minutes]
//        $dbFillerByCopy = $this->dbTableFillerFactory->make(DBTableFillerTypes::COPY);
//        $dbFillerByCopy->fill(TableNames::SELLERS, $outputStyle); // ~ 30 seconds
//        $dbFillerByCopy->fill(TableNames::PRODUCTS, $outputStyle); // ~ 130 seconds
//        $dbFillerByCopy->fill(TableNames::OFFERS, $outputStyle); // ~ 17 minutes for 10 000 000 records (each seller has 10 products, each product has 10 sellers)
    }
}
