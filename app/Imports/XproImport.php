<?php

namespace App\Imports;

use App\Models\XproModel;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class XproImport implements ToCollection
{
    public function collection(Collection $collection)
    {
        $index = 1;

        // RE_HI
        $re_hi_counts = [
            1 => 0, // Kediri
            2 => 0,  // Madiun
            3 => 0, // Malang
            4 => 0 // Jatim Barat
        ];
        // PI_HI
        $pi_hi_counts = [
            1 => 0, // Kediri
            2 => 0,  // Madiun
            3 => 0, // Malang
            4 => 0 // Jatim Barat
        ];
        // PS_HI
        $ps_hi_counts = [
            1 => 0, // Kediri
            2 => 0,  // Madiun
            3 => 0, // Malang
            4 => 0 // Jatim Barat
        ];
        // ACCOMP
        $accomp_counts = [
            1 => 0, // Kediri
            2 => 0,  // Madiun
            3 => 0, // Malang
            4 => 0 // Jatim Barat
        ];
        // RE_TOT
        $re_tot_counts = [
            1 => [], // Kediri
            2 => [],  // Madiun
            3 => [], // Malang
            4 => [] // Jatim Barat
        ];
        // PI_TOT
        $pi_tot_counts = [
            1 => [], // Kediri
            2 => [],  // Madiun
            3 => [], // Malang
            4 => [] // Jatim Barat
        ];
        // PS_TOT
        $ps_tot_counts = [
            1 => [], // Kediri
            2 => [],  // Madiun
            3 => [], // Malang
            4 => [] // Jatim Barat
        ];

        $today = Carbon::now()->format('m/d/Y'); // Today's date in M/D/Y format
        $current_month = Carbon::now()->format('m-Y'); // Month and year for comparison

        foreach ($collection as $row) {
            if ($index > 1) {
                $data['ORDER_ID']             = !empty($row[1]) ? $row[1] : '';
                $data['ORDER_DATE']           = !empty($row[14]) ? Carbon::instance(Date::excelToDateTimeObject($row[14]))->format('m/d/Y') : '';
                $data['KELOMPOK_STATUS']      = !empty($row[43]) ? $row[43] : '';
                $data['LAST_UPDATED_DATE']    = !empty($row[15]) ? Carbon::instance(Date::excelToDateTimeObject($row[15]))->format('m/d/Y') : '';
                $data['STO']                  = !empty($row[7]) ? $row[7] : '';

                // dd($data);

                // Calculate RE_HI counts
                if ($data['ORDER_DATE'] === $today) {
                    $re_hi_counts[4]++;
                    if (
                        $data['STO'] == 'BTU' || $data['STO'] == 'NTG' || $data['STO'] == 'KPO' || $data['STO'] == 'GKW' || $data['STO'] == 'KEP' ||
                        $data['STO'] == 'APG' || $data['STO'] == 'DNO' || $data['STO'] == 'PGK' || $data['STO'] == 'SBP' || $data['STO'] == 'DPT' ||
                        $data['STO'] == 'SBM' || $data['STO'] == 'TUR' || $data['STO'] == 'BNR' || $data['STO'] == 'GDI' || $data['STO'] == 'BLB' ||
                        $data['STO'] == 'GDG' || $data['STO'] == 'KLJ' || $data['STO'] == 'MLG' || $data['STO'] == 'PKS' || $data['STO'] == 'TMP' ||
                        $data['STO'] == 'BRG' || $data['STO'] == 'SWJ' || $data['STO'] == 'LWG' || $data['STO'] == 'SGS'
                    ) {
                        $re_hi_counts[3]++;
                    } elseif (
                        $data['STO'] == 'KTS' || $data['STO'] == 'PRB' || $data['STO'] == 'WRJ' || $data['STO'] == 'GON' || $data['STO'] == 'NJK' ||
                        $data['STO'] == 'BNU' || $data['STO'] == 'KBN' || $data['STO'] == 'LDY' || $data['STO'] == 'WGI' || $data['STO'] == 'SNT' ||
                        $data['STO'] == 'BLR' || $data['STO'] == 'PAN' || $data['STO'] == 'NDL' || $data['STO'] == 'SBI' || $data['STO'] == 'MJT' ||
                        $data['STO'] == 'KDI' || $data['STO'] == 'CAT' || $data['STO'] == 'KWR' || $data['STO'] == 'NGU' || $data['STO'] == 'TUL' ||
                        $data['STO'] == 'PRI' || $data['STO'] == 'TRE' || $data['STO'] == 'KAA' || $data['STO'] == 'PAE' || $data['STO'] == 'PPR' ||
                        $data['STO'] == 'DRN' || $data['STO'] == 'GUR' || $data['STO'] == 'WAT'
                    ) {
                        $re_hi_counts[1]++;
                    } elseif (
                        $data['STO'] == 'BJN' || $data['STO'] == 'KDU' || $data['STO'] == 'PAD' || $data['STO'] == 'SMJ' || $data['STO'] == 'MNZ' ||
                        $data['STO'] == 'CRB' || $data['STO'] == 'MSP' || $data['STO'] == 'UTR' || $data['STO'] == 'GGR' || $data['STO'] == 'MGT' ||
                        $data['STO'] == 'SAR' || $data['STO'] == 'JGO' || $data['STO'] == 'KRJ' || $data['STO'] == 'NWI' || $data['STO'] == 'WKU' ||
                        $data['STO'] == 'LOG' || $data['STO'] == 'PNG' || $data['STO'] == 'PNZ' || $data['STO'] == 'PON' || $data['STO'] == 'SMO' ||
                        $data['STO'] == 'JEN' || $data['STO'] == 'PLG' || $data['STO'] == 'SAT' || $data['STO'] == 'SLH' || $data['STO'] == 'RGL' ||
                        $data['STO'] == 'TNZ' || $data['STO'] == 'BCR' || $data['STO'] == 'JTR' || $data['STO'] == 'KRK' || $data['STO'] == 'MRR'
                    ) {
                        $re_hi_counts[2]++;
                    }
                }

                // Calculate PI_HI counts
                if ($data['ORDER_DATE'] === $today && in_array($data['KELOMPOK_STATUS'], ['FO_WFM', 'PI', 'PS'])) {
                    $pi_hi_counts[4]++;
                    if (
                        $data['STO'] == 'BTU' || $data['STO'] == 'NTG' || $data['STO'] == 'KPO' || $data['STO'] == 'GKW' || $data['STO'] == 'KEP' ||
                        $data['STO'] == 'APG' || $data['STO'] == 'DNO' || $data['STO'] == 'PGK' || $data['STO'] == 'SBP' || $data['STO'] == 'DPT' ||
                        $data['STO'] == 'SBM' || $data['STO'] == 'TUR' || $data['STO'] == 'BNR' || $data['STO'] == 'GDI' || $data['STO'] == 'BLB' ||
                        $data['STO'] == 'GDG' || $data['STO'] == 'KLJ' || $data['STO'] == 'MLG' || $data['STO'] == 'PKS' || $data['STO'] == 'TMP' ||
                        $data['STO'] == 'BRG' || $data['STO'] == 'SWJ' || $data['STO'] == 'LWG' || $data['STO'] == 'SGS'
                    ) {
                        $pi_hi_counts[3]++;
                    } elseif (
                        $data['STO'] == 'KTS' || $data['STO'] == 'PRB' || $data['STO'] == 'WRJ' || $data['STO'] == 'GON' || $data['STO'] == 'NJK' ||
                        $data['STO'] == 'BNU' || $data['STO'] == 'KBN' || $data['STO'] == 'LDY' || $data['STO'] == 'WGI' || $data['STO'] == 'SNT' ||
                        $data['STO'] == 'BLR' || $data['STO'] == 'PAN' || $data['STO'] == 'NDL' || $data['STO'] == 'SBI' || $data['STO'] == 'MJT' ||
                        $data['STO'] == 'KDI' || $data['STO'] == 'CAT' || $data['STO'] == 'KWR' || $data['STO'] == 'NGU' || $data['STO'] == 'TUL' ||
                        $data['STO'] == 'PRI' || $data['STO'] == 'TRE' || $data['STO'] == 'KAA' || $data['STO'] == 'PAE' || $data['STO'] == 'PPR' ||
                        $data['STO'] == 'DRN' || $data['STO'] == 'GUR' || $data['STO'] == 'WAT'
                    ) {
                        $pi_hi_counts[1]++;
                    } elseif (
                        $data['STO'] == 'BJN' || $data['STO'] == 'KDU' || $data['STO'] == 'PAD' || $data['STO'] == 'SMJ' || $data['STO'] == 'MNZ' ||
                        $data['STO'] == 'CRB' || $data['STO'] == 'MSP' || $data['STO'] == 'UTR' || $data['STO'] == 'GGR' || $data['STO'] == 'MGT' ||
                        $data['STO'] == 'SAR' || $data['STO'] == 'JGO' || $data['STO'] == 'KRJ' || $data['STO'] == 'NWI' || $data['STO'] == 'WKU' ||
                        $data['STO'] == 'LOG' || $data['STO'] == 'PNG' || $data['STO'] == 'PNZ' || $data['STO'] == 'PON' || $data['STO'] == 'SMO' ||
                        $data['STO'] == 'JEN' || $data['STO'] == 'PLG' || $data['STO'] == 'SAT' || $data['STO'] == 'SLH' || $data['STO'] == 'RGL' ||
                        $data['STO'] == 'TNZ' || $data['STO'] == 'BCR' || $data['STO'] == 'JTR' || $data['STO'] == 'KRK' || $data['STO'] == 'MRR'
                    ) {
                        $pi_hi_counts[2]++;
                    }
                }

                // Calculate PS_HI counts
                if ($data['LAST_UPDATED_DATE'] === $today && $data['KELOMPOK_STATUS'] === 'PS') {
                    $ps_hi_counts[4]++;
                    if (
                        $data['STO'] == 'BTU' || $data['STO'] == 'NTG' || $data['STO'] == 'KPO' || $data['STO'] == 'GKW' || $data['STO'] == 'KEP' ||
                        $data['STO'] == 'APG' || $data['STO'] == 'DNO' || $data['STO'] == 'PGK' || $data['STO'] == 'SBP' || $data['STO'] == 'DPT' ||
                        $data['STO'] == 'SBM' || $data['STO'] == 'TUR' || $data['STO'] == 'BNR' || $data['STO'] == 'GDI' || $data['STO'] == 'BLB' ||
                        $data['STO'] == 'GDG' || $data['STO'] == 'KLJ' || $data['STO'] == 'MLG' || $data['STO'] == 'PKS' || $data['STO'] == 'TMP' ||
                        $data['STO'] == 'BRG' || $data['STO'] == 'SWJ' || $data['STO'] == 'LWG' || $data['STO'] == 'SGS'
                    ) {
                        $ps_hi_counts[3]++;
                    } elseif (
                        $data['STO'] == 'KTS' || $data['STO'] == 'PRB' || $data['STO'] == 'WRJ' || $data['STO'] == 'GON' || $data['STO'] == 'NJK' ||
                        $data['STO'] == 'BNU' || $data['STO'] == 'KBN' || $data['STO'] == 'LDY' || $data['STO'] == 'WGI' || $data['STO'] == 'SNT' ||
                        $data['STO'] == 'BLR' || $data['STO'] == 'PAN' || $data['STO'] == 'NDL' || $data['STO'] == 'SBI' || $data['STO'] == 'MJT' ||
                        $data['STO'] == 'KDI' || $data['STO'] == 'CAT' || $data['STO'] == 'KWR' || $data['STO'] == 'NGU' || $data['STO'] == 'TUL' ||
                        $data['STO'] == 'PRI' || $data['STO'] == 'TRE' || $data['STO'] == 'KAA' || $data['STO'] == 'PAE' || $data['STO'] == 'PPR' ||
                        $data['STO'] == 'DRN' || $data['STO'] == 'GUR' || $data['STO'] == 'WAT'
                    ) {
                        $ps_hi_counts[1]++;
                    } elseif (
                        $data['STO'] == 'BJN' || $data['STO'] == 'KDU' || $data['STO'] == 'PAD' || $data['STO'] == 'SMJ' || $data['STO'] == 'MNZ' ||
                        $data['STO'] == 'CRB' || $data['STO'] == 'MSP' || $data['STO'] == 'UTR' || $data['STO'] == 'GGR' || $data['STO'] == 'MGT' ||
                        $data['STO'] == 'SAR' || $data['STO'] == 'JGO' || $data['STO'] == 'KRJ' || $data['STO'] == 'NWI' || $data['STO'] == 'WKU' ||
                        $data['STO'] == 'LOG' || $data['STO'] == 'PNG' || $data['STO'] == 'PNZ' || $data['STO'] == 'PON' || $data['STO'] == 'SMO' ||
                        $data['STO'] == 'JEN' || $data['STO'] == 'PLG' || $data['STO'] == 'SAT' || $data['STO'] == 'SLH' || $data['STO'] == 'RGL' ||
                        $data['STO'] == 'TNZ' || $data['STO'] == 'BCR' || $data['STO'] == 'JTR' || $data['STO'] == 'KRK' || $data['STO'] == 'MRR'
                    ) {
                        $ps_hi_counts[2]++;
                    }
                }

                // Calculate ACCOMP counts
                if ($data['LAST_UPDATED_DATE'] === $today && $data['KELOMPOK_STATUS'] === 'ACT_COM') {
                    $accomp_counts[4]++;
                    if (
                        $data['STO'] == 'BTU' || $data['STO'] == 'NTG' || $data['STO'] == 'KPO' || $data['STO'] == 'GKW' || $data['STO'] == 'KEP' ||
                        $data['STO'] == 'APG' || $data['STO'] == 'DNO' || $data['STO'] == 'PGK' || $data['STO'] == 'SBP' || $data['STO'] == 'DPT' ||
                        $data['STO'] == 'SBM' || $data['STO'] == 'TUR' || $data['STO'] == 'BNR' || $data['STO'] == 'GDI' || $data['STO'] == 'BLB' ||
                        $data['STO'] == 'GDG' || $data['STO'] == 'KLJ' || $data['STO'] == 'MLG' || $data['STO'] == 'PKS' || $data['STO'] == 'TMP' ||
                        $data['STO'] == 'BRG' || $data['STO'] == 'SWJ' || $data['STO'] == 'LWG' || $data['STO'] == 'SGS'
                    ) {
                        $accomp_counts[3]++;
                    } elseif (
                        $data['STO'] == 'KTS' || $data['STO'] == 'PRB' || $data['STO'] == 'WRJ' || $data['STO'] == 'GON' || $data['STO'] == 'NJK' ||
                        $data['STO'] == 'BNU' || $data['STO'] == 'KBN' || $data['STO'] == 'LDY' || $data['STO'] == 'WGI' || $data['STO'] == 'SNT' ||
                        $data['STO'] == 'BLR' || $data['STO'] == 'PAN' || $data['STO'] == 'NDL' || $data['STO'] == 'SBI' || $data['STO'] == 'MJT' ||
                        $data['STO'] == 'KDI' || $data['STO'] == 'CAT' || $data['STO'] == 'KWR' || $data['STO'] == 'NGU' || $data['STO'] == 'TUL' ||
                        $data['STO'] == 'PRI' || $data['STO'] == 'TRE' || $data['STO'] == 'KAA' || $data['STO'] == 'PAE' || $data['STO'] == 'PPR' ||
                        $data['STO'] == 'DRN' || $data['STO'] == 'GUR' || $data['STO'] == 'WAT'
                    ) {
                        $accomp_counts[1]++;
                    } elseif (
                        $data['STO'] == 'BJN' || $data['STO'] == 'KDU' || $data['STO'] == 'PAD' || $data['STO'] == 'SMJ' || $data['STO'] == 'MNZ' ||
                        $data['STO'] == 'CRB' || $data['STO'] == 'MSP' || $data['STO'] == 'UTR' || $data['STO'] == 'GGR' || $data['STO'] == 'MGT' ||
                        $data['STO'] == 'SAR' || $data['STO'] == 'JGO' || $data['STO'] == 'KRJ' || $data['STO'] == 'NWI' || $data['STO'] == 'WKU' ||
                        $data['STO'] == 'LOG' || $data['STO'] == 'PNG' || $data['STO'] == 'PNZ' || $data['STO'] == 'PON' || $data['STO'] == 'SMO' ||
                        $data['STO'] == 'JEN' || $data['STO'] == 'PLG' || $data['STO'] == 'SAT' || $data['STO'] == 'SLH' || $data['STO'] == 'RGL' ||
                        $data['STO'] == 'TNZ' || $data['STO'] == 'BCR' || $data['STO'] == 'JTR' || $data['STO'] == 'KRK' || $data['STO'] == 'MRR'
                    ) {
                        $accomp_counts[2]++;
                    }
                }

                // Calculate RE_TOT counts
                if (in_array($data['KELOMPOK_STATUS'], ['CANCEL', 'FCC', 'INPROGRESS_SC', 'PI', 'PS', 'QC1', 'REJECT_FCC', 'REVOKE', 'SURVEY_NEW_MANJA', 'UNSC'])) {
                    $re_tot_counts[4][$data['ORDER_ID']] = true;
                    if (
                        $data['STO'] == 'BTU' || $data['STO'] == 'NTG' || $data['STO'] == 'KPO' || $data['STO'] == 'GKW' || $data['STO'] == 'KEP' ||
                        $data['STO'] == 'APG' || $data['STO'] == 'DNO' || $data['STO'] == 'PGK' || $data['STO'] == 'SBP' || $data['STO'] == 'DPT' ||
                        $data['STO'] == 'SBM' || $data['STO'] == 'TUR' || $data['STO'] == 'BNR' || $data['STO'] == 'GDI' || $data['STO'] == 'BLB' ||
                        $data['STO'] == 'GDG' || $data['STO'] == 'KLJ' || $data['STO'] == 'MLG' || $data['STO'] == 'PKS' || $data['STO'] == 'TMP' ||
                        $data['STO'] == 'BRG' || $data['STO'] == 'SWJ' || $data['STO'] == 'LWG' || $data['STO'] == 'SGS'
                    ) {
                        $re_tot_counts[3][$data['ORDER_ID']] = true;
                    } elseif (
                        $data['STO'] == 'KTS' || $data['STO'] == 'PRB' || $data['STO'] == 'WRJ' || $data['STO'] == 'GON' || $data['STO'] == 'NJK' ||
                        $data['STO'] == 'BNU' || $data['STO'] == 'KBN' || $data['STO'] == 'LDY' || $data['STO'] == 'WGI' || $data['STO'] == 'SNT' ||
                        $data['STO'] == 'BLR' || $data['STO'] == 'PAN' || $data['STO'] == 'NDL' || $data['STO'] == 'SBI' || $data['STO'] == 'MJT' ||
                        $data['STO'] == 'KDI' || $data['STO'] == 'CAT' || $data['STO'] == 'KWR' || $data['STO'] == 'NGU' || $data['STO'] == 'TUL' ||
                        $data['STO'] == 'PRI' || $data['STO'] == 'TRE' || $data['STO'] == 'KAA' || $data['STO'] == 'PAE' || $data['STO'] == 'PPR' ||
                        $data['STO'] == 'DRN' || $data['STO'] == 'GUR' || $data['STO'] == 'WAT'
                    ) {
                        $re_tot_counts[1][$data['ORDER_ID']] = true;
                    } elseif (
                        $data['STO'] == 'BJN' || $data['STO'] == 'KDU' || $data['STO'] == 'PAD' || $data['STO'] == 'SMJ' || $data['STO'] == 'MNZ' ||
                        $data['STO'] == 'CRB' || $data['STO'] == 'MSP' || $data['STO'] == 'UTR' || $data['STO'] == 'GGR' || $data['STO'] == 'MGT' ||
                        $data['STO'] == 'SAR' || $data['STO'] == 'JGO' || $data['STO'] == 'KRJ' || $data['STO'] == 'NWI' || $data['STO'] == 'WKU' ||
                        $data['STO'] == 'LOG' || $data['STO'] == 'PNG' || $data['STO'] == 'PNZ' || $data['STO'] == 'PON' || $data['STO'] == 'SMO' ||
                        $data['STO'] == 'JEN' || $data['STO'] == 'PLG' || $data['STO'] == 'SAT' || $data['STO'] == 'SLH' || $data['STO'] == 'RGL' ||
                        $data['STO'] == 'TNZ' || $data['STO'] == 'BCR' || $data['STO'] == 'JTR' || $data['STO'] == 'KRK' || $data['STO'] == 'MRR'
                    ) {
                        $re_tot_counts[2][$data['ORDER_ID']] = true;
                    }
                }

                // Calculate PI_TOT counts
                if (in_array($data['KELOMPOK_STATUS'], ['ACT_COM', 'FO_WFM', 'PI', 'PS'])) {
                    $pi_tot_counts[4][$data['ORDER_ID']] = true;
                    if (
                        $data['STO'] == 'BTU' || $data['STO'] == 'NTG' || $data['STO'] == 'KPO' || $data['STO'] == 'GKW' || $data['STO'] == 'KEP' ||
                        $data['STO'] == 'APG' || $data['STO'] == 'DNO' || $data['STO'] == 'PGK' || $data['STO'] == 'SBP' || $data['STO'] == 'DPT' ||
                        $data['STO'] == 'SBM' || $data['STO'] == 'TUR' || $data['STO'] == 'BNR' || $data['STO'] == 'GDI' || $data['STO'] == 'BLB' ||
                        $data['STO'] == 'GDG' || $data['STO'] == 'KLJ' || $data['STO'] == 'MLG' || $data['STO'] == 'PKS' || $data['STO'] == 'TMP' ||
                        $data['STO'] == 'BRG' || $data['STO'] == 'SWJ' || $data['STO'] == 'LWG' || $data['STO'] == 'SGS'
                    ) {
                        $pi_tot_counts[3][$data['ORDER_ID']] = true;
                    } elseif (
                        $data['STO'] == 'KTS' || $data['STO'] == 'PRB' || $data['STO'] == 'WRJ' || $data['STO'] == 'GON' || $data['STO'] == 'NJK' ||
                        $data['STO'] == 'BNU' || $data['STO'] == 'KBN' || $data['STO'] == 'LDY' || $data['STO'] == 'WGI' || $data['STO'] == 'SNT' ||
                        $data['STO'] == 'BLR' || $data['STO'] == 'PAN' || $data['STO'] == 'NDL' || $data['STO'] == 'SBI' || $data['STO'] == 'MJT' ||
                        $data['STO'] == 'KDI' || $data['STO'] == 'CAT' || $data['STO'] == 'KWR' || $data['STO'] == 'NGU' || $data['STO'] == 'TUL' ||
                        $data['STO'] == 'PRI' || $data['STO'] == 'TRE' || $data['STO'] == 'KAA' || $data['STO'] == 'PAE' || $data['STO'] == 'PPR' ||
                        $data['STO'] == 'DRN' || $data['STO'] == 'GUR' || $data['STO'] == 'WAT'
                    ) {
                        $pi_tot_counts[1][$data['ORDER_ID']] = true;
                    } elseif (
                        $data['STO'] == 'BJN' || $data['STO'] == 'KDU' || $data['STO'] == 'PAD' || $data['STO'] == 'SMJ' || $data['STO'] == 'MNZ' ||
                        $data['STO'] == 'CRB' || $data['STO'] == 'MSP' || $data['STO'] == 'UTR' || $data['STO'] == 'GGR' || $data['STO'] == 'MGT' ||
                        $data['STO'] == 'SAR' || $data['STO'] == 'JGO' || $data['STO'] == 'KRJ' || $data['STO'] == 'NWI' || $data['STO'] == 'WKU' ||
                        $data['STO'] == 'LOG' || $data['STO'] == 'PNG' || $data['STO'] == 'PNZ' || $data['STO'] == 'PON' || $data['STO'] == 'SMO' ||
                        $data['STO'] == 'JEN' || $data['STO'] == 'PLG' || $data['STO'] == 'SAT' || $data['STO'] == 'SLH' || $data['STO'] == 'RGL' ||
                        $data['STO'] == 'TNZ' || $data['STO'] == 'BCR' || $data['STO'] == 'JTR' || $data['STO'] == 'KRK' || $data['STO'] == 'MRR'
                    ) {
                        $pi_tot_counts[2][$data['ORDER_ID']] = true;
                    }
                }

                // Calculate PS_TOT counts
                if ($data['KELOMPOK_STATUS'] === 'PS') {
                    $ps_tot_counts[4][$data['ORDER_ID']] = true;
                    if (
                        $data['STO'] == 'BTU' || $data['STO'] == 'NTG' || $data['STO'] == 'KPO' || $data['STO'] == 'GKW' || $data['STO'] == 'KEP' ||
                        $data['STO'] == 'APG' || $data['STO'] == 'DNO' || $data['STO'] == 'PGK' || $data['STO'] == 'SBP' || $data['STO'] == 'DPT' ||
                        $data['STO'] == 'SBM' || $data['STO'] == 'TUR' || $data['STO'] == 'BNR' || $data['STO'] == 'GDI' || $data['STO'] == 'BLB' ||
                        $data['STO'] == 'GDG' || $data['STO'] == 'KLJ' || $data['STO'] == 'MLG' || $data['STO'] == 'PKS' || $data['STO'] == 'TMP' ||
                        $data['STO'] == 'BRG' || $data['STO'] == 'SWJ' || $data['STO'] == 'LWG' || $data['STO'] == 'SGS'
                    ) {
                        $ps_tot_counts[3][$data['ORDER_ID']] = true;
                    } elseif (
                        $data['STO'] == 'KTS' || $data['STO'] == 'PRB' || $data['STO'] == 'WRJ' || $data['STO'] == 'GON' || $data['STO'] == 'NJK' ||
                        $data['STO'] == 'BNU' || $data['STO'] == 'KBN' || $data['STO'] == 'LDY' || $data['STO'] == 'WGI' || $data['STO'] == 'SNT' ||
                        $data['STO'] == 'BLR' || $data['STO'] == 'PAN' || $data['STO'] == 'NDL' || $data['STO'] == 'SBI' || $data['STO'] == 'MJT' ||
                        $data['STO'] == 'KDI' || $data['STO'] == 'CAT' || $data['STO'] == 'KWR' || $data['STO'] == 'NGU' || $data['STO'] == 'TUL' ||
                        $data['STO'] == 'PRI' || $data['STO'] == 'TRE' || $data['STO'] == 'KAA' || $data['STO'] == 'PAE' || $data['STO'] == 'PPR' ||
                        $data['STO'] == 'DRN' || $data['STO'] == 'GUR' || $data['STO'] == 'WAT'
                    ) {
                        $ps_tot_counts[1][$data['ORDER_ID']] = true;
                    } elseif (
                        $data['STO'] == 'BJN' || $data['STO'] == 'KDU' || $data['STO'] == 'PAD' || $data['STO'] == 'SMJ' || $data['STO'] == 'MNZ' ||
                        $data['STO'] == 'CRB' || $data['STO'] == 'MSP' || $data['STO'] == 'UTR' || $data['STO'] == 'GGR' || $data['STO'] == 'MGT' ||
                        $data['STO'] == 'SAR' || $data['STO'] == 'JGO' || $data['STO'] == 'KRJ' || $data['STO'] == 'NWI' || $data['STO'] == 'WKU' ||
                        $data['STO'] == 'LOG' || $data['STO'] == 'PNG' || $data['STO'] == 'PNZ' || $data['STO'] == 'PON' || $data['STO'] == 'SMO' ||
                        $data['STO'] == 'JEN' || $data['STO'] == 'PLG' || $data['STO'] == 'SAT' || $data['STO'] == 'SLH' || $data['STO'] == 'RGL' ||
                        $data['STO'] == 'TNZ' || $data['STO'] == 'BCR' || $data['STO'] == 'JTR' || $data['STO'] == 'KRK' || $data['STO'] == 'MRR'
                    ) {
                        $ps_tot_counts[2][$data['ORDER_ID']] = true;
                    }
                }
            }
            $index++;
        }
        // Insert or update into the database
        foreach ($re_hi_counts as $id_wilayah => $re_hi_count) {
            $pi_hi_count = $pi_hi_counts[$id_wilayah];
            $ps_hi_count = $ps_hi_counts[$id_wilayah];
            $accomp_count = $accomp_counts[$id_wilayah];
            $re_tot_count = count($re_tot_counts[$id_wilayah]);
            $pi_tot_count = count($pi_tot_counts[$id_wilayah]);
            $ps_tot_count = count($ps_tot_counts[$id_wilayah]);

            // Update or create the record
            XproModel::updateOrCreate(
                ['id_wilayah' => $id_wilayah], // Condition to find the record
                [
                    're_hi' => $re_hi_count,
                    'pi_hi' => $pi_hi_count,
                    'ps_hi' => $ps_hi_count,
                    'accomp' => $accomp_count,
                    're_tot' => $re_tot_count,
                    'pi_tot' => $pi_tot_count,
                    'ps_tot' => $ps_tot_count,
                ]
            );
        }
    }
}
