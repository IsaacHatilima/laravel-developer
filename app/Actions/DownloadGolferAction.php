<?php

namespace App\Actions;

use App\Repository\GolferRepository;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class DownloadGolferAction
{
    private GolferRepository $golferRepository;

    public function __construct(GolferRepository $golferRepository)
    {
        $this->golferRepository = $golferRepository;
    }

    public function execute(Request $request): StreamedResponse
    {
        $golfers = $this->golferRepository->download($request);

        return response()->streamDownload(function () use ($golfers) {
            $handle = fopen('php://output', 'w');

            // CSV headers
            fputcsv($handle, [
                'id',
                'debitor_account',
                'name',
                'email',
                'latitude',
                'longitude',
                'born_at',
                'distance_km',
            ]);

            // CSV rows
            foreach ($golfers as $golfer) {
                fputcsv($handle, [
                    $golfer->id,
                    $golfer->debitor_account,
                    $golfer->name,
                    $golfer->email,
                    $golfer->latitude,
                    $golfer->longitude,
                    $golfer->born_at->toDateString(),
                    round($golfer->distance, 2),
                ]);
            }

            fclose($handle);
        }, 'golfers.csv', [
            'Content-Type' => 'text/csv',
        ]);
    }
}
