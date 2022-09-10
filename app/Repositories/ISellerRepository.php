<?php

namespace App\Repositories;

use App\Entities\ESeller;

interface ISellerRepository {
    /**
     * @param ESeller[] $sellers
     * @return void
     */
    public function createMany(array $sellers): void;

    /**
     * @param string $token
     * @param array $relations
     * @return ESeller|null
     */
    public function fetchByToken(string $token, array $relations = []): ?ESeller;
}
