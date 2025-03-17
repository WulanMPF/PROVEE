<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ProviKproModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class ProviKproController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Report PROVI KPRO',
        ];

        $activeMenu = 'provikpro';

        return view('provikpro.index', ['breadcrumb' => $breadcrumb, 'activeMenu' => $activeMenu]);
    }

    // Ambil data dalam bentuk json untuk datatables 
    public function list(Request $request)
    {
        $provikpros = ProviKproModel::with('wilayah', 'provimanja')
            ->select('id_provi_kpro', 'report_provi_kpro.id_wilayah', 'report_provi_kpro.id_endstate', 'report_provi_kpro.id_provi_manja');

        return DataTables::of($provikpros)
            ->addIndexColumn()
            ->addColumn('ps_accomp_tot', function ($row) {
                $endstate = DB::table('report_endstate')
                    ->where('id_endstate', $row->id_endstate)
                    ->select('ps_tot', 'accomp')
                    ->first();
            
                if ($endstate) {
                    return $endstate->accomp != 0 
                        ? round(($endstate->ps_tot / $endstate->accomp), 2) 
                        : 'N/A';
                }
            
                return 'N/A';
            })
            ->addColumn('ps_pi_tot', function ($row) {
                $endstate = DB::table('report_endstate')
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
             
            ->make(true);
    }

    // METHOD STORE BELUM
    // STORE UNTUK SIMPAN FILE UPLOAD DAN MENGOLAH FILTERNYA
    // LALU HASIL STORE DIMASUKKAN KE TABEL REPORT
}
