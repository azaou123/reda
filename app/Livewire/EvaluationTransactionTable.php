<?php

namespace App\Livewire;

use App\Models\Evaluation\EvaluationCompany;
use App\Models\Evaluation\EvaluationTransaction;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Exportable;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Footer;
use PowerComponents\LivewirePowerGrid\Header;
use PowerComponents\LivewirePowerGrid\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridColumns;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\Traits\WithExport;

final class EvaluationTransactionTable extends PowerGridComponent
{
    use WithExport;

    public string $sortDirection = 'desc';
    public string $primaryKey = 'evaluation_transactions.id';

    public function setUp(): array
    {
        $this->showCheckBox();

        return [
            Exportable::make('export')->striped()->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),
            Header::make()->showSearchInput(),
            Footer::make()->showPerPage()->showRecordCount(),
        ];
    }

    public function datasource(): Builder
    {
        return EvaluationTransaction::query()
            ->join('evaluation_companies', function ($query) {
                $query->on('evaluation_transactions.evaluation_company_id', '=', 'evaluation_companies.id');
            })->join('evaluation_employees', function ($query) {
                $query->on('evaluation_transactions.previewer_id', '=', 'evaluation_employees.id');
            })->join('categories', function ($query) {
                $query->on('evaluation_transactions.city_id', '=', 'categories.id');
            })->select([
                'evaluation_transactions.id',
                'evaluation_transactions.instrument_number',
                'evaluation_transactions.transaction_number',
                'evaluation_transactions.phone',
                'evaluation_transactions.region',
                'evaluation_transactions.company_fundoms',
                'evaluation_transactions.review_fundoms',
                'evaluation_transactions.owner_name',
                'evaluation_transactions.is_iterated',
                'evaluation_transactions.status',
                'evaluation_transactions.notes',

                'categories.title as category_title',
                'evaluation_employees.title as employee_name',
                'evaluation_companies.title as company_title',
            ]);
    }

    public function relationSearch(): array
    {
        return ['company' => [
            'title',
        ]];
    }

    public function addColumns(): PowerGridColumns
    {
        return PowerGrid::columns()
            ->addColumn('id')
            ->addColumn('instrument_number')
            ->addColumn('transaction_number')
            ->addColumn('phone')
            ->addColumn('company_title')
            ->addColumn('region')
            ->addColumn('company_fundoms')
            ->addColumn('review_fundoms')
            ->addColumn('category_title')
            ->addColumn('employee_name')
            ->addColumn('is_iterated', fn(EvaluationTransaction $model) => $model->is_iterated ? 'نعم' : 'لا')
            ->addColumn('status', function (EvaluationTransaction $model) {
                if ($model->status == 0) {
                    return "<span class='badge badge-pill alert-table badge-warning'>" . __('admin.NewTransaction') . "</span>";
                } elseif ($model->status == 1) {
                    return "<span class='badge badge-pill alert-table badge-info'>" . __('admin.InReviewRequest') . "</span>";
                } elseif ($model->status == 2) {
                    return "<span class='badge badge-pill alert-table badge-primary'>" . __('admin.ContactedRequest') . "</span>";
                } elseif ($model->status == 3) {
                    return "<span class='badge badge-pill alert-table badge-danger'>" . __('admin.ReviewedRequest') . "</span>";
                } elseif ($model->status == 4) {
                    return "<span class='badge badge-pill alert-table badge-success'>" . __('admin.FinishedRequest') . "</span>";
                } elseif ($model->status == 5) {
                    return "<span class='badge badge-pill alert-table badge-warning'>" . __('admin.PendingRequest') . "</span>";
                } elseif ($model->status == 6) {
                    return "<span class='badge badge-pill alert-table badge-warning'>" . __('admin.Cancelled') . "</span>";
                } else {
                    return '';
                }
            })
            ->addColumn('notes')
            ->addColumn('updated_at_formatted', fn(EvaluationTransaction $model) => Carbon::parse($model->updated_at)->format('d/m/Y'));
    }

    public function columns(): array
    {
        return [
            Column::make('Id', 'id'),
            Column::make(trans('admin.instrument_number'), 'instrument_number')->sortable()->searchable(),
            Column::make(trans('admin.transaction_number'), 'transaction_number')->sortable()->searchable(),
            Column::make(trans('admin.phone'), 'phone')->searchable(),
            Column::make(trans('admin.company'), 'company_title', 'evaluation_companies.title')->sortable()->searchable(),
            Column::make(trans('admin.region'), 'region')->searchable(),
            Column::make(trans('admin.company_fundoms'), 'company_fundoms'),
            Column::make(trans('admin.review_fundoms'), 'review_fundoms'),
            Column::make(trans('admin.previewer'), 'employee_name', 'evaluation_employees.title')->sortable()->searchable(),

            Column::make(trans('admin.TransactionDetail'), 'category_title', 'categories.title')->sortable()->searchable(),

            Column::make(trans('admin.Status'), 'status', 'evaluation_transactions.status')->sortable(),

            Column::make(trans('admin.is_iterated'), 'is_iterated', 'is_iterated')->sortable(),
            Column::make(trans('admin.LastUpdate'), 'updated_at_formatted', 'updated_at')->sortable(),
            Column::make(trans('admin.notes'), 'notes')->searchable(),
            Column::action(trans('admin.Actions'))
        ];
    }

    public function filters(): array
    {
        return [
            Filter::inputText('instrument_number')->operators(['contains']),
            Filter::inputText('transaction_number')->operators(['contains']),
            Filter::multiSelect('evaluation_company_id')->dataSource(EvaluationCompany::all())->optionValue('id')->optionLabel('title'),
            Filter::boolean('is_iterated')->label('نعم', 'لا'),
            Filter::datepicker('updated_at'),
            Filter::inputText('owner_name')->operators(['contains']),
            Filter::inputText('region')->operators(['contains']),
            Filter::inputText('phone')->operators(['contains']),
            Filter::datetimepicker('created_at'),
        ];
    }

    public function actions(\App\Models\Evaluation\EvaluationTransaction $row): array
    {
        return [
            Button::add('show')
                ->slot('<i class="fa fa-eye"></i>')
                ->class('pg-btn-white text-warning dark:ring-pg-primary-600 dark:border-pg-primary-600 dark:hover:bg-pg-primary-700 dark:ring-offset-pg-primary-800 dark:text-pg-primary-300 dark:bg-pg-primary-700')
                ->route('admin.evaluation-transactions.show', ['evaluation_transaction' => $row->id]),
            Button::add('edit')
                ->slot('<i class="fa fa-edit"></i>')
                ->class('pg-btn-white text-secondary dark:ring-pg-primary-600 dark:border-pg-primary-600 dark:hover:bg-pg-primary-700 dark:ring-offset-pg-primary-800 dark:text-pg-primary-300 dark:bg-pg-primary-700')
                ->route('admin.evaluation-transactions.edit', ['evaluation_transaction' => $row->id]),
            Button::add('delete')
                ->bladeComponent('delete-form', ['id' => $row->id])
        ];
    }

    /*
    public function actionRules($row): array
    {
       return [
            // Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($row) => $row->id === 1)
                ->hide(),
        ];
    }
    */
}
