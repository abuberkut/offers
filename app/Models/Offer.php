<?php

namespace App\Models;

use App\Entities\EOffer;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * App\Models\Offer
 *
 * @property int $product_id
 * @property int $seller_id
 * @property string $price
 * @property int $in_stock
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Offer newModelQuery()
 * @method static Builder|Offer newQuery()
 * @method static Builder|Offer query()
 * @method static Builder|Offer whereCreatedAt($value)
 * @method static Builder|Offer whereInStock($value)
 * @method static Builder|Offer wherePrice($value)
 * @method static Builder|Offer whereProductId($value)
 * @method static Builder|Offer whereSellerId($value)
 * @method static Builder|Offer whereUpdatedAt($value)
 * @mixin Eloquent
 * @property-read Product|null $product
 * @property-read Seller $seller
 * @property int $id
 * @property string|null $deleted_at
 * @method static Builder|Offer whereDeletedAt($value)
 * @method static Builder|Offer whereId($value)
 * @method static \Illuminate\Database\Query\Builder|Offer onlyTrashed()
 * @method static \Illuminate\Database\Query\Builder|Offer withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Offer withoutTrashed()
 */
class Offer extends Model
{
    use HasFactory, SoftDeletes;
    public const TABLE_NAME = "offers";

    public function seller(): BelongsTo {
        return $this->belongsTo(Seller::class);
    }

    public function product(): BelongsTo {
        return $this->belongsTo(Product::class);
    }

    public function toDomainEntity(): EOffer {
        $product = isset($this->relations["product"]) ? $this->product->toDomainEntity() : null;
        $seller = isset($this->relations["seller"]) ? $this->seller->toDomainEntity() : null;

        return (new EOffer($this->product_id, $this->seller_id, $this->price, $this->in_stock))
            ->setId($this->id)
            ->setProduct($product)
            ->setSeller($seller)
            ->setCreatedAt($this->created_at)
            ->setUpdatedAt($this->updated_at)
            ->setDeletedAt($this->deleted_at);
    }
}
