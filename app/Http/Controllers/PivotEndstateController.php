<?php

namespace App\Http\Controllers;

use App\Models\PivotEndstateModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Http;

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
