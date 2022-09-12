<?php

namespace App\Services\DBTableFiller\AttributesFaker;

use App\Constants\TableNames;
use Faker\Generator;

class AttributesFaker implements IAttributesFaker {
    public function __construct(
        private Generator $faker
    ) {}

    /**
     * @inheritDoc
     */
    public function fake(string $tableName, array $values): array {
        return match ($tableName) {
            TableNames::SELLERS => $this->fakeSellerAttributes($values["id"]),
            TableNames::PRODUCTS => $this->fakeProductAttributes($values["id"]),
            TableNames::OFFERS => $this->fakeOfferAttributes($values["id"], $values["product_id"], $values["seller_id"]),
            default => throw new \RuntimeException("Incorrect AttributesFakerType $tableName"),

        };
    }

    private function fakeSellerAttributes(int $id): array {
        return array_merge(
            $this->fakeIdAndNameAttributes($id),
            ["token" => $this->faker->uuid()],
            $this->fakeTimeAttributes()
        );
    }

    private function fakeProductAttributes(int $id): array {
        return array_merge(
            $this->fakeIdAndNameAttributes($id),
            [
                "description" => $this->faker->sentence(),
                "image_link" => $this->faker->imageUrl(),
            ],
            $this->fakeTimeAttributes()
        );
    }

    private function fakeIdAndNameAttributes(int $id): array {
        return [
            "id" => $id,
            "name" => $this->faker->name(),
        ];
    }

    private function fakeTimeAttributes(): array {
        return [
            "created_at" => $this->faker->dateTimeBetween('2022-09-01', '2022-09-05')->format("Y-m-d h:m:s"),
            "updated_at" => $this->faker->dateTimeBetween('2022-09-06', '2022-09-10')->format("Y-m-d h:m:s"),
        ];
    }

    private function fakeOfferAttributes(int $id, int $productId, int $sellerId): array {
        $price = $this->faker->randomFloat(2, 1, 1000);
        $inStock = random_int(1, 1000);
        return [
            array_merge(
                [
                    "id" => $id,
                    "product_id" => $productId,
                    "seller_id" => $sellerId,
                    "price" => $price,
                    "in_stock" => $inStock,
                    "deleted_at" => null
                ],
                $this->fakeTimeAttributes()
            ),
        ];
    }
}
