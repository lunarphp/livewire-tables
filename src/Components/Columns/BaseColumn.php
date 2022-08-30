<?php

namespace GetCandy\LivewireTables\Components\Columns;

use Closure;
use GetCandy\LivewireTables\Components\Columns\Concerns\HasClosure;
use GetCandy\LivewireTables\Components\Columns\Concerns\HasLivewireComponent;
use GetCandy\LivewireTables\Components\Columns\Concerns\HasViewComponent;
use GetCandy\LivewireTables\Components\Concerns\HasViewProperties;
use Livewire\Component;

abstract class BaseColumn extends Component
{
    use HasLivewireComponent,
        HasClosure,
        HasViewComponent,
        HasViewProperties;

    /**
     * The instance of the record from the table row.
     *
     * @var mixed
     */
    public $record;


    protected $sortable = false;




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
