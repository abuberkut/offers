<?php

namespace App\Entities;

class EProduct {
    /**
     * @var int|null
     */
    private ?int $id = null;
    /**
     * @var EOffer[]
     */
    private array $offers = [];
    /**
     * @var ESeller[]
     */
    private array $sellers = [];
    /**
     * @var string|null
     */
    private ?string $createdAt = null;
    /**
     * @var string|null
     */
    private ?string $updatedAt = null;
    public function __construct(private string $name) {}

    /**
     * @return int|null
     */
    public function getId(): ?int {
        return $this->id;
    }

    /**
     * @param int|null $id
     * @return EProduct
     */
    public function setId(?int $id): EProduct {
        $this->id = $id;
        return $this;
    }

    /**
     * @return array
     */
    public function getOffers(): array {
        return $this->offers;
    }

    /**
     * @param array $offers
     * @return EProduct
     */
    public function setOffers(array $offers): EProduct {
        $this->offers = $offers;
        return $this;
    }

    /**
     * @return array
     */
    public function getSellers(): array {
        return $this->sellers;
    }

    /**
     * @param array $sellers
     * @return EProduct
     */
    public function setSellers(array $sellers): EProduct {
        $this->sellers = $sellers;
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
     * @return EProduct
     */
    public function setCreatedAt(?string $createdAt): EProduct {
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
     * @return EProduct
     */
    public function setUpdatedAt(?string $updatedAt): EProduct {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string {
        return $this->name;
    }

    /**
     * @return array
     */
    public function present(): array {
        return [
            "id" => $this->getId(),
            "name" => $this->getName(),
        ];
    }
}
