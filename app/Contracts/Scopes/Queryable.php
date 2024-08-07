<?php

declare(strict_types=1);

namespace App\Contracts\Scopes;

use Illuminate\Database\Eloquent\Builder;

/**
 * @template TModelClass of \Illuminate\Database\Eloquent\Model
 */
interface Queryable
{
    /**
     * @param  Builder<TModelClass>  $query
     */
    public function __invoke(Builder $query): void;
}
