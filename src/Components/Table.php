<?php

namespace GetCandy\LivewireTables\Components;

use GetCandy\LivewireTables\Components\Concerns\HasSavedSearches;
use GetCandy\LivewireTables\Components\Concerns\HasSortableColumns;
use GetCandy\LivewireTables\Support\TableBuilderInterface;
use Livewire\Component;
use Illuminate\Support\Collection;
use Livewire\WithPagination;

class Table extends Component
{
    use WithPagination,
        HasSavedSearches,
        HasSortableColumns;

    /**
     * The binding to use when building out the table.
     *
     * @var string
     */
    protected $tableBuilderBinding = TableBuilderInterface::class;

    /**
     * Whether this table should use pagination.
     *
     * @var bool
     */
    public $hasPagination = true;

    /**
     * Whether this table is searchable.
     *
     * @var bool
     */
    public $searchable = false;

    /**
     * The search query
     *
     * @var string|null
     */
    public $query = null;

    /**
     * The array of selected rows.
     *
     * @var array
     */
    public array $selected = [];

    /**
     * The applied filters.
     *
     * @var array
     */
    public array $filters = [];

    /**
     * {@inheritDoc}
     */
    protected $queryString = [
        'sortField',
        'sortDir',
        'query',
        'filters',
        'savedSearch',
    ];

    /**
     * {@inheritDoc}
     */
    public function getListeners()
    {
        return [
            'sort',
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function mount()
    {
        $this->build();
    }

    /**
     * {@inheritDoc}
     */
    public function hydrate()
    {
        $this->build();
    }

    /**
     * Build the table.
     *
     * @return void
     */
    public function build()
    {
        //
    }

    /**
     * Return the rows available to the table.
     *
     * @return Collection
     */
    public function getRowsProperty()
    {
        return $this->getData();
    }

    /**
     * Return the table manifest.
     *
     * @return TableManifest
     */
    public function getTableBuilderProperty()
    {
        return app($this->tableBuilderBinding);
    }

    /**
     * Return the columns available to the table.
     *
     * @return Collection
     */
    public function getColumnsProperty()
    {
        return $this->tableBuilder->getColumns();
    }

    /**
     * Return the filters available to the table.
     *
     * @return Collection
     */
    public function getTableFiltersProperty()
    {
        return $this->tableBuilder->getFilters();
    }

    /**
     * Return the actions available to the table.
     *
     * @return Collection
     */
    public function getActionsProperty()
    {
        return $this->tableBuilder->getActions();
    }

    /**
     * Return the bulk actions available.
     *
     * @return void  Collection
     */
    public function getBulkActionsProperty()
    {
        return $this->tableBuilder->getBulkActions();
    }

    /**
     * Return the search placeholder.
     *
     * @return string
     */
    public function getSearchPlaceholderProperty(): string
    {
        return 'Search';
    }

    /**
     * {@inheritDoc}
     */
    public function render()
    {
        return view('tables::index');
    }
}
