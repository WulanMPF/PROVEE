<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\EndstateModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class EndstateController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Report END STATE',
        ];

        $activeMenu = 'endstate';

        return view('endstate.index', ['breadcrumb' => $breadcrumb, 'activeMenu' => $activeMenu]);
    }

    // Ambil data dalam bentuk json untuk datatables 
    public function list(Request $request)
    {
        $endstates = EndstateModel::with('wilayah')
            ->select('id_endstate', 'report_endstate.id_wilayah', 'pi_hi', 'ps_hi', 'accomp', 'pi_tot', 'ps_tot', 'target_tot');

        return DataTables::of($endstates)
            ->addIndexColumn()
            ->addColumn('ps_pi_hi', function ($row) {
                return $row->pi_hi != 0 ? round(($row->ps_hi / $row->pi_hi) * 100, 2) . '%' : 'N/A';
            })
            ->addColumn('ps_pi_tot', function ($row) {
                return $row->pi_tot != 0 ? round(($row->ps_tot / $row->pi_tot) * 100, 2) . '%' : 'N/A';
            })
            ->make(true);
    }

    // METHOD STORE BELUM
    // STORE UNTUK SIMPAN FILE UPLOAD DAN MENGOLAH FILTERNYA
    // LALU HASIL STORE DIMASUKKAN KE TABEL REPORT
}
