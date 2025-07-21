<?php

namespace App\Repository;

use App\Models\Golfer;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class GolferRepository
{
    /**
     * Returns all member of golfers
     *
     *
     * @return LengthAwarePaginator<int, Golfer>
     */
    public function all(Request $request): LengthAwarePaginator
    {
        $latitude = $request->input('latitude');
        $longitude = $request->input('longitude');

        if (! is_numeric($latitude) || ! is_numeric($longitude)) {
            abort(400, 'Invalid or missing latitude/longitude.');
        }

        $query = Golfer::selectRaw('
        golfers.*,
        (6371 * acos(
            cos(radians(?)) * cos(radians(latitude)) *
            cos(radians(longitude) - radians(?)) +
            sin(radians(?)) * sin(radians(latitude))
        )) AS distance', [
            $latitude,
            $longitude,
            $latitude,
        ])->orderBy('distance');

        $perPage = min((int) $request->input('per_page', 15), 500);

        return $query->paginate($perPage)->withQueryString();
    }

    /**
     * Returns all member of golfers
     *
     *
     * @return Collection<int, Golfer>
     */
    public function download(Request $request): Collection
    {
        $latitude = $request->input('latitude');
        $longitude = $request->input('longitude');

        if (! is_numeric($latitude) || ! is_numeric($longitude)) {
            abort(400, 'Invalid or missing latitude/longitude.');
        }

        return Golfer::selectRaw('
        golfers.*,
        (6371 * acos(
            cos(radians(?)) * cos(radians(latitude)) *
            cos(radians(longitude) - radians(?)) +
            sin(radians(?)) * sin(radians(latitude))
        )) AS distance', [
            $latitude,
            $longitude,
            $latitude,
        ])
            ->orderBy('distance')
            ->limit(500)
            ->get();
    }
}
