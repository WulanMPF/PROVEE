<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Imports\XproImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\XproModel;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\DataTables;
use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;

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

    public function import(Request $request)
    {
        return view('xpro.index');
    }

    public function import_proses(Request $request)
    {
        // dd($request->all());
        Excel::import(new XproImport(), $request->file('file'));
        return redirect()->back();
    }
}
