<?php

namespace GetCandy\LivewireTables;

use GetCandy\LivewireTables\Components\Columns\BaseColumn;
use Illuminate\Support\Collection;

class TableManifest
{
    public Collection $columns;

    public function __construct()
    {
        $this->columns = collect();
    }

    public function addColumn(BaseColumn $column)
    {
        $this->columns[] = $column;
    }

    public function getColumns()
    {
        return $this->columns;
    }
}
