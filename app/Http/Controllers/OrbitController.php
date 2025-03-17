<?php

namespace App\Http\Controllers;

use App\Models\OrbitModel;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class OrbitController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Report ORBIT',
        ];

        $activeMenu = 'orbit';

        return view('orbit.index', ['breadcrumb' => $breadcrumb, 'activeMenu' => $activeMenu]);
    }

    // Ambil data dalam bentuk json untuk datatables 
    public function list(Request $request)
    {
        $orbits = OrbitModel::with('wilayah')
            ->select('id_orbit', 'report_orbit.id_wilayah', 'pi_hi', 'ps_hi', 'pi_tot', 'ps_tot');

        return DataTables::of($orbits)
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
