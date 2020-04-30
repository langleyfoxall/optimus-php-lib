<?php

namespace Optimus\Helpers;

class Arr
{
    /**
     * Test if an array is associative or not.
     *
     * @param array $array
     * @return bool
     */
    public static function isNotAssoc(array $array): bool
    {
        return array_keys($array) === range(0, count($array) - 1);
    }
}
