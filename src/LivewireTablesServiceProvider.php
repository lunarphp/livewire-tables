<?php

namespace GetCandy\LivewireTables;

use GetCandy\LivewireTables\Components\Columns\TextColumn;
use GetCandy\LivewireTables\Components\Filters\SelectFilter;
use GetCandy\LivewireTables\Components\Head;
use GetCandy\LivewireTables\Components\Table;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class LivewireTablesServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $components = [
            Table::class,
            TextColumn::class,
            Head::class,
            SelectFilter::class,
        ];

        foreach ($components as $component) {
            Livewire::component((new $component)->getName(), $component);
        }

        Blade::componentNamespace('GetCandy\\LivewireTables\\View', 'tables');

        $this->loadViewsFrom(__DIR__.'/../resources/views', 'tables');

        $this->publishes([
            __DIR__ . '/../resources/views' => resource_path('views/vendor/getcandy'),
        ], 'getcandy.livewiretables.components');

        $this->publishes([
            __DIR__.'/../dist' => public_path('vendor/getcandy'),
        ], 'getcandy.livewiretables.public');
    }
}
