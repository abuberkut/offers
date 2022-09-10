<?php

namespace App\Repositories;

use App\Entities\EProduct;

interface IProductRepository {
    /**
     * @param EProduct[] $products
     * @return void
     */
    public function createMany(array $products): void;

    /**
     * @param int $id
     * @param array $relations
     * @return EProduct
     */
    public function fetchById(int $id, array $relations = []): EProduct;
}
