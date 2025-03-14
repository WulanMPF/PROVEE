<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\XproModel;
use Yajra\DataTables\DataTables;

class XproController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Report New XPRO',
        ];

        $activeMenu = 'xpro';

        return view('xpro.index', ['breadcrumb' => $breadcrumb, 'activeMenu' => $activeMenu]);
    }

    // Ambil data dalam bentuk json untuk datatables 
    public function list(Request $request)
    {
        $xpros = XproModel::with('wilayah')
            ->select('id_xpro', 'report_xpro.id_wilayah', 're_hi', 'pi_hi', 'ps_hi', 'accomp', 're_tot', 'pi_tot', 'ps_tot');

        return DataTables::of($xpros)
            ->addIndexColumn()
            ->addColumn('ps_re_hi', function ($row) {
                return $row->re_hi != 0 ? round(($row->ps_hi / $row->re_hi) * 100, 2) . '%' : 'N/A';
            })
            ->addColumn('ps_pi_hi', function ($row) {
                return $row->pi_hi != 0 ? round(($row->ps_hi / $row->pi_hi) * 100, 2) . '%' : 'N/A';
            })
            ->addColumn('ps_re_tot', function ($row) {
                return $row->re_tot != 0 ? round(($row->ps_tot / $row->re_tot) * 100, 2) . '%' : 'N/A';
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
