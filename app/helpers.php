<?php

if (! function_exists("getPaginationParams")) {
    function getPaginationParams(array $result): array {
        $pagination = $result;
        unset($pagination['data']);

        return $pagination;
    }
}
