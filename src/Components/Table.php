<?php

namespace GetCandy\LivewireTables\Components;

use GetCandy\LivewireTables\Support\TableBuilderInterface;
use Livewire\Component;
use Livewire\WithPagination;

class Table extends Component
{
    use WithPagination;

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
     * The field to sort on.
     *
     * @var string|null
     */
    public $sortField = null;

    /**
     * The sort direction.
     *
     * @var string|null
     */
    public $sortDir = null;

    /**
     * The search query
     *
     * @var string|null
     */
    public $query = null;

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
     * Apply the sorting to the query string.
     *
     * @param array|null $event
     *
     * @return void
     */
    public function sort($event)
    {
        if ($event) {
            [$sortField, $sortDir] = explode(':', $event);
            $this->sortField = $sortField;
            $this->sortDir = $sortDir;
        } else {
            $this->sortField = null;
            $this->sortDir = null;
        }
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
