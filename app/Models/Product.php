<?php

namespace App\Models;

use App\Entities\EProduct;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * App\Models\Product
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property string $url
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Product newModelQuery()
 * @method static Builder|Product newQuery()
 * @method static Builder|Product query()
 * @method static Builder|Product whereCreatedAt($value)
 * @method static Builder|Product whereDescription($value)
 * @method static Builder|Product whereId($value)
 * @method static Builder|Product whereName($value)
 * @method static Builder|Product whereUpdatedAt($value)
 * @method static Builder|Product whereUrl($value)
 * @mixin Eloquent
 * @property string $image_link
 * @property-read Collection|Offer[] $offers
 * @property-read int|null $offers_count
 * @property-read Collection|Seller[] $sellers
 * @property-read int|null $sellers_count
 * @method static Builder|Product whereImageLink($value)
 */
class Product extends Model
{
    use HasFactory;

    public function offers(): HasMany {
        return $this->hasMany(Offer::class);
    }

    public function sellers(): BelongsToMany {
        return $this->belongsToMany(Seller::class, Offer::class, 'product_id', 'seller_id');
    }

    public function toDomainEntity(): EProduct {
        $offers = isset($this->relations["offers"])
            ? $this->offers->map(fn(Offer $offer) => $offer->toDomainEntity())->toArray()
            : [];

        $sellers = isset($this->relations["sellers"])
            ? $this->sellers->map(fn(Seller $seller) => $seller->toDomainEntity())->toArray()
            : [];

        return (new EProduct($this->name))
            ->setId($this->id)
            ->setOffers($offers)
            ->setSellers($sellers)
            ->setCreatedAt($this->created_at)
            ->setUpdatedAt($this->updated_at);
    }
}
