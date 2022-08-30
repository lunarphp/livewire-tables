<?php

namespace GetCandy\LivewireTables\Components\Filters;

use GetCandy\LivewireTables\Components\Concerns\HasViewProperties;
use Livewire\Component;
use Illuminate\Contracts\Support\Htmlable;
use Livewire\LifecycleManager;

abstract class BaseFilter extends Component implements Htmlable
{
    use HasViewProperties;

    public $view = 'tables::filters.base';

    public function toHtml()
    {
        return $this->render();
    }

    public function render()
    {
        return view($this->view, array_merge([
            'field' => $this->field,
            'heading' => $this->getHeading(),
        ], $this->getViewData()));
    }
}
