<?php

namespace App\Livewire;

use Filament\Widgets\ChartWidget;

class EnteryEmployeeCountWidget extends ChartWidget
{
    protected static ?string $heading = 'Chart';

    protected function getData(): array
    {
        return [
            //
        ];
    }

    protected function getType(): string
    {
        return 'pie';
    }
}
