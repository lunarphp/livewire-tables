<?php

namespace GetCandy\LivewireTables\Components\Columns;

use Closure;
use GetCandy\LivewireTables\Components\Columns\Concerns\HasClosure;
use GetCandy\LivewireTables\Components\Columns\Concerns\HasLivewireComponent;
use GetCandy\LivewireTables\Components\Columns\Concerns\HasViewComponent;
use Livewire\Component;

abstract class BaseColumn extends Component
{
    use HasLivewireComponent,
        HasClosure,
        HasViewComponent;

    /**
     * The instance of the record from the table row.
     *
     * @var mixed
     */
    public $record;

    public $field = null;

    protected $heading = null;

    protected $sortable = false;

    public static function make($field)
    {
        return app(static::class)->field($field);
    }

    public function heading($heading)
    {
        $this->heading = $heading;

        return $this;
    }

    public function getHeading()
    {
        return $this->heading ?: $this->field;
    }

    public function sortable(bool $sortable = true): self
    {
        $this->sortable = $sortable;
        return $this;
    }

    public function field($field)
    {
        $this->field = $field;

        return $this;
    }

    public function isSortable()
    {
        return (bool) $this->sortable;
    }

    public function getValue()
    {
        if ($this->closure) {
            return call_user_func($this->closure, $this->record);
        }

        return $this->record->getAttribute(
            $this->field
        );
    }

    public function record($record)
    {
        $this->record = $record;

        return $this;
    }

    public function render()
    {
        return view('tables::columns.base', [
            'value' => $this->getValue(),
        ]);
    }
}
