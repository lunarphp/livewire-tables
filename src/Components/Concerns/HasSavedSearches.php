<?php

namespace GetCandy\LivewireTables\Components\Concerns;

use Illuminate\Support\Collection;

trait HasSavedSearches
{
    /**
     * Whether the table can save searches.
     *
     * @var bool
     */
    public bool $canSaveSearches = false;

    /**
     * The saved search reference
     *
     * @var string|null
     */
    public ?string $savedSearch = null;

    /**
     * The new name for the saved search.
     *
     * @var string
     */
    public ?string $savedSearchName = null;

    /**
     * Return the saved searches available to the table.
     *
     * @return Collection
     */
    public function getSavedSearchesProperty(): Collection
    {
        return collect();
    }

    /**
     * Apply the saved search to the table.
     *
     * @param string $key
     *
     * @return void
     */
    public function applySavedSearch($key)
    {
        $this->filters = [];
        $this->query = null;

        if ($this->savedSearch == $key) {
            $this->savedSearch = null;

            return;
        }
        
        $this->savedSearch = $key;
    }

    /**
     * Save the current search filters and query
     *
     * @return void
     */
    public function saveSearch()
    {
        //
    }

    /**
     * Reset the saved search state to default.
     *
     * @return void
     */
    public function resetSavedSearch()
    {
        $this->savedSearch = false;
    }

    /**
     * Return whether the search state has filters or search applied.
     *
     * @return bool
     */
    public function getHasSearchAppliedProperty(): bool
    {
        if ($this->query) {
            return true;
        }

        $applied = false;

        foreach ($this->filters as $filter) {
            if ($filter) {
                $applied = true;
            }
        }

        return $applied;
    }
}
