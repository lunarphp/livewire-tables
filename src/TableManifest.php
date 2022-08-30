<?php

namespace GetCandy\LivewireTables;

use GetCandy\LivewireTables\Components\Columns\BaseColumn;
use GetCandy\LivewireTables\Components\Filters\BaseFilter;
use Illuminate\Support\Collection;

class TableManifest
{
    public Collection $columns;

    public Collection $filters;

    public function __construct()
    {
        $this->columns = collect();
        $this->filters = collect();
    }

    public function addColumn(BaseColumn $column)
    {
        $this->columns[] = $column;
    }

    public function getColumns()
    {
        return $this->columns;
    }

    public function addFilter(BaseFilter $filter)
    {
        $this->filters->push($filter);
    }

    public function getFilters()
    {
        return $this->filters;
    }
}
