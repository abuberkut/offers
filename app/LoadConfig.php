<?php

namespace App;


use App\Constants\SortingDirections;
use App\Constants\SortingFields;

class LoadConfig {
    public const MAX_LIMIT = 100000;
    public const DEFAULT_PAGE = 1;
    public const DEFAULT_PER_PAGE = 100;
    public const DEFAULT_SORTING_FIELD = SortingFields::CREATED_AT;
    public const DEFAULT_SORTING_DIRECTION = SortingDirections::DESC;

    public function __construct(
        private $page,
        private $perPage,
        private $sortingField,
        private $sortingDirection
    ) {}

    /**
     * @return int
     */
    public function getPage(): int {
        return $this->page;
    }

    /**
     * @return string
     */
    public function getPerPage(): string {
        return min($this->perPage, self::MAX_LIMIT);
    }

    /**
     * @return string
     */
    public function getSortingField():string {
        return $this->sortingField;
    }

    /**
     * @return string
     */
    public function getSortingDirection(): string {
        return $this->sortingDirection;
    }

    /**
     * @return int
     */
    public function getOffset(): int {
        return ($this->getPage() - 1) * $this->getPerPage();
    }
}
