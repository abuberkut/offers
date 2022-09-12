<?php

namespace App\Services\DBTableFiller;

use App\Constants\IntegerNumbers;
use App\Constants\TableNames;
use App\Services\DBTableFiller\AttributesFaker\IAttributesFaker;
use App\Services\FileReader\IFileReader;
use App\Services\FileWriter\IFileWriter;
use App\Services\FromFileToDBCopier\IFromFileToDBCopier;
use Illuminate\Console\OutputStyle;

class DBTableFillerByCopy extends ADBTableFiller implements IDBTableFiller {
    public function __construct(
        private IAttributesFaker $attributesFaker,
        private IFileReader $fileReader,
        private IFileWriter $fileWriter,
        private IFromFileToDBCopier $fileToDBCopier
    ) {}

    /**
     * @inheritDoc
     */
    public function fill(string $tableName, OutputStyle $outputStyle): void {
        $start = microtime(true);

        $this->truncateTable($tableName);

        $filepath = self::BASE_FILE_PATH . $tableName . ".csv";

        $this->deleteFile($filepath);

        $outputStyle->info("Preparing $tableName.csv file...");

        switch ($tableName) {
            case TableNames::SELLERS:
            case TableNames::PRODUCTS:
                $this->fillSellersOrProducts($tableName, $filepath, $outputStyle);
                break;
            case TableNames::OFFERS:
                $this->fillOffers($tableName, $filepath, $outputStyle);
                break;
            default:
                throw new \RuntimeException("Incorrect table name $tableName");
        }

        $time = microtime(true) - $start;
        $outputStyle->info("Table $tableName filled in $time second(s)");
    }

    /**
     * @param string $tableName
     * @param string $filepath
     * @param OutputStyle $outputStyle
     * @return void
     */
    private function fillSellersOrProducts(string $tableName, string $filepath, OutputStyle $outputStyle): void {
        $outputStyle->progressStart(IntegerNumbers::ONE_MILLION);
        $id = 1;
        for ($i = 1; $i <= IntegerNumbers::TEN; $i++) {
            $fakeData = [];
            for ($j = 1; $j <= IntegerNumbers::ONE_HUNDRED_THOUSAND; $j++) {
                $fakeData[] = $this->attributesFaker->fake($tableName, ["id" => $id]);
                $id++;
            }

            $this->fileWriter->write($filepath, $fakeData, "a+");
            $outputStyle->progressAdvance(IntegerNumbers::ONE_HUNDRED_THOUSAND);
        }

        $outputStyle->info("File $tableName.csv prepared");

        $outputStyle->info("File $tableName.csv copying into $tableName table...");
        $this->fileToDBCopier->copy($filepath, $tableName);
        $outputStyle->info("File $tableName.csv copied to into $tableName table");
    }

    private function fillOffers(string $tableName, string $filepath, OutputStyle $outputStyle): void {
        $start = microtime(true);
        $sellerIds = $this->getIds(TableNames::SELLERS); // 1 000 000
        $productIds = $this->getIds(TableNames::PRODUCTS); // 1 000 000

        // 10 000 000 records
        $outputStyle->progressStart(IntegerNumbers::ONE_MILLION * IntegerNumbers::TEN);

        $id = 1;
        for ($i = 0; $i < IntegerNumbers::ONE_MILLION; $i += IntegerNumbers::TEN) { // chunked by 10
            for ($j = $i; $j < $i + IntegerNumbers::TEN; $j++) {
                for ($k = $i; $k < $i + IntegerNumbers::TEN; $k++) {
                    $this->writeToFile($tableName, $id, $productIds[$j], $sellerIds[$k], $filepath);
                    $id++;
                    $outputStyle->progressAdvance();
                }
            }

            $floatValue = ($id - 1) / IntegerNumbers::ONE_MILLION;
            $intValue = (int) $floatValue;

            if ($floatValue - $intValue === 0) {
                $this->fileToDBCopier->copy($filepath, $tableName);
                $this->deleteFile($filepath);
                $time = microtime(true) - $start;
                $outputStyle->info("Time: Copied 1 million records in $time seconds");
            }

        }

        $outputStyle->info("File $tableName.csv copied to into $tableName table");

        $outputStyle->info("Total time: 10 million records in $time seconds");
        $outputStyle->progressFinish();
    }

    private function getIds(string $tableName): array {
        $filepath = self::BASE_FILE_PATH . $tableName . ".csv";
        return $this->fileReader->read(filepath: $filepath, limit: IntegerNumbers::ONE_MILLION);
    }

    /**
     * @param string $tableName
     * @param int $id
     * @param mixed $productChunkedId
     * @param mixed $sellerChunkedId
     * @param string $filepath
     * @return void
     */
    private function writeToFile(string $tableName, int $id, mixed $productChunkedId, mixed $sellerChunkedId, string $filepath): void {
        $fakeAttributes = $this->attributesFaker->fake(
            $tableName,
            ["id" => $id, "product_id" => $productChunkedId, "seller_id" => $sellerChunkedId]
        );
        $this->fileWriter->write($filepath, $fakeAttributes, "a+");
    }
}
