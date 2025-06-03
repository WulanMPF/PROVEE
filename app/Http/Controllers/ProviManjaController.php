<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\EndstateModel;
use App\Models\ProviManjaModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use App\Imports\ProviManjaImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Http;

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
        $provimanjas = ProviManjaModel::with('sektor')
            ->select('id_provi_manja', 'report_provi_manja.id_sektor', 'manja_expired_h-1', 'manja_hi', 'saldo_manja_h+1', 'saldo_manja_h+2', 'saldo_manja_h>2', 'total');

        return DataTables::of($provimanjas)
            ->addIndexColumn()
            ->make(true);
    }

    public function import(Request $request)
    {
        return view('provimanja.index');
    }

    public function import_proses(Request $request)
    {
        // dd($request->all());
        Excel::import(new ProviManjaImport(), $request->file('file'));
        return redirect()->back();
    }

    public function sendToTelegram(Request $request)
    {
        $request->validate([
            'screenshot' => 'required|image|mimes:png,jpg,jpeg|max:2048',
        ]);

        $image = $request->file('screenshot');
        $caption = "📢 Report Manja INDIHOME Jatim-3\n📸 Potret pkl. " . now()->format('H.i') . "\n📅 " . now()->format('d/m/Y');

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
