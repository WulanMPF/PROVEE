<?php

namespace App\Imports;

use App\Models\XproModel;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
use Carbon\Carbon;

class XproImport implements ToModel, WithHeadingRow, WithCustomCsvSettings
{
    /**
     * Set custom delimiter untuk CSV
     */
    public function getCsvSettings(): array
    {
        return [
            'delimiter' => '#',
        ];
    }

    /**
     * @param array $row
     * 
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        // PERHITUNGAN HARI INI
        // Konversi format tanggal di file CSV ke format Carbon
        $orderDate = Carbon::parse($row['ORDER_DATE']);

        // Cek apakah ORDER_DATE adalah hari ini
        if ($orderDate->isToday()) {

            // PERHITUNGAN RE HI
            // Hitung jumlah distinct ORDER_ID untuk hari ini
            $distinctREHICount = XproModel::whereDate('ORDER_DATE', Carbon::today())
                ->distinct('ORDER_ID')
                ->count();

            return new XproModel([
                're_hi' => $distinctREHICount,
            ]);

            // PERHITUNGAN PI HI
            // Hitung jumlah distinct ORDER_ID untuk hari ini
            $distinctPIHICount = XproModel::whereDate('ORDER_DATE', Carbon::today())
                ->whereIn('KELOMPOK_STATUS', ['FO_WFM', 'PI', 'PS'])
                ->distinct('ORDER_ID')
                ->count();

            return new XproModel([
                'pi_hi' => $distinctPIHICount,
            ]);
        }
    }
}
