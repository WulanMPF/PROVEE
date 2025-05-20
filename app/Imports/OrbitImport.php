<?php

namespace App\Imports;

use App\Models\OrbitModel;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class OrbitImport implements ToCollection
{
    public function collection(Collection $collection)
    {
        $index = 1;
        $pi_hi_counts = [
            1 => 0, // Malang
            2 => 0, // Kediri
            3 => 0  // Madiun
        ];
        $ps_hi_counts = [
            1 => 0, // Malang
            2 => 0, // Kediri
            3 => 0  // Madiun
        ];
        $pi_tot_counts = [
            1 => [], // Malang
            2 => [], // Kediri
            3 => []  // Madiun
        ];
        $ps_tot_counts = [
            1 => [], // Malang
            2 => [], // Kediri
            3 => []  // Madiun
        ];

        $today = Carbon::now()->format('m/d/Y'); // Today's date in M/D/Y format
        $current_month = Carbon::now()->format('m-Y'); // Month and year for comparison

        foreach ($collection as $row) {
            if ($index > 1) {
                $data['WONUM']          = !empty($row[1]) ? $row[1] : '';
                $data['TGL_PI_AWAL']    = !empty($row[49]) ? Carbon::instance(Date::excelToDateTimeObject($row[49]))->format('m/d/Y') : '';
                $data['STATUS']         = !empty($row[32]) ? $row[32] : '';
                $data['DISTRICT_LAMA']  = !empty($row[8]) ? $row[8] : '';
                $data['DATECREATED']    = !empty($row[20]) ? Carbon::instance(Date::excelToDateTimeObject($row[20]))->format('m/d/Y') : '';
                $data['STATUSDATE']     = !empty($row[33]) ? Carbon::instance(Date::excelToDateTimeObject($row[33]))->format('m/d/Y') : '';

                // Calculate PI_HI counts
                if ($data['TGL_PI_AWAL'] === $today) {
                    if ($data['DISTRICT_LAMA'] == 'MALANG') {
                        $pi_hi_counts[1]++;
                    } elseif ($data['DISTRICT_LAMA'] == 'KEDIRI') {
                        $pi_hi_counts[2]++;
                    } elseif ($data['DISTRICT_LAMA'] == 'MADIUN') {
                        $pi_hi_counts[3]++;
                    }
                }

                // Calculate PS_HI counts
                if ($data['STATUSDATE'] === $today && $data['STATUS'] === 'COMPWORK') {
                    if ($data['DISTRICT_LAMA'] == 'MALANG') {
                        $ps_hi_counts[1]++;
                    } elseif ($data['DISTRICT_LAMA'] == 'KEDIRI') {
                        $ps_hi_counts[2]++;
                    } elseif ($data['DISTRICT_LAMA'] == 'MADIUN') {
                        $ps_hi_counts[3]++;
                    }
                }

                // Calculate PI_TOT counts
                $date_created_month_year = Carbon::createFromFormat('m/d/Y', $data['DATECREATED'])->format('m-Y');
                if ($date_created_month_year === $current_month) {
                    if ($data['DISTRICT_LAMA'] == 'MALANG') {
                        $pi_tot_counts[1][$data['WONUM']] = true;
                    } elseif ($data['DISTRICT_LAMA'] == 'KEDIRI') {
                        $pi_tot_counts[2][$data['WONUM']] = true;
                    } elseif ($data['DISTRICT_LAMA'] == 'MADIUN') {
                        $pi_tot_counts[3][$data['WONUM']] = true;
                    }
                }

                // Calculate PS_TOT counts
                $status_date_month_year = Carbon::createFromFormat('m/d/Y', $data['STATUSDATE'])->format('m-Y');
                if ($status_date_month_year === $current_month && $data['STATUS'] === 'COMPWORK') {
                    if ($data['DISTRICT_LAMA'] == 'MALANG') {
                        $ps_tot_counts[1][$data['WONUM']] = true;
                    } elseif ($data['DISTRICT_LAMA'] == 'KEDIRI') {
                        $ps_tot_counts[2][$data['WONUM']] = true;
                    } elseif ($data['DISTRICT_LAMA'] == 'MADIUN') {
                        $ps_tot_counts[3][$data['WONUM']] = true;
                    }
                }
            }

            $index++;
        }

        // Insert or update into the database
        foreach ($pi_hi_counts as $id_wilayah => $pi_hi_count) {
            $ps_hi_count = $ps_hi_counts[$id_wilayah];
            $pi_tot_count = count($pi_tot_counts[$id_wilayah]);
            $ps_tot_count = count($ps_tot_counts[$id_wilayah]);

            // Update or create the record
            OrbitModel::updateOrCreate(
                ['id_wilayah' => $id_wilayah], // Condition to find the record
                [
                    'pi_hi' => $pi_hi_count,
                    'ps_hi' => $ps_hi_count,
                    'pi_tot' => $pi_tot_count,
                    'ps_tot' => $ps_tot_count
                ]
            );
        }
    }
}
