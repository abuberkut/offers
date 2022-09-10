<?php

namespace App\Repositories;

use App\Entities\ESeller;
use App\Models\Seller;

class SellerRepository implements ISellerRepository {
    /**
     * @inheritDoc
     */
    public function createMany(array $sellers): void {
        $insertArray = array_map(fn(ESeller $seller) => $seller->toDBArray(), $sellers);

        foreach (array_chunk($insertArray, 5000) as $chunk) {
            Seller::query()->insert($chunk);
        }
    }

    /**
     * @inheritDoc
     */
    public function fetchByToken(string $token, array $relations = []): ?ESeller {
        return Seller::with($relations)->whereToken($token)->first()?->toDomainEntity();
    }
}
