<?php

namespace App\DataTables;

use App\Models\DrcSendMoneyTransac;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class LastMonthDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     * @return \Yajra\DataTables\EloquentDataTable
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query));
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\DrcSendMoneyTransac $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(DrcSendMoneyTransac $model): QueryBuilder
    {
        return $model->whereBetween('created_at', [Carbon::now()->subMonth()->startOfMonth(), Carbon::now()->subMonth()->endOfMonth()])->where(['action' => "debit"])->orderBy('created_at','desc')->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('drcsendmoneytransac-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->autoWidth(false)
                    // ->responsive()
                    ->stateSave(true)
                    ->parameters(['scrollX' => true])
                    ->addTableClass('align-middle table-row-dashed fs-6 gy-5')
                    ->orderBy(0)
                    ->selectStyleSingle()
                    ->buttons(
                        Button::make('csv'),
                        Button::make('excel')
                    );
    }

    /**
     * Get the dataTable columns definition.
     *
     * @return array
     */
    public function getColumns(): array
    {
        return [
            
            Column::make('id'),
            Column::make('merchant_code'),
            Column::make('customer_details'),
            Column::make( 'amount'),
            Column::make('currency'),
            Column::make('method'),
            Column::make('status'),
            Column::make('action'),
            Column::make('thirdparty_reference'),
            Column::make('paydrc_reference'),
            Column::make('switch_reference'),
            Column::make('telco_reference'),
            Column::make('created_at'),
            Column::make('updated_at'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'DrcSendMoneyTransac_' . date('YmdHis');
    }
}
