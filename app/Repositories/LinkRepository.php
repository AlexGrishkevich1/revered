<?php

namespace App\Repositories;

use App\Models\LastShortLink;
use App\Models\Link;
use App\Repositories\Interfaces\LinkRepositoryInterface;
use App\Repositories\Traits\ModelTrait;
use App\Services\Interfaces\LinkServiceInterface;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;

class LinkRepository implements LinkRepositoryInterface
{
    use ModelTrait;

    private LinkServiceInterface $linkService;

    public function __construct(LinkServiceInterface $linkService)
    {
        $this->linkService = $linkService;
        $this->setModel(resolve(Link::class));
    }

    public function get(): Collection {
        return $this->model->latest()->take(10)->get();
    }

    public function create(array $data): Link {
        $lastShort = LastShortLink::latest()->first();

        $shortedLink = $this->linkService->shortLinkGenerate($lastShort?->short);

        $linkModel = $this->model->create([
            'link' => $data['link'],
            'short' => $shortedLink
        ]);

        LastShortLink::create([
            'short' => $shortedLink
        ]);

        return $linkModel;
    }
}
