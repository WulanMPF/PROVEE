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
use Illuminate\Support\Facades\Http;

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
                return $row->re_hi != 0 ? round(($row->ps_hi / $row->re_hi) * 100, 2) . '%' : '100%';
            })
            ->addColumn('ps_pi_hi', function ($row) {
                return $row->pi_hi != 0 ? round(($row->ps_hi / (($row->pi_hi) + ($row->accomp))) * 100, 2) . '%' : '100%';
            })
            ->addColumn('ps_re_tot', function ($row) {
                return $row->re_tot != 0 ? round(($row->ps_tot / $row->re_tot) * 100, 2) . '%' : '100%';
            })
            ->addColumn('ps_pi_tot', function ($row) {
                return $row->pi_tot != 0 ? round(($row->ps_tot / $row->pi_tot) * 100, 2) . '%' : '100%';
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

    // public function import_proses(Request $request)
    // {
    //     // Validate the uploaded file
    //     $request->validate([
    //         'file' => 'required|file|mimes:csv,txt',
    //     ]);

    //     // Get the uploaded file
    //     $file = $request->file('file');

    //     // Call the import method in your XproImport class
    //     (new XproImport())->import($file->getRealPath());

    //     return redirect()->back();
    // }

    public function sendToTelegram(Request $request)
    {
        $request->validate([
            'screenshot' => 'required|image|mimes:png,jpg,jpeg|max:2048',
        ]);

        $image = $request->file('screenshot');
        $caption = "📢 Report Provisioning INDIBIZ Jatim-3\n📸 Potret pkl. " . now()->format('H.i') . "\n📅 " . now()->format('d/m/Y');

        $botToken = env('TELEGRAM_BOT_TOKEN');
        $chatId = env('TELEGRAM_CHAT_ID');

        // Pastikan Anda memverifikasi token dan chat ID
        if (empty($botToken) || empty($chatId)) {
            return response()->json(['success' => false, 'error' => 'Bot token or chat ID not set']);
        }

        $response = Http::attach(
            'photo',
            file_get_contents($image),
            'screenshot.png'
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
