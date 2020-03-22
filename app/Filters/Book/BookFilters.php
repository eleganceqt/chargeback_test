<?php

namespace App\Filters\Book;

use App\Filters\QueryFilters;

class BookFilters extends QueryFilters
{
    protected $allowedSort = ['id', 'author', 'published_at'];

    /**
     * Filter collection by given title.
     *
     * @param string|null $title
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function title(?string $title)
    {
        if (! empty($title)) {
            $this->builder->whereRaw('title LIKE ?', ['%' . $title . '%']);
        }

        return $this->builder;
    }
}
