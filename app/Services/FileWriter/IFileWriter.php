<?php

namespace App\Services\FileWriter;

interface IFileWriter {
    /**
     * @param string $filepath
     * @param array $values
     * @param string $mode
     * @return void
     */
    public function write(string $filepath, array $values, string $mode = "w"): void;
}
