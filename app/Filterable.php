<?php

namespace App;

use App\Filters\QueryFilters;
use Illuminate\Database\Eloquent\Builder;

trait Filterable
{
    /**
     * @param \Illuminate\Database\Eloquent\Builder $builder
     * @param \App\Filters\QueryFilters $filters
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFilter(Builder $builder, QueryFilters $filters)
    {
        return $filters->apply($builder);
    }
}
