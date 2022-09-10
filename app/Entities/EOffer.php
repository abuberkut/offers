<?php

namespace App\Entities;

class EOffer {
    /**
     * @var int|null
     */
    private ?int $id = null;
    /**
     * @var EProduct|null
     */
    private ?EProduct $product = null;
    /**
     * @var ESeller|null
     */
    private ?ESeller $seller = null;
    /**
     * @var string|null
     */
    private ?string $createdAt = null;
    /**
     * @var string|null
     */
    private ?string $updatedAt = null;
    /**
     * @var string|null
     */
    private ?string $deletedAt = null;

    public function __construct(
        private int $productId,
        private int $sellerId,
        private float $price,
        private int $inStock
    ) {}

    /**
     * @return int
     */
    public function getProductId(): int {
        return $this->productId;
    }

    /**
     * @return int
     */
    public function getSellerId(): int {
        return $this->sellerId;
    }

    /**
     * @return float
     */
    public function getPrice(): float {
        return $this->price;
    }

    /**
     * @return int
     */
    public function getInStock(): int {
        return $this->inStock;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int {
        return $this->id;
    }

    /**
     * @param int|null $id
     * @return EOffer
     */
    public function setId(?int $id): EOffer {
        $this->id = $id;
        return $this;
    }

    /**
     * @return EProduct|null
     */
    public function getProduct(): ?EProduct {
        return $this->product;
    }

    /**
     * @param EProduct|null $product
     * @return EOffer
     */
    public function setProduct(?EProduct $product): EOffer {
        $this->product = $product;
        return $this;
    }

    /**
     * @return ESeller|null
     */
    public function getSeller(): ?ESeller {
        return $this->seller;
    }

    /**
     * @param ESeller|null $seller
     * @return EOffer
     */
    public function setSeller(?ESeller $seller): EOffer {
        $this->seller = $seller;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getCreatedAt(): ?string {
        return $this->createdAt;
    }

    /**
     * @param string|null $createdAt
     * @return EOffer
     */
    public function setCreatedAt(?string $createdAt): EOffer {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getUpdatedAt(): ?string {
        return $this->updatedAt;
    }

    /**
     * @param string|null $updatedAt
     * @return EOffer
     */
    public function setUpdatedAt(?string $updatedAt): EOffer {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getDeletedAt(): ?string {
        return $this->deletedAt;
    }

    /**
     * @param string|null $deletedAt
     * @return EOffer
     */
    public function setDeletedAt(?string $deletedAt): EOffer {
        $this->deletedAt = $deletedAt;
        return $this;
    }

}
