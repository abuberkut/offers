<?php

namespace App\Services\FileReader;

class CSVFileReader implements IFileReader {
    /**
     * @inheritDoc
     */
    public function read(string $filepath, int $itemsCount = 1, string $delimiter = ",", int $limit = null): array {
        $result = [];

        $lines = file($filepath);

        $limit = $limit ?? count($lines);

        for ($i = 0; $i < $limit; $i++) {
            $items = explode($delimiter, $lines[$i]);
            $item = [];

            $item = $this->getItem($itemsCount, $items, $item);

            $result[] = $item;
        }

        return $result;
    }

    /**
     * @param int $itemsCount
     * @param array $items
     * @param array $item
     * @return mixed
     */
    private function getItem(int $itemsCount, array $items, array $item): mixed {
        if ($itemsCount < 2) {
            return $items[0];
        }

        $j = 0;
        while ($j < $itemsCount) {
            $item[$j] = $items[$j];
            $j++;
        }
        return $item;
    }
}
