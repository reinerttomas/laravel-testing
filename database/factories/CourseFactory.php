<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Course;
use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{
    protected $model = Course::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(),
            'description' => $this->faker->paragraph(),
        ];
    }

    public function released(?CarbonImmutable $releasedAt = null): self
    {
        return $this->state([
            'released_at' => $releasedAt ?? CarbonImmutable::now(),
        ]);
    }
}
