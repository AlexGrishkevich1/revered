<?php

namespace App\Repositories;

use App\Models\LastShortLink;
use App\Models\Link;
use App\Repositories\Interfaces\LinkRepositoryInterface;
use App\Repositories\Traits\ModelTrait;
use App\Classes\NextKeyGenerator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class LinkRepository implements LinkRepositoryInterface
{
    use ModelTrait;

    private int $recentLinksCount = 10;

    public function __construct()
    {
        $this->setModel(resolve(Link::class));
    }

    public function get(): Collection {
        return $this->model->latest()->take($this->recentLinksCount)->get();
    }

    public function create(array $data): Link
    {
        DB::statement('LOCK TABLES ' . $this->model->getTable() . ' WRITE, last_short_links WRITE');

        try {
            $lastShort = LastShortLink::first();

            $shortedLink = NextKeyGenerator::generate($lastShort?->short);

            $linkModel = $this->model::create([
                'link' => $data['link'],
                'short' => $shortedLink
            ]);

            LastShortLink::updateOrCreate([
                'id' => $lastShort ? $lastShort->id : 1
            ], [
                'short' => $shortedLink
            ]);
        } finally {
            DB::statement('UNLOCK TABLES');
        }

        return $linkModel;
    }
}
