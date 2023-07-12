<?php

namespace App\Classes;

class NextKeyGenerator
{
    public static function generate(string $lastShortedLink = NULL): string {
        $start = 'a';
        return $lastShortedLink ? ++$lastShortedLink : $start;
    }
}
