<?php

namespace App\Entities;

class ESeller {
    /**
     * @var string|null
     */
    private ?string $token = null;
    /**
     * @var int|null
     */
    private ?int $id = null;
    /**
     * @var EOffer[]
     */
    private array $offers = [];
    /**
     * @var EProduct[]
     */
    private array $products = [];
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
     * @return ESeller
     */
    public function setId(?int $id): ESeller {
        $this->id = $id;
        return $this;
    }

    /**
     * @return EOffer[]
     */
    public function getOffers(): array {
        return $this->offers;
    }

    /**
     * @param EOffer[] $offers
     * @return ESeller
     */
    public function setOffers(array $offers): ESeller {
        $this->offers = $offers;
        return $this;
    }

    /**
     * @return EProduct[]
     */
    public function getProducts(): array {
        return $this->products;
    }

    /**
     * @param EProduct[] $products
     * @return ESeller
     */
    public function setProducts(array $products): ESeller {
        $this->products = $products;
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
     * @return ESeller
     */
    public function setCreatedAt(?string $createdAt): ESeller {
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
     * @return ESeller
     */
    public function setUpdatedAt(?string $updatedAt): ESeller {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    /**
     * @param string|null $token
     * @return ESeller
     */
    public function setToken(?string $token): ESeller {
        $this->token = $token;
        return $this;
    }

    /**
     * @return string
     */
    public function getToken(): string {
        return $this->token;
    }

    /**
     * @return string
     */
    public function getName(): string {
        return $this->name;
    }

    public function toDBArray(): array {
        return [
            "name" => $this->getName(),
            "token" => $this->getToken(),
            "created_at" => $this->getCreatedAt(),
            "updated_at" => $this->getUpdatedAt(),
        ];
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
