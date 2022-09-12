<?php

namespace App\Repositories;

use App\Constants\TableNames;
use App\Entities\EOffer;
use App\LoadConfig;
use App\Models\Offer;
use App\OfferFilters;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class OfferRepository implements IOfferRepository {
    use SoftDeletes;

    /**
     * @inheritDoc
     */
    public function load(LoadConfig $loadConfig, OfferFilters $offerFilters): array {
        return DB::table(TableNames::OFFERS . " as o")->select([
            "p.name as product_name",
            "p.description",
            "p.image_link",
            "price",
            "in_stock",
            "s.name as seller_name",
            "o.created_at"
        ])
            ->leftJoin("products as p", "p.id", "=", "o.product_id")
            ->leftJoin("sellers as s", "s.id", "=", "o.seller_id")
            ->when($offerFilters->getMaxPrice(), function ($query, $maxPrice) {
                $query->where("price", "<=", $maxPrice);
            })
            ->when($offerFilters->getProductName(), function ($query, $productName) {
                $query->where("p.name", "ilike", "$productName%");
            })
            ->orderBy("o.{$loadConfig->getSortingField()}", $loadConfig->getSortingDirection())
            ->limit($loadConfig->getPerPage())
            ->offset($loadConfig->getOffset())
            ->get()
            ->toArray();
    }

    /**
     * @inheritDoc
     */
    public function fetchByIds(array $ids, array $relations = []): array {
        return Offer::with($relations)
            ->whereIn("id", $ids)
            ->get()
            ->map(fn(Offer $offer) => $offer->toDomainEntity())
            ->toArray();
    }

    /**
     * @inheritDoc
     */
    public function createMany(array $offers): void {
        $insertArray = array_map(fn(EOffer $offer) => $offer->toDBArray(), $offers);

        foreach (array_chunk($insertArray, 5000) as $chunk) {
            Offer::query()->insert($chunk);
        }
    }

    /**
     * @inheritDoc
     */
    public function softDelete(int $id): void {
        Offer::whereId($id)->delete();
    }

    /**
     * @inheritDoc
     */
    public function delete(int $id): void {
        Offer::whereId($id)->forceDelete();
    }

    /**
     * @inheritDoc
     */
    public function deleteMany(array $ids): void {
        foreach (array_chunk($ids, 5000) as $chunk) {
            Offer::whereIn("id", $chunk)->forceDelete();
        }
    }

    /**
     * @inheritDoc
     */
    public function restore(int $id): void {
        Offer::whereId($id)->restore();
    }

    /**
     * @inheritDoc
     */
    public function exists(int $id): bool {
        return Offer::whereId($id)->exists();
    }

    /**
     * @inheritDoc
     */
    public function fetchOnlyTrashed(): array {
        return Offer::onlyTrashed()
            ->get()
            ->map(fn(Offer $offer) => $offer->toDomainEntity())
            ->toArray();
    }
}
