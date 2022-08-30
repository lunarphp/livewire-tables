<?php

namespace GetCandy\LivewireTables\Components;

use GetCandy\LivewireTables\TableManifest;
use Livewire\Component;
use Livewire\WithPagination;

class Table extends Component
{
    use WithPagination;

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

    public $query = null;

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
    public function getManifestProperty()
    {
        return app(TableManifest::class);
    }

    /**
     * Return the columns available to the table.
     *
     * @return Collection
     */
    public function getColumnsProperty()
    {
        return $this->manifest->getColumns();
    }

    public function getTableFiltersProperty()
    {
        return $this->manifest->getFilters();
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

    public function render()
    {
        return view('tables::index');
    }
}
