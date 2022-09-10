<?php

declare(strict_types=1);

namespace App\Constants;

use ReflectionClass;

abstract class AConstants {
    /**
     * @return array
     */
    public static function getConstants(): array {
        return (new ReflectionClass(static::class))->getConstants();
    }

    /**
     * @return array
     */
    public static function getConstantsValues(): array {
        return array_values(self::getConstants());
    }
}
