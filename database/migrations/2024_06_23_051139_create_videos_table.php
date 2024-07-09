<?php

declare(strict_types=1);

use App\Models\Course;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Course::class);
            $table->string('slug')->unique();
            $table->string('vimeo_id')->unique();
            $table->string('title');
            $table->text('description');
            $table->integer('duration_in_min');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('videos');
    }
};
