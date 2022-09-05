<?php

namespace GetCandy\LivewireTables\Support;

use GetCandy\LivewireTables\Components\Actions\Action;
use GetCandy\LivewireTables\Components\Actions\BulkAction;
use GetCandy\LivewireTables\Components\Columns\BaseColumn;
use GetCandy\LivewireTables\Components\Filters\BaseFilter;
use Illuminate\Support\Collection;

interface TableBuilderInterface
{
    /**
     * Add a column to the table builder.
     *
     * @param BaseColumn $column
     *
     * @return self
     */
    public function addColumn(BaseColumn $column): self;

    /**
     * Add multiple columns to the table builder.
     *
     * @param iterable $columns
     *
     * @return self
     */
    public function addColumns(iterable $columns): self;

    /**
     * Set the base columns that the table builder needs.
     *
     * @param iterable $columns
     *
     * @return self
     */
    public function baseColumns(iterable $columns): self;

    /**
     * Return the columns for the table builder.
     *
     * @return Collection
     */
    public function getColumns(): Collection;

    /**
     * Add a filter to the table builder.
     *
     * @param BaseFilter $filter
     *
     * @return self
     */
    public function addFilter(BaseFilter $filter): self;

    /**
     * Return the filters for the table builder.
     *
     * @return Collection
     */
    public function getFilters(): Collection;

    /**
     * Add an action to the table builder.
     *
     * @param Action $action
     *
     * @return self
     */
    public function addAction(Action $action): self;

    /**
     * Return the actions for the table builder.
     *
     * @return Collection
     */
    public function getActions(): Collection;

    /**
     * Add a bulk action to the table builder.
     *
     * @param BulkAction $bulkAction
     *
     * @return self
     */
    public function addBulkAction(BulkAction $bulkAction): self;

    /**
     * Return the bulk actions for the table builder.
     *
     * @return Collection
     */
    public function getBulkActions(): Collection;

    /**
     * Get the data from the table builder.
     *
     * @param string|null $searchTerm
     * @param Array $filters
     * @param string $sortField
     * @param string $sortDir
     *
     * @return mixed
     */
    public function getData($searchTerm = null, $filters = [], $sortField = 'placed_at', $sortDir = 'desc');
}
