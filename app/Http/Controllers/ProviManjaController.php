<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\EndstateModel;
use App\Models\ProviManjaModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class ProviManjaController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Report PROVI MANJA',
        ];

        $activeMenu = 'provimanja';

        return view('provimanja.index', ['breadcrumb' => $breadcrumb, 'activeMenu' => $activeMenu]);
    }

    // Ambil data dalam bentuk json untuk datatables 
    public function list(Request $request)
    {
        $provimanjas = ProviManjaModel::with('wilayah', 'sektor')
            ->select('id_provi_manja', 'report_provi_manja.id_wilayah', 'report_provi_manja.id_sektor', 'manja_expired_h-1', 'manja_hi', 'saldo_manja_h+1', 'saldo_manja_h+2', 'saldo_manja_h>2', 'total');

        return DataTables::of($provimanjas)
            ->addIndexColumn()
            ->make(true);
    }

    // METHOD STORE BELUM
    // STORE UNTUK SIMPAN FILE UPLOAD DAN MENGOLAH FILTERNYA
    // LALU HASIL STORE DIMASUKKAN KE TABEL REPORT
}
