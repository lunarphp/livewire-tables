<?php

namespace GetCandy\LivewireTables\Components\Concerns;

trait HasViewProperties
{
    public $field = null;

    public $heading = null;

    public function field($field)
    {
        $this->field = $field;

        return $this;
    }

    public function heading($heading): self
    {
        $this->heading = $heading;

        return $this;
    }

    public function getHeading()
    {
        return $this->heading ?: $this->field;
    }

    public static function make($field)
    {
        return app(static::class)->field($field);
    }
}
