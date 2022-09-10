<?php

namespace App\Repositories;

use App\Entities\EProduct;
use App\Models\Product;

class ProductRepository implements IProductRepository {
    /**
     * @inheritDoc
     */
    public function createMany(array $products): void {
        $insertArray = array_map(fn(EProduct $product) => $product->toDBArray(), $products);

        foreach (array_chunk($insertArray, 5000) as $chunk) {
            Product::query()->insert($chunk);
        }
    }

    /**
     * @inheritDoc
     */
    public function fetchById(int $id, array $relations = []): EProduct {
        return Product::with($relations)->whereId($id)->first()?->toDomainEntity();
    }
}
