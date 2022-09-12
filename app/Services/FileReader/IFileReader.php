<?php

namespace App\Services\FileReader;

interface IFileReader {
    /**
     * @param string $filepath
     * @param int $itemsCount
     * @param string $delimiter
     * @param ?int $limit
     * @return array
     */
    public function read(string $filepath, int $itemsCount = 1, string $delimiter = ",", int $limit = null): array;
}
