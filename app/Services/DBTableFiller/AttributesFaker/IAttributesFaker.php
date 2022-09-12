<?php

namespace App\Services\DBTableFiller\AttributesFaker;


interface IAttributesFaker {
    /**
     * @param string $tableName
     * @param array $values
     * @return array
     */
    public function fake(string $tableName, array $values): array;
}
