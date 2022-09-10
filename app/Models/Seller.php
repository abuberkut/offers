<?php

namespace App\Models;

use App\Entities\ESeller;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Support\Carbon;

/**
 * App\Models\Seller
 *
 * @property int $id
 * @property string $name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Seller newModelQuery()
 * @method static Builder|Seller newQuery()
 * @method static Builder|Seller query()
 * @method static Builder|Seller whereCreatedAt($value)
 * @method static Builder|Seller whereId($value)
 * @method static Builder|Seller whereName($value)
 * @method static Builder|Seller whereUpdatedAt($value)
 * @mixin Eloquent
 * @property string $token
 * @property-read Collection|Offer[] $offers
 * @property-read int|null $offers_count
 * @property-read Collection|Product[] $products
 * @property-read int|null $products_count
 * @method static Builder|Seller whereToken($value)
 */
class Seller extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $hidden = ["token"];

    public function offers(): HasMany {
        return $this->hasMany(Offer::class);
    }

    public function products(): HasManyThrough {
        return $this->hasManyThrough(Product::class, Offer::class, "seller_id", "id", "id", "product_id");
    }

    public function toDomainEntity(): ESeller {
        $offers = isset($this->relations["offers"])
            ? $this->offers->map(fn(Offer $offer) => $offer->toDomainEntity())->toArray()
            : [];

        $products = isset($this->relations["products"])
            ? $this->products->map(fn(Product $product) => $product->toDomainEntity())->toArray()
            : [];

        return (new ESeller($this->name))
            ->setId($this->id)
            ->setOffers($offers)
            ->setProducts($products)
            ->setCreatedAt($this->created_at)
            ->setUpdatedAt($this->updated_at);
    }
}
