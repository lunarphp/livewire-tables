<?php

namespace GetCandy\LivewireTables\Support;

use GetCandy\LivewireTables\Components\Actions\Action;
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
     * Initialise the TableBuilder
     */
    public function __construct()
    {
        $this->columns = collect();
        $this->filters = collect();
        $this->actions = collect();
    }

    /**
     * Add a column to the table builder.
     *
     * @param BaseColumn $column
     *
     * @return void
     */
    public function addColumn(BaseColumn $column): self
    {
        $this->columns->push($column);

        return $this;
    }

    /**
     * Return the available columns.
     *
     * @return Collection
     */
    public function getColumns(): Collection
    {
        return $this->columns;
    }

    /**
     * Add a filter to the table.
     *
     * @param BaseFilter $filter
     *
     * @return self
     */
    public function addFilter(BaseFilter $filter): self
    {
        $this->filters->push($filter);

        return $this;
    }

    /**
     * Return the available filters.
     *
     * @return Collection
     */
    public function getFilters(): Collection
    {
        return $this->filters;
    }

    /**
     * Add an action to the builder.
     *
     * @param Action $action
     *
     * @return self
     */
    public function addAction(Action $action): self
    {
        $this->actions->push($action);
        return $this;
    }

    /**
     * Return the available actions.
     *
     * @return Collection
     */
    public function getActions(): Collection
    {
        return $this->actions;
    }
}
