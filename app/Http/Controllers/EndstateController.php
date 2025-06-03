<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\EndstateModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use App\Imports\EndstateImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Http;

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
                return $row->pi_hi != 0 ? round(($row->ps_hi / $row->pi_hi) * 100, 2) . '%' : '100%';
            })
            ->addColumn('ps_pi_tot', function ($row) {
                return $row->pi_tot != 0 ? round(($row->ps_tot / $row->pi_tot) * 100, 2) . '%' : '100%';
            })
            ->make(true);
    }

    public function import(Request $request)
    {
        return view('endstate.index');
    }

    public function import_proses(Request $request)
    {
        // dd($request->all());
        Excel::import(new EndstateImport(), $request->file('file'));
        return redirect()->back();
    }

    public function sendToTelegram(Request $request)
    {
        $request->validate([
            'screenshot' => 'required|image|mimes:png,jpg,jpeg|max:2048',
        ]);

        $image = $request->file('screenshot');
        $caption = "📢 Report Provisioning INDIHOME Jatim-3\n📸 Potret pkl. " . now()->format('H.i') . "\n📅 " . now()->format('d/m/Y');

        $botToken = env('TELEGRAM_BOT_TOKEN');
        $chatId = env('TELEGRAM_CHAT_ID');

        // Pastikan Anda memverifikasi token dan chat ID
        if (empty($botToken) || empty($chatId)) {
            return response()->json(['success' => false, 'error' => 'Bot token or chat ID not set']);
        }

        $response = Http::attach(
            'photo', file_get_contents($image), 'screenshot.png'
        )->post("https://api.telegram.org/bot{$botToken}/sendPhoto", [
            'chat_id' => $chatId,
            'caption' => $caption,
        ]);

        if ($response->successful()) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false, 'error' => $response->body()]);
        }
    }
}
