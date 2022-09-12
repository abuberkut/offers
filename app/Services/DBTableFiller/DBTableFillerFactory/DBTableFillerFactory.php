<?php

namespace App\Services\DBTableFiller\DBTableFillerFactory;

use App\Constants\DBTableFillerTypes;
use App\Services\DBTableFiller\DBTableFillerByCopy;
use App\Services\DBTableFiller\DBTableFillerByFactory;
use App\Services\DBTableFiller\IDBTableFiller;

class DBTableFillerFactory implements IDBTableFillerFactory {
    /**
     * @inheritDoc
     */
    public function make(string $type): IDBTableFiller {
        return match ($type) {
            DBTableFillerTypes::FACTORY => resolve(DBTableFillerByFactory::class),
            DBTableFillerTypes::COPY => resolve(DBTableFillerByCopy::class),
            default => throw new \RuntimeException("Incorrect DBTableFillerType given $type")
        };
    }
}
