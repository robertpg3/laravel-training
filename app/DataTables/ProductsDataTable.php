<?php

namespace App\DataTables;

namespace App\DataTables;

use App\Models\Product;
use App\User;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ProductsDataTable extends DataTable
{
    public function dataTable($query)
    {
        return datatables()->eloquent($query)->addColumn('action', function($data) {
                return view('/shop/update_button',
                    [
                        'updateRoute' => "/admin/products/edit/$data->id",
                        'removeRoute' => "/admin/products/remove/$data->id"
                    ]);
            }
        );
    }

    public function query(Product $model)
    {
        return $model->newQuery();
    }

    public function html()
    {
        return $this->builder()
            ->setTableId('products-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->orderBy(1)
            ->buttons(
                Button::make('create'),
                Button::make('export'),
                Button::make('print'),
                Button::make('reset'),
                Button::make('reload')
            );
    }

    protected function getColumns()
    {
        return [
            Column::make('id'),
            Column::make('name'),
            Column::make('description'),
            Column::make('price'),
            Column::make('units'),
            Column::make('category_id')->width(20),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(120)
                ->addClass('text-center'),
        ];
    }

    protected function filename()
    {
        return 'Products_' . date('YmdHis');
    }
}
