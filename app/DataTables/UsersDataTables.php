<?php

namespace App\DataTables;

use App\Models\User;
use App\Models\UsersDataTable;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class UsersDataTables extends DataTable
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
            ->eloquent($query)
            ->addColumn('avatar', function($users){
                if(is_null($users->avatar)){
                    return '<img src="'.getDummyImageUrl().'" class="direct-chat-img" >';
                }else{
                    return '<img src="'.$users->avatar.'" class="direct-chat-img" >';
                }
            })
            ->addColumn('is_active', function($users){
                if($users->is_active){
                    return '<span class="badge badge-success">Active<span>';
                }else{
                    return '<span class="badge badge-danger">Deactive<span>';
                }
            })
            
            ->addColumn('action', function ($users) {
                $urlAction = url('admin/user/'.$users->id);
                $content = '<a href="' . $urlAction . '" class=" btn-sm btn-primary" title="View Details"><i class="fa fa-eye"></i></a>';
                return $content;
            })
            ->rawColumns(['action','avatar','is_active', 'status'])
            ->addIndexColumn()
            ->make(true);
            // ->addColumn('action', 'usersdatatables.action');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\UsersDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('users-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->orderBy(1)
                    ->parameters([
                        'dom'          => 'Bfrtip',
                        'buttons'      => ['excel', 'csv'],
                    ]);
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
            Column::make('first_name'),
            Column::make('last_name'),
            Column::make('email'),
            Column::make('is_active'),
        ];
        // return [
        //     Column::computed('action')
        //           ->exportable(false)
        //           ->printable(false)
        //           ->width(60)
        //           ->addClass('text-center'),
        //     Column::make('id'),
        //     Column::make('add your columns'),
        //     Column::make('created_at'),
        //     Column::make('updated_at'),
        // ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'UsersDataTables_' . date('YmdHis');
    }
}
