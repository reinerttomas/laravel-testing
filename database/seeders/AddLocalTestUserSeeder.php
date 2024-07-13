<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Course;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;

class AddLocalTestUserSeeder extends Seeder
{
    public function run(): void
    {
        if (App::environment('local')) {
            User::truncate();
            $user = User::create([
                'email' => 'john.doe@example.com',
                'name' => 'John Doe',
                'password' => bcrypt('password'),
            ]);

            $user->purchasedCourses()->attach(Course::all());
        }
    }
}
