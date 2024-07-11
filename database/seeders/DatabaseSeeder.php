<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;

final class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(AddGivenCoursesSeeder::class);
        $this->call(AddGivenVideosSeeder::class);
        $this->call(AddLocalTestUserSeeder::class);
    }
}
