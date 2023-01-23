<?php

namespace App\DataTables;

use App\Models\DrcSendMoneyTransac;
use Carbon\Carbon;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class DateRangeDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query);
            // ->addColumn('action', 'daterangedatatable.action');

        // return (new EloquentDataTable($query));
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\DrcSendMoneyTransac $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(DrcSendMoneyTransac $model)
    {
        $start_date = $this->request()->get(key:'start_date');
        $end_date = $this->request()->get(key:'end_date');

        // dd($start_date,$end_date);
        $query = $model->newQuery();

        if (!empty($start_date) && !empty($end_date)) {
            $start_date = Carbon::parse($start_date);
            $end_date = Carbon::parse($end_date);

            $query = $query->whereBetween('created_at', [$start_date, $end_date]);
        }

        return $query;
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('baraka')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->stateSave(true)
                    ->dom('Bfrtip')
                    // ->responsive()
                    ->autoWidth(false)
                    ->parameters(['scrollX' => true])
                    ->addTableClass('align-middle table-striped fs-6 gy-5')
                    ->parameters([  
                        'buttons' => ['csv','excel','pdf'],  
                    ])
                    ->orderBy(0)
                    ->selectStyleSingle();
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('id'),
            Column::make('merchant_code'),
            Column::make('customer_details'),
            Column::make('amount'),
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
