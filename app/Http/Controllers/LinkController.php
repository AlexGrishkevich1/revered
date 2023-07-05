<?php

namespace App\Http\Controllers;

use App\Repositories\Interfaces\LinkRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LinkController extends Controller
{
    private LinkRepositoryInterface $linkRepository;

    public function __construct(LinkRepositoryInterface $linkRepository)
    {
        $this->linkRepository = $linkRepository;
    }

    public function index(): JsonResponse {
        $data = $this->linkRepository->get();
        return response()->json(['payload' => $data]);
    }

    public function store(Request $request): JsonResponse {
        try {
            $data = $this->linkRepository->create($request->only('link'));
            return response()->json(['payload' => $data]);
        } catch (\Exception $e) {
            return response()->json(['payload' => $e->getMessage()]);
        }
    }
}
