<?php

namespace GetCandy\LivewireTables\Support;

use GetCandy\LivewireTables\Components\Actions\Action;
use GetCandy\LivewireTables\Components\Actions\BulkAction;
use GetCandy\LivewireTables\Components\Columns\BaseColumn;
use GetCandy\LivewireTables\Components\Filters\BaseFilter;
use Illuminate\Support\Collection;

class TableBuilder implements TableBuilderInterface
{
    /**
     * The columns available to the table.
     *
     * @var Collection
     */
    public Collection $columns;

    /**
     * The base columns set on the table.
     *
     * @var Collection
     */
    public Collection $baseColumns;

    /**
     * The filters available to the table.
     *
     * @var Collection
     */
    public Collection $filters;

    /**
     * The actions available to the table.
     *
     * @var Collection
     */
    public Collection $actions;

    /**
     * The bulk actions available.
     *
     * @var Collection
     */
    public Collection $bulkActions;

    /**
     * Initialise the TableBuilder
     */
    public function __construct()
    {
        $this->columns = collect();
        $this->baseColumns = collect();
        $this->filters = collect();
        $this->actions = collect();
        $this->bulkActions = collect();
    }

    public function addColumn(BaseColumn $column): self
    {
        $this->columns->prepend($column);

        return $this;
    }

    public function addColumns(iterable $columns): self
    {
        $this->columns = $this->columns->merge($columns);

        return $this;
    }

    public function baseColumns(iterable $columns): self
    {
        $this->baseColumns = collect($columns);

        return $this;
    }

    public function getColumns(): Collection
    {
        return $this->baseColumns->merge(
            $this->columns
        );
    }

    public function addFilter(BaseFilter $filter): self
    {
        $this->filters->push($filter);

        return $this;
    }

    public function getFilters(): Collection
    {
        return $this->filters;
    }

    public function addAction(Action $action): self
    {
        $this->actions->push($action);
        return $this;
    }

    public function getActions(): Collection
    {
        return $this->actions;
    }

    public function addBulkAction(BulkAction $bulkAction): self
    {
        $this->bulkActions->push($bulkAction);
        return $this;
    }

    public function getBulkActions(): Collection
    {
        return $this->bulkActions;
    }

    public function getData($searchTerm = null, $filters = [], $sortField = 'placed_at', $sortDir = 'desc')
    {
        return collect();
    }
}
