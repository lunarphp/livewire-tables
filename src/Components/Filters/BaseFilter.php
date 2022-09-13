<?php

namespace Lunar\LivewireTables\Components\Filters;

use Closure;
use Lunar\LivewireTables\Components\Concerns\HasTranslations;
use Lunar\LivewireTables\Components\Concerns\HasViewProperties;
use Illuminate\Contracts\Support\Htmlable;
use Livewire\Component;

abstract class BaseFilter extends Component implements Htmlable
{
    use HasViewProperties,
        HasTranslations;

    public $view = 'tables::filters.base';

    protected $query;

    public function query(Closure $query)
    {
        $this->query = $query;

        return $this;
    }

    public function getQuery()
    {
        return $this->query;
    }

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
