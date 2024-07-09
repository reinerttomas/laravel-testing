<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Video;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Video>
 */
class VideoFactory extends Factory
{
    protected $model = Video::class;

    public function definition(): array
    {
        return [
            'slug' => $this->faker->unique()->slug(),
            'vimeo_id' => $this->faker->unique()->uuid(),
            'title' => $this->faker->sentence(),
            'description' => $this->faker->paragraph(),
            'duration' => $this->faker->numberBetween(1, 99),
        ];
    }
}
