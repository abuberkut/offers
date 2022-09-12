<?php

namespace App\Services\DBTableFiller;

use App\Constants\TableNames;
use App\Models\Offer;
use App\Models\Product;
use App\Models\Seller;

class ADBTableFiller {
    protected const BASE_FILE_PATH = "/usr/local/var/postgres/";

    protected function truncateTable(string $tableName): void {
        switch ($tableName) {
            case TableNames::SELLERS:
                Seller::query()->truncate();
                break;
            case TableNames::PRODUCTS:
                Product::query()->truncate();
                break;
            case TableNames::OFFERS:
                Offer::query()->truncate();
                break;
            default:
                throw new \RuntimeException("Incorrect table name $tableName");
        }
    }

    protected function deleteFile(string $filepath): void {
        if (file_exists($filepath)) {
            unlink($filepath);
        }
    }
}
