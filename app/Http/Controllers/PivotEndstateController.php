<?php

namespace App\Http\Controllers;

use App\Models\PivotEndstateModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class PivotEndstateController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Report PIVOT ENDSTATE',
        ];

        $activeMenu = 'pivotendstate';

        return view('pivotendstate.index', ['breadcrumb' => $breadcrumb, 'activeMenu' => $activeMenu]);
    }

    // Ambil data dalam bentuk json untuk datatables 
    public function list(Request $request)
    {
        $pivotendstates = PivotEndstateModel::with('sektor', 'wilayah', 'endstate')
            ->select('id_pivot_endstate', 'report_pivot_endstate.id_sektor', 'report_pivot_endstate.id_wilayah', 'report_pivot_endstate.id_endstate');

        return DataTables::of($pivotendstates)
            ->addIndexColumn()
            ->addColumn('ps_pi_tot', function ($row) {
                $endstate = DB::table('endstate')
                    ->where('id_endstate', $row->id_endstate)
                    ->select('ps_tot', 'pi_tot')
                    ->first();
            
                if ($endstate) {
                    return $endstate->pi_tot != 0 
                        ? round(($endstate->ps_tot / $endstate->pi_tot) * 100, 2) . '%'
                        : 'N/A';
                }
            
                return 'N/A';
            })
            ->addColumn('cancel_pi_tot', function ($row) {
                $endstate = DB::table('report_pivot_endstate')
                    ->where('id_endstate', $row->id_endstate)
                    ->select('pi_tot', 'accomp')
                    ->first();
            
                $pivotEndstate = DB::table('report_pivot_endstate')
                    ->where('id_pivot_endstate', $row->id_pivot_endstate)
                    ->select('cancel_tot')
                    ->first();
            
                if ($endstate && $pivotEndstate) {
                    return $endstate->pi_tot != 0
                        ? round(($pivotEndstate->cancel_tot / $endstate->pi_tot) * 100, 2) . '%'
                        : 'N/A';
                }
            
                return 'N/A';
            })
            ->addColumn('fallout_pi_tot', function ($row) {
                $endstate = DB::table('report_pivot_endstate')
                    ->where('id_endstate', $row->id_endstate)
                    ->select('pi_tot', 'accomp')
                    ->first();
            
                $pivotEndstate = DB::table('report_pivot_endstate')
                    ->where('id_pivot_endstate', $row->id_pivot_endstate)
                    ->select('fallout_tot')
                    ->first();
            
                if ($endstate && $pivotEndstate) {
                    return $endstate->pi_tot != 0
                        ? round(($pivotEndstate->fallout_tot / $endstate->pi_tot) * 100, 2) . '%'
                        : 'N/A';
                }
            
                return 'N/A';
            })
            ->make(true);
    }

    // METHOD STORE BELUM
    // STORE UNTUK SIMPAN FILE UPLOAD DAN MENGOLAH FILTERNYA
    // LALU HASIL STORE DIMASUKKAN KE TABEL REPORT
}
