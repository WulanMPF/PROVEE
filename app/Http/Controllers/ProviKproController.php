<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ProviKproModel;
use App\Models\EndstateModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Http;

class ProviKproController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Report PROVI KPRO',
        ];

        $activeMenu = 'provikpro';

        // Fetch data for each region
        $regions = [
            'KDI' => EndstateModel::where('id_wilayah', 1)->first(), // Adjust ID accordingly
            'MNZ' => EndstateModel::where('id_wilayah', 2)->first(),
            'MLG' => EndstateModel::where('id_wilayah', 3)->first(),
            'JATIM BARAT' => EndstateModel::where('id_wilayah', 4)->first(),
        ];

        return view('provikpro.index', [
            'breadcrumb' => $breadcrumb,
            'activeMenu' => $activeMenu,
            'regions' => $regions,
        ]);
    }

    public function sendToTelegram(Request $request)
    {
        $request->validate([
            'text' => 'required|string|max:4096',
        ]);

        $text = $request->input('text');

        $botToken = env('TELEGRAM_BOT_TOKEN');
        $chatId = env('TELEGRAM_CHAT_ID');

        // Pastikan Anda memverifikasi token dan chat ID
        if (empty($botToken) || empty($chatId)) {
            return response()->json(['success' => false, 'error' => 'Bot token or chat ID not set']);
        }

        $response = Http::post("https://api.telegram.org/bot{$botToken}/sendMessage", [
            'chat_id' => $chatId,
            'text' => $text,
        ]);

        if ($response->successful()) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false, 'error' => $response->body()]);
        }
    }
}

    // Ambil data dalam bentuk json untuk datatables 
    // public function list(Request $request)
    // {
    //     $provikpros = ProviKproModel::with('wilayah', 'endstate', 'provimanja')
    //         ->select('id_provi_kpro', 'report_provi_kpro.id_wilayah', 'report_provi_kpro.id_endstate', 'report_provi_kpro.id_provi_manja');

    //     return DataTables::of($provikpros)
    //         ->addIndexColumn()
    //         ->addColumn('ps_accomp_tot', function ($row) {
    //             // Fetch the endstate data
    //             $endstate = DB::table('report_endstate')
    //                 ->where('id_endstate', $row->id_endstate)
    //                 ->select('ps_tot', 'accomp')
    //                 ->first();

    //             // Calculate ps_accomp_tot
    //             if ($endstate) {
    //                 $ps_accomp_tot = ($endstate->ps_tot ?? 0) + ($endstate->accomp ?? 0);

    //                 // Debugging output
    //                 dd([
    //                     'row' => $row,
    //                     'endstate' => $endstate,
    //                     'ps_accomp_tot' => $ps_accomp_tot
    //                 ]);

    //                 return $ps_accomp_tot; // Return the calculated total
    //             }

    //             return 'N/A'; // Return 'N/A' if no endstate data is found
    //         })
    //         ->make(true);
    // }

    // public function list(Request $request)
    // {
    //     $provikpros = ProviKproModel::with('wilayah', 'endstate', 'provimanja')
    //         ->select('id_provi_kpro', 'report_provi_kpro.id_wilayah', 'report_provi_kpro.id_endstate', 'report_provi_kpro.id_provi_manja');

    //     return DataTables::of($provikpros)
    //         ->addIndexColumn()
    //         ->addColumn('ps_accomp_tot', function ($row) {
    //             return $row->pi_hi != 0 ? round(($row->ps_hi / $row->pi_hi) * 100, 2) . '%' : '100%';
    //         })
    //         ->make(true);

    //     // return DataTables::of($provikpros)
    //     //     ->addIndexColumn()
    //     //     ->addColumn('ps_accomp_tot', function ($row) {
    //     //         $endstate = DB::table('report_endstate')
    //     //             ->where('id_endstate', $row->id_endstate)
    //     //             ->select('ps_tot', 'accomp')
    //     //             ->first();

    //     //         if ($endstate) {
    //     //             return $endstate->accomp != 0
    //     //                 ? round(($endstate->ps_tot / $endstate->accomp), 2)
    //     //                 : 'N/A';
    //     //         }

    //     //         return 'N/A';
    //     //     })
    //     //     ->addColumn('ps_pi_tot', function ($row) {
    //     //         $endstate = DB::table('report_endstate')
    //     //             ->where('id_endstate', $row->id_endstate)
    //     //             ->select('ps_tot', 'pi_tot')
    //     //             ->first();

    //     //         if ($endstate) {
    //     //             return $endstate->pi_tot != 0
    //     //                 ? round(($endstate->ps_tot / $endstate->pi_tot) * 100, 2) . '%'
    //     //                 : 'N/A';
    //     //         }

    //     //         return 'N/A';
    //     //     })

    //     //     ->make(true);
    // }

