<?php

namespace App\DataTables;

use App\Models\Clientdatanew;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ClientdatanewDataTable extends DataTable
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
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Clientdatanew $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Clientdatanew $model)
    {
        $date = $this->request()->get(key:'date');
        $res = explode(" ", $date);
        $StartDate = $res[0];
        $EndDate = $res[2];

        $StartDate = Carbon::createFromFormat('m/d/Y', $StartDate);
        $StartDate = $StartDate->toDateString();

        $EndDate = Carbon::createFromFormat('m/d/Y', $EndDate);
        $EndDate = $EndDate->toDateString();

        $query = DB::table('clientdatanews')
       
        ->get();
        dd($query);
        // $query = $model->newQuery();

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
            ->setTableId('clientdatanew-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->parameters([
                "lengthChange" => false,
                "autoWidth"=> false,
                'scrollX' => true
            ])
            // ->dom('Bfrtip')
            ->orderBy(1)
           ;
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
          
            'ticket_no',
            'customer_name',
            'mobile_number',
            'email_id',
            'interaction_type',
            'product_type',
            'contact_reason',
            'contact_reason',
            'contact_reason_type',
            'contact_reason_sub_sub_type',
            'booking_id',
            'chasis_number',
            'city',
            'pincode',
            'purchase_date',
            'warranty_status',
            'dealership',
            'dealership_location',
            'call_status',
            'call_status_sub_type',
            'call_status_sub_sub_type',
            'final_call_status',
            'remark',
            'ResolutionProvided',
            'product_issue',
            'agent_id',
            'created_at',
        ];
    }
}
