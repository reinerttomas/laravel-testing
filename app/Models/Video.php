<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Video extends Model
{
    use HasFactory;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<\App\Models\Course, \App\Models\Video>
     */
    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function getReadableDuration(): string
    {
        return Str::of((string) $this->duration_in_min)->append('min')->toString();
    }
}
