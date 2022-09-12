<?php

namespace App\Services\FileWriter;

class CSVFileWriter implements IFileWriter {
    /**
     * @inheritDoc
     */
    public function write(string $filepath, array $values, string $mode = "w"): void {
        if (empty($values)) {
            return;
        }

        $file = fopen($filepath, $mode);

        if (!is_array($values[0])) {
            fputcsv($file, $values);
            fclose($file);
            return;
        }

        foreach ($values as $value) {
            fputcsv($file, $value);
        }

        fclose($file);
    }
}
