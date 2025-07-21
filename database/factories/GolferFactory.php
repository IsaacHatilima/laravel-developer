<?php

namespace Database\Factories;

use App\Models\Golfer;
use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Factories\Factory;
use Random\RandomException;

/**
 * @extends Factory<Golfer>
 */
class GolferFactory extends Factory
{
    protected static ?int $debitorCounter = null;

    /**
     * Define the model's default state.
     *
     * @return array{
     *     debitor_account: int,
     *     name: string,
     *     email: string,
     *     born_at: CarbonImmutable,
     *     latitude: float,
     *     longitude: float
     * }
     *
     * @throws RandomException
     */
    public function definition(): array
    {
        if (is_null(self::$debitorCounter)) {
            // Initialize the debitor counter to the maximum existing value or 1 if none exist
            self::$debitorCounter = Golfer::max('debitor_account') ?? 1;
        }

        return [
            'debitor_account' => self::$debitorCounter++,
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'born_at' => today()->subDays(random_int(0, 365))->subYears(random_int(10, 100))->toImmutable(),
            // approximately the outer boundaries of Germany
            'latitude' => round(fake()->longitude(47.3, 55.0), 4),
            'longitude' => round(fake()->latitude(5.8, 15.0), 4),
        ];
    }
}
