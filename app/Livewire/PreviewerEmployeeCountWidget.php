<?php

namespace App\Livewire;

use App\Models\Evaluation\EvaluationTransaction;
use Filament\Support\RawJs;
use Filament\Widgets\ChartWidget;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\On;

class PreviewerEmployeeCountWidget extends ChartWidget
{
    protected static ?string $heading = 'موظفين المعاينة';
    protected static ?string $maxHeight = '500px';

    public array $filters = [
        'from' => '',
        'to' => '',
    ];

    protected function getData(): array
    {
        $data = EvaluationTransaction::when($this->filters['from'] ?? false, function (Builder $builder, $from) {
            $builder->where('evaluation_transactions.created_at', '>=', $from);
        })->when($this->filters['to'], function (Builder $builder, $to) {
            $builder->whereDate('evaluation_transactions.created_at', '<=', $to);
        })->join('evaluation_employees', 'evaluation_employees.id', 'evaluation_transactions.previewer_id')
            ->select('evaluation_employees.title', \DB::raw('COUNT(*) as employee_count'))
            ->groupBy('evaluation_transactions.previewer_id')
            ->orderBy('employee_count', 'desc')
            ->get();

        return [
            'datasets' => [
                [
                    'label' => 'Blog posts created',
                    'data' => $data->flatten()->pluck('employee_count'),
                    'backgroundColor' => ["#34344a", "#47394f", "#513c52", "#5a3e54", "#6d4359", "#80475e", "#a65168", "#b9566d", "#c3586f", "#cc5a71"]

                ],
            ],
            'labels' => $data->flatten()->pluck('title'),
        ];
    }

    protected function getType(): string
    {
        return 'pie';
    }

    #[On('updateFromDate')]
    public function updateFromDate(string $from): void
    {
        $this->filters['from'] = $from;
        $this->updateChartData();
    }

    #[On('updateToDate')]
    public function updateToDate(string $to): void
    {
        $this->filters['to'] = $to;
        $this->updateChartData();
    }

    protected function getOptions(): RawJs
    {
        return RawJs::make(<<<JS
            {
               plugins:{
                   legend:{
                       'display':true,
                       'rtl':true,
                       'position':'right',
                       'labels':{
                           'generateLabels':(chart  )=>{
                               const pie = chart.data;
                               console.log(pie);
                               return pie.labels.map(function(item, index) {
                                 return {
                                     text:item + ' ( ' + pie.datasets[0].data[index] + ' ) ',
                                     fontColor : pie.datasets[0].backgroundColor[index%10],
                                     fillStyle:pie.datasets[0].backgroundColor[index%10],
                                 }
                               })
                           }
                       }

                   }
               },
               scales:{
                   x:{
                       display:false
                   },
                   y:{
                       display:false
                   }
               }
            }
        JS
        );
    }
}
