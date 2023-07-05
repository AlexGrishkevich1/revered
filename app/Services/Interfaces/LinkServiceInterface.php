<?php

namespace App\Services\Interfaces;

use Illuminate\Http\JsonResponse;

interface LinkServiceInterface
{
    public function shortLinkGenerate(string $lastShortedLink = NULL): string;
}
