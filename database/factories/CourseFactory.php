<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Course;
use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{
    protected $model = Course::class;

    public function definition(): array
    {
        return [
            'slug' => $this->faker->unique()->slug(),
            'tagline' => $this->faker->sentence(),
            'title' => $this->faker->sentence(),
            'description' => $this->faker->paragraph(),
            'image_name' => 'image.jpg',
            'learnings' => ['Learn A', 'Learn B', 'Learn C'],
        ];
    }

    public function released(?CarbonImmutable $releasedAt = null): self
    {
        return $this->state([
            'released_at' => $releasedAt ?? CarbonImmutable::now(),
        ]);
    }
}
