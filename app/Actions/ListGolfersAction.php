<?php

namespace App\Actions;

use App\Http\Resources\GolferResource;
use App\Repository\GolferRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ListGolfersAction
{
    private GolferRepository $golferRepository;

    public function __construct(GolferRepository $golferRepository)
    {
        $this->golferRepository = $golferRepository;
    }

    public function execute(Request $request): AnonymousResourceCollection
    {
        $paginator = $this->golferRepository->all($request);

        return GolferResource::collection($paginator);
    }
}
