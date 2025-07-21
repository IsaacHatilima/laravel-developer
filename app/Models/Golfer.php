<?php

namespace App\Models;

use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Database\Factories\GolferFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Golfer
 *
 * @property int $id
 * @property int $debitor_account
 * @property string $email
 * @property string $name
 * @property float $longitude
 * @property float $latitude
 * @property CarbonImmutable $born_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
class Golfer extends Model
{
    /** @use HasFactory<GolferFactory> */
    use HasFactory;

    protected $fillable = [
        'debitor_account',
        'name',
        'email',
        'born_at',
        'latitude',
        'longitude',
    ];

    protected $casts = [
        'debitor_account' => 'integer',
        'name' => 'string',
        'email' => 'string',
        'born_at' => 'immutable_date',
        'latitude' => 'float',
        'longitude' => 'float',
    ];
}
