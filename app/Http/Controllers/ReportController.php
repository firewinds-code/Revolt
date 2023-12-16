<?php

namespace App\Http\Controllers;

use App\Models\Clientdatanew;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use DataTables;
use App\Exports\UsersExport;
use Exception;
use Maatwebsite\Excel\Facades\Excel;

ini_set("memory_limit", "1024M");

class ReportController extends Controller
{
    //
    public function reportshow()
    {
        //    return $request->isMethod(method:'post') ? $this->create($request) : $dataTable->render('report');
        return view('report');
    }

    public function getreportdata(Request $req)
    {
        $date = $req->date;
        $res = explode(" ", $date);

        $StartDate = $res[0];
        $EndDate = $res[2];
        try {
            $StartDate = Carbon::createFromFormat('m/d/Y', $StartDate);
            $StartDate = $StartDate->toDateString();

            $EndDate = Carbon::createFromFormat('m/d/Y', $EndDate);
            $EndDate = $EndDate->toDateString();
        } catch (Exception) {
            $StartDate = $res[0];
            $EndDate = $res[2];
        }

        // $datatb = DB::table('clientdatanews')->whereBetween('created_at', [$StartDate, $EndDate])->get();l

        $datatb = DB::table('client_data_new')
            ->whereDate('created_at', '>=', $StartDate)
            ->whereDate('created_at', '<=', $EndDate)
            ->get();






        if ($req->ajax()) {

            $query = DB::table('client_data_new')
                ->whereDate('created_at', '>=', $StartDate)
                ->whereDate('created_at', '<=', $EndDate)
                ->get();
            //dd($query);
            return Datatables::of($query)->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" class="btn btn-primary btn-sm">View</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }


        return back();
    }

    public function exportreport(Request $req)
    {
        try {
            \DB::enableQueryLog();
            // dd($req->all());
            $date = $req->date;
            $res = explode(" ", $date);

            $StartDate = $res[0];
            $EndDate = $res[2];
            try {
                $StartDate = Carbon::createFromFormat('m/d/Y', $StartDate);
                $StartDate = $StartDate->toDateString();

                $EndDate = Carbon::createFromFormat('m/d/Y', $EndDate);
                $EndDate = $EndDate->toDateString();
            } catch (Exception) {
                $StartDate = $res[0];
                $EndDate = $res[2];
            }
            $sdate = $StartDate;
            $edate = $EndDate;

            $excelData = DB::table('client_data_new')
                ->whereDate('created_at', '>=', $sdate)
                ->whereDate('created_at', '<=', $edate)
                //->take('5')
                ->get();
            //dd(\DB::getQueryLog());
            //dd($excelData);

            $rep = "Report_" . date('Ymd') . ".csv";

            return Excel::download(new UsersExport($sdate, $edate), $rep);
            //return back();
        } catch (Exception $ex) {
            dd($ex->getMessage());
            $notification = array(
                'error' => $ex->getMessage(),
                // 'error' => $ex
            );
            return back()->with($notification);
        }
    }
}
