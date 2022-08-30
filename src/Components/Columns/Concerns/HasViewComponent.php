<?php

namespace GetCandy\LivewireTables\Components\Columns\Concerns;

trait HasViewComponent
{
    /**
     * The reference to the view component.
     *
     * @var string
     */
    protected $viewComponent = null;

    /**
     * Set the view component.
     *
     * @param string $viewComponent
     *
     * @return self
     */
    public function viewComponent($viewComponent): self
    {
        $this->viewComponent = $viewComponent;

        return $this;
    }

    /**
     * Whether the column is a view component.
     *
     * @return bool
     */
    public function isViewComponent(): bool
    {
        return !!$this->viewComponent;
    }

    /**
     * Return the reference to the view component.
     *
     * @return string
     */
    public function getViewComponent(): string
    {
        return $this->viewComponent;
    }
}
