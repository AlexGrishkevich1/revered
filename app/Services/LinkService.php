<?php

namespace App\Services;

use App\Services\Interfaces\LinkServiceInterface;

class LinkService implements LinkServiceInterface
{
    public function shortLinkGenerate(string $lastShortedLink = NULL): string {
        $start = 'a';
        return $lastShortedLink ? ++$lastShortedLink : $start;
    }
}
