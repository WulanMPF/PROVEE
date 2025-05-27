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
        $pivotendstates = PivotEndstateModel::with('sektor')
            ->select('id_pivot_endstate', 'report_pivot_endstate.id_sektor', 'pi_tot', 'ps_tot', 'cancel_tot', 'fallout_tot');

        return DataTables::of($pivotendstates)
            ->addIndexColumn()
            ->addColumn('ps_pi_tot', function ($row) {
                return $row->pi_tot != 0 ? round(($row->ps_tot / $row->pi_tot) * 100, 2) . '%' : '100%';
            })
            ->addColumn('cancel_pi_tot', function ($row) {
                return $row->pi_tot != 0 ? round(($row->cancel_tot / $row->pi_tot) * 100, 2) . '%' : '100%';
            })
            ->addColumn('fallout_pi_tot', function ($row) {
                return $row->pi_tot != 0 ? round(($row->fallout_tot / $row->pi_tot) * 100, 2) . '%' : '100%';
            })
            ->make(true);
    }
}
