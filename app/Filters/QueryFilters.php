<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

abstract class QueryFilters
{

    /**
     * @var \Illuminate\Http\Request
     */
    protected $request;

    /**
     * @var \Illuminate\Database\Eloquent\Builder
     */
    protected $builder;

    /**
     * @var array
     */
    protected $allowedSort;

    /**
     * @var array
     */
    protected $defaults = [
        'sort' => [
            'column'    => 'id',
            'direction' => 'asc',
        ]
    ];

    /**
     * Class constructor.
     *
     * @param \Illuminate\Http\Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Apply existing filters to eloquent query.
     *
     * @param \Illuminate\Database\Eloquent\Builder $builder
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function apply(Builder $builder)
    {
        $this->builder = $builder;

        foreach ($this->filters() as $name => $value) {
            if (! method_exists($this, Str::camel($name))) {
                continue;
            }

            $this->$name($value);
        }

        $this->order();

        return $this->builder;
    }

    /**
     * Get all request filters data.
     *
     * @return array
     */
    public function filters()
    {
        return $this->request->all();
    }

    /**
     * Perform collection sort.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function order()
    {
        list($column, $direction) = [strtolower($this->request->get('sort')), strtolower($this->request->get('direction'))];

        $column = in_array($column, $this->allowedSort) ? $column : $this->defaults['sort']['column'];

        $direction = in_array($direction, ['asc', 'desc']) ? $direction : $this->defaults['sort']['direction'];

        return $this->builder->orderBy($column, $direction);
    }
}
