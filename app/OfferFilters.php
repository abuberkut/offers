<?php

namespace App;

class OfferFilters {
    private ?string $productName = null;
    private ?float $maxPrice = null;

    /**
     * @return string|null
     */
    public function getProductName(): ?string {
        return $this->productName;
    }

    /**
     * @param string|null $productName
     * @return OfferFilters
     */
    public function setProductName(?string $productName): OfferFilters {
        $this->productName = $productName;
        return $this;
    }

    /**
     * @return float|null
     */
    public function getMaxPrice(): ?float {
        return $this->maxPrice;
    }

    /**
     * @param float|null $maxPrice
     * @return OfferFilters
     */
    public function setMaxPrice(?float $maxPrice): OfferFilters {
        $this->maxPrice = $maxPrice;
        return $this;
    }
}
