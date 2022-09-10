<?php

namespace App\Repositories;

use App\Entities\EOffer;
use App\LoadConfig;
use App\OfferFilters;

interface IOfferRepository {
    /**
     * @param LoadConfig $loadConfig
     * @param OfferFilters $offerFilters
     * @return array
     */
    public function load(LoadConfig $loadConfig, OfferFilters $offerFilters): array;

    /**
     * @param int[] $ids
     * @param string[] $relations
     * @return EOffer[]
     */
    public function fetchByIds(array $ids, array $relations = []): array;

    /**
     * @param EOffer[] $offers
     * @return void
     */
    public function createMany(array $offers): void;

    /**
     * @param int $id
     * @return void
     */
    public function softDelete(int $id): void;

    /**
     * @param int $id
     * @return void
     */
    public function delete(int $id): void;

    /**
     * @param int[] $ids
     * @return void
     */
    public function deleteMany(array $ids): void;

    /**
     * @param int $id
     * @return void
     */
    public function restore(int $id): void;

    /**
     * @param int $id
     * @return bool
     */
    public function exists(int $id): bool;

    /**
     * @return EOffer[]
     */
    public function fetchOnlyTrashed(): array;
}
