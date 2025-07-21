<?php

namespace App\Http\Controllers;

use App\Actions\DownloadGolferAction;
use App\Actions\ListGolfersAction;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class GolferController extends Controller
{
    public function index(Request $request, ListGolfersAction $golferRepository): AnonymousResourceCollection
    {
        return $golferRepository->execute($request);
    }

    public function download(Request $request, DownloadGolferAction $action)
    {
        return $action->execute($request);
    }
}
