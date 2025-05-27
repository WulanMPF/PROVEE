<?php

namespace App\Imports;

use App\Models\ProviManjaModel;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class ProviManjaImport implements ToCollection
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        $index = 1;
        // MANJA_EXPIRED_H-1
        $h1_count = [
            1 => [],   // Blitar
            2 => [],   // Gurah
            3 => [],   // Kediri
            4 => [],   // Mojoroto
            5 => [],   // Ngadiluwih
            6 => [],   // Ngajuk
            7 => [],   // Pare
            8 => [],   // Trenggalek
            9 => [],   // Tulungagung
            10 => [],  // Warujayeng
            11 => [],  // Wlingi
            12 => [],  // Bojonegoro
            13 => [],  // Madiun 1
            14 => [],  // Madiun 2
            15 => [],  // Madiun 3
            16 => [],  // Magetan
            17 => [],  // Ngawi
            18 => [],  // Pacitan
            19 => [],  // Ponorogo 1
            20 => [],  // Ponorogo 2
            21 => [],  // Tuban 1
            22 => [],  // Tuban 2
            23 => [],  // Batu
            24 => [],  // Blimbing
            25 => [],  // Gadang
            26 => [],  // Karang Ploso
            27 => [],  // Kepanjen
            28 => [],  // Klojen
            29 => [],  // Malang
            30 => [],  // Pakis
            31 => [],  // Sawojajar
            32 => [],  // Singosari
            33 => [],  // Turen 1
            34 => [],  // Turen 2
        ];

        // MANJA_HI
        $hi_count = [
            1 => [],   // Blitar
            2 => [],   // Gurah
            3 => [],   // Kediri
            4 => [],   // Mojoroto
            5 => [],   // Ngadiluwih
            6 => [],   // Ngajuk
            7 => [],   // Pare
            8 => [],   // Trenggalek
            9 => [],   // Tulungagung
            10 => [],  // Warujayeng
            11 => [],  // Wlingi
            12 => [],  // Bojonegoro
            13 => [],  // Madiun 1
            14 => [],  // Madiun 2
            15 => [],  // Madiun 3
            16 => [],  // Magetan
            17 => [],  // Ngawi
            18 => [],  // Pacitan
            19 => [],  // Ponorogo 1
            20 => [],  // Ponorogo 2
            21 => [],  // Tuban 1
            22 => [],  // Tuban 2
            23 => [],  // Batu
            24 => [],  // Blimbing
            25 => [],  // Gadang
            26 => [],  // Karang Ploso
            27 => [],  // Kepanjen
            28 => [],  // Klojen
            29 => [],  // Malang
            30 => [],  // Pakis
            31 => [],  // Sawojajar
            32 => [],  // Singosari
            33 => [],  // Turen 1
            34 => [],  // Turen 2
        ];

        // SALDO_MANJA_H+1
        $saldo_h1_count = [
            1 => [],   // Blitar
            2 => [],   // Gurah
            3 => [],   // Kediri
            4 => [],   // Mojoroto
            5 => [],   // Ngadiluwih
            6 => [],   // Ngajuk
            7 => [],   // Pare
            8 => [],   // Trenggalek
            9 => [],   // Tulungagung
            10 => [],  // Warujayeng
            11 => [],  // Wlingi
            12 => [],  // Bojonegoro
            13 => [],  // Madiun 1
            14 => [],  // Madiun 2
            15 => [],  // Madiun 3
            16 => [],  // Magetan
            17 => [],  // Ngawi
            18 => [],  // Pacitan
            19 => [],  // Ponorogo 1
            20 => [],  // Ponorogo 2
            21 => [],  // Tuban 1
            22 => [],  // Tuban 2
            23 => [],  // Batu
            24 => [],  // Blimbing
            25 => [],  // Gadang
            26 => [],  // Karang Ploso
            27 => [],  // Kepanjen
            28 => [],  // Klojen
            29 => [],  // Malang
            30 => [],  // Pakis
            31 => [],  // Sawojajar
            32 => [],  // Singosari
            33 => [],  // Turen 1
            34 => [],  // Turen 2
        ];

        // SALDO_MANJA_H+2
        $saldo_h2_count = [
            1 => [],   // Blitar
            2 => [],   // Gurah
            3 => [],   // Kediri
            4 => [],   // Mojoroto
            5 => [],   // Ngadiluwih
            6 => [],   // Ngajuk
            7 => [],   // Pare
            8 => [],   // Trenggalek
            9 => [],   // Tulungagung
            10 => [],  // Warujayeng
            11 => [],  // Wlingi
            12 => [],  // Bojonegoro
            13 => [],  // Madiun 1
            14 => [],  // Madiun 2
            15 => [],  // Madiun 3
            16 => [],  // Magetan
            17 => [],  // Ngawi
            18 => [],  // Pacitan
            19 => [],  // Ponorogo 1
            20 => [],  // Ponorogo 2
            21 => [],  // Tuban 1
            22 => [],  // Tuban 2
            23 => [],  // Batu
            24 => [],  // Blimbing
            25 => [],  // Gadang
            26 => [],  // Karang Ploso
            27 => [],  // Kepanjen
            28 => [],  // Klojen
            29 => [],  // Malang
            30 => [],  // Pakis
            31 => [],  // Sawojajar
            32 => [],  // Singosari
            33 => [],  // Turen 1
            34 => [],  // Turen 2
        ];

        // SALDO_MANJA_H>2
        $saldo_h3_count = [
            1 => [],   // Blitar
            2 => [],   // Gurah
            3 => [],   // Kediri
            4 => [],   // Mojoroto
            5 => [],   // Ngadiluwih
            6 => [],   // Ngajuk
            7 => [],   // Pare
            8 => [],   // Trenggalek
            9 => [],   // Tulungagung
            10 => [],  // Warujayeng
            11 => [],  // Wlingi
            12 => [],  // Bojonegoro
            13 => [],  // Madiun 1
            14 => [],  // Madiun 2
            15 => [],  // Madiun 3
            16 => [],  // Magetan
            17 => [],  // Ngawi
            18 => [],  // Pacitan
            19 => [],  // Ponorogo 1
            20 => [],  // Ponorogo 2
            21 => [],  // Tuban 1
            22 => [],  // Tuban 2
            23 => [],  // Batu
            24 => [],  // Blimbing
            25 => [],  // Gadang
            26 => [],  // Karang Ploso
            27 => [],  // Kepanjen
            28 => [],  // Klojen
            29 => [],  // Malang
            30 => [],  // Pakis
            31 => [],  // Sawojajar
            32 => [],  // Singosari
            33 => [],  // Turen 1
            34 => [],  // Turen 2
        ];

        foreach ($collection as $row) {
            if ($index > 1) {
                $data['WONUM']          = !empty($row[1]) ? $row[1] : '';
                $data['TGL_MANJA']      = !empty($row[21]) ? Carbon::instance(Date::excelToDateTimeObject($row[21])) : null;
                $data['STO']            = !empty($row[6]) ? $row[6] : '';

                // Extract only the date part
                $tgl_man = $data['TGL_MANJA']->toDateString(); // Format: Y-m-d
                $today = Carbon::now()->toDateString(); // Format: Y-m-d

                // Calculate UMUR by subtracting dates
                $umur = (strtotime($today) - strtotime($tgl_man)) / (60 * 60 * 24); // Difference in days

                // Calculate MANJA
                if ($umur > 0) {
                    // EXPIRED_MANJA_H-1
                    if ($data['STO'] == 'BLR' || $data['STO'] == 'PAN') {
                        $h1_count[1][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'GUR' || $data['STO'] == 'WAT') {
                        $h1_count[2][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'KDI') {
                        $h1_count[3][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'MJT') {
                        $h1_count[4][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'NDL' || $data['STO'] == 'SBI') {
                        $h1_count[5][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'GON' || $data['STO'] == 'NJK') {
                        $h1_count[6][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'KAA' || $data['STO'] == 'PAE' || $data['STO'] == 'PPR') {
                        $h1_count[7][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'DRN' || $data['STO'] == 'PRI' || $data['STO'] == 'TRE') {
                        $h1_count[8][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'CAT' || $data['STO'] == 'KWR' || $data['STO'] == 'NGU' || $data['STO'] == 'TUL') {
                        $h1_count[9][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'KTS' || $data['STO'] == 'PRB' || $data['STO'] == 'WRJ') {
                        $h1_count[10][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'BNU' || $data['STO'] == 'KBN' || $data['STO'] == 'LDY' || $data['STO'] == 'WGI' || $data['STO'] == 'SNT') {
                        $h1_count[11][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'BJN' || $data['STO'] == 'KDU' || $data['STO'] == 'PAD' || $data['STO'] == 'SMJ') {
                        $h1_count[12][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'MNZ') {
                        $h1_count[13][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'CRB') {
                        $h1_count[14][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'MSP' || $data['STO'] == 'UTR') {
                        $h1_count[15][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'GGR' || $data['STO'] == 'MGT' || $data['STO'] == 'SAR') {
                        $h1_count[16][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'JGO' || $data['STO'] == 'KRJ' || $data['STO'] == 'NWI' || $data['STO'] == 'WKU') {
                        $h1_count[17][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'LOG' || $data['STO'] == 'PNG' || $data['STO'] == 'PNZ') {
                        $h1_count[18][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'PON' || $data['STO'] == 'SMO') {
                        $h1_count[19][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'JEN' || $data['STO'] == 'PLG' || $data['STO'] == 'SAT' || $data['STO'] == 'SLH') {
                        $h1_count[20][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'RGL' || $data['STO'] == 'TNZ') {
                        $h1_count[21][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'BCR' || $data['STO'] == 'JTR' || $data['STO'] == 'KRK' || $data['STO'] == 'MRR') {
                        $h1_count[22][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'BTU' || $data['STO'] == 'NTG') {
                        $h1_count[23][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'BLB') {
                        $h1_count[24][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'GDG') {
                        $h1_count[25][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'KPO') {
                        $h1_count[26][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'GKW' || $data['STO'] == 'KEP' || $data['STO'] == 'APG' || $data['STO'] == 'DNO' || $data['STO'] == 'PGK' || $data['STO'] == 'SBP') {
                        $h1_count[27][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'KLJ') {
                        $h1_count[28][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'MLG') {
                        $h1_count[29][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'PKS' || $data['STO'] == 'TMP') {
                        $h1_count[30][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'BRG' || $data['STO'] == 'SWJ') {
                        $h1_count[31][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'LWG' || $data['STO'] == 'SGS') {
                        $h1_count[32][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'DPT' || $data['STO'] == 'SBM') {
                        $h1_count[33][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'TUR' || $data['STO'] == 'BNR' || $data['STO'] == 'GDI') {
                        $h1_count[34][$data['WONUM']] = true;
                    }
                } elseif ($umur === 0) {
                    // MANJA_HI
                    if ($data['STO'] == 'BLR' || $data['STO'] == 'PAN') {
                        $hi_count[1][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'GUR' || $data['STO'] == 'WAT') {
                        $hi_count[2][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'KDI') {
                        $hi_count[3][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'MJT') {
                        $hi_count[4][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'NDL' || $data['STO'] == 'SBI') {
                        $hi_count[5][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'GON' || $data['STO'] == 'NJK') {
                        $hi_count[6][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'KAA' || $data['STO'] == 'PAE' || $data['STO'] == 'PPR') {
                        $hi_count[7][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'DRN' || $data['STO'] == 'PRI' || $data['STO'] == 'TRE') {
                        $hi_count[8][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'CAT' || $data['STO'] == 'KWR' || $data['STO'] == 'NGU' || $data['STO'] == 'TUL') {
                        $hi_count[9][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'KTS' || $data['STO'] == 'PRB' || $data['STO'] == 'WRJ') {
                        $hi_count[10][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'BNU' || $data['STO'] == 'KBN' || $data['STO'] == 'LDY' || $data['STO'] == 'WGI' || $data['STO'] == 'SNT') {
                        $hi_count[11][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'BJN' || $data['STO'] == 'KDU' || $data['STO'] == 'PAD' || $data['STO'] == 'SMJ') {
                        $hi_count[12][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'MNZ') {
                        $hi_count[13][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'CRB') {
                        $hi_count[14][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'MSP' || $data['STO'] == 'UTR') {
                        $hi_count[15][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'GGR' || $data['STO'] == 'MGT' || $data['STO'] == 'SAR') {
                        $hi_count[16][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'JGO' || $data['STO'] == 'KRJ' || $data['STO'] == 'NWI' || $data['STO'] == 'WKU') {
                        $hi_count[17][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'LOG' || $data['STO'] == 'PNG' || $data['STO'] == 'PNZ') {
                        $hi_count[18][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'PON' || $data['STO'] == 'SMO') {
                        $hi_count[19][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'JEN' || $data['STO'] == 'PLG' || $data['STO'] == 'SAT' || $data['STO'] == 'SLH') {
                        $hi_count[20][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'RGL' || $data['STO'] == 'TNZ') {
                        $hi_count[21][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'BCR' || $data['STO'] == 'JTR' || $data['STO'] == 'KRK' || $data['STO'] == 'MRR') {
                        $hi_count[22][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'BTU' || $data['STO'] == 'NTG') {
                        $hi_count[23][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'BLB') {
                        $hi_count[24][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'GDG') {
                        $hi_count[25][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'KPO') {
                        $hi_count[26][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'GKW' || $data['STO'] == 'KEP' || $data['STO'] == 'APG' || $data['STO'] == 'DNO' || $data['STO'] == 'PGK' || $data['STO'] == 'SBP') {
                        $hi_count[27][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'KLJ') {
                        $hi_count[28][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'MLG') {
                        $hi_count[29][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'PKS' || $data['STO'] == 'TMP') {
                        $hi_count[30][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'BRG' || $data['STO'] == 'SWJ') {
                        $hi_count[31][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'LWG' || $data['STO'] == 'SGS') {
                        $hi_count[32][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'DPT' || $data['STO'] == 'SBM') {
                        $hi_count[33][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'TUR' || $data['STO'] == 'BNR' || $data['STO'] == 'GDI') {
                        $hi_count[34][$data['WONUM']] = true;
                    }
                } elseif ($umur === -1) {
                    // SALDO_MANJA_H+1
                    if ($data['STO'] == 'BLR' || $data['STO'] == 'PAN') {
                        $saldo_h1_count[1][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'GUR' || $data['STO'] == 'WAT') {
                        $saldo_h1_count[2][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'KDI') {
                        $saldo_h1_count[3][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'MJT') {
                        $saldo_h1_count[4][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'NDL' || $data['STO'] == 'SBI') {
                        $saldo_h1_count[5][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'GON' || $data['STO'] == 'NJK') {
                        $saldo_h1_count[6][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'KAA' || $data['STO'] == 'PAE' || $data['STO'] == 'PPR') {
                        $saldo_h1_count[7][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'DRN' || $data['STO'] == 'PRI' || $data['STO'] == 'TRE') {
                        $saldo_h1_count[8][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'CAT' || $data['STO'] == 'KWR' || $data['STO'] == 'NGU' || $data['STO'] == 'TUL') {
                        $saldo_h1_count[9][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'KTS' || $data['STO'] == 'PRB' || $data['STO'] == 'WRJ') {
                        $saldo_h1_count[10][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'BNU' || $data['STO'] == 'KBN' || $data['STO'] == 'LDY' || $data['STO'] == 'WGI' || $data['STO'] == 'SNT') {
                        $saldo_h1_count[11][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'BJN' || $data['STO'] == 'KDU' || $data['STO'] == 'PAD' || $data['STO'] == 'SMJ') {
                        $saldo_h1_count[12][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'MNZ') {
                        $saldo_h1_count[13][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'CRB') {
                        $saldo_h1_count[14][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'MSP' || $data['STO'] == 'UTR') {
                        $saldo_h1_count[15][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'GGR' || $data['STO'] == 'MGT' || $data['STO'] == 'SAR') {
                        $saldo_h1_count[16][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'JGO' || $data['STO'] == 'KRJ' || $data['STO'] == 'NWI' || $data['STO'] == 'WKU') {
                        $saldo_h1_count[17][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'LOG' || $data['STO'] == 'PNG' || $data['STO'] == 'PNZ') {
                        $saldo_h1_count[18][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'PON' || $data['STO'] == 'SMO') {
                        $saldo_h1_count[19][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'JEN' || $data['STO'] == 'PLG' || $data['STO'] == 'SAT' || $data['STO'] == 'SLH') {
                        $saldo_h1_count[20][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'RGL' || $data['STO'] == 'TNZ') {
                        $saldo_h1_count[21][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'BCR' || $data['STO'] == 'JTR' || $data['STO'] == 'KRK' || $data['STO'] == 'MRR') {
                        $saldo_h1_count[22][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'BTU' || $data['STO'] == 'NTG') {
                        $saldo_h1_count[23][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'BLB') {
                        $saldo_h1_count[24][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'GDG') {
                        $saldo_h1_count[25][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'KPO') {
                        $saldo_h1_count[26][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'GKW' || $data['STO'] == 'KEP' || $data['STO'] == 'APG' || $data['STO'] == 'DNO' || $data['STO'] == 'PGK' || $data['STO'] == 'SBP') {
                        $saldo_h1_count[27][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'KLJ') {
                        $saldo_h1_count[28][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'MLG') {
                        $saldo_h1_count[29][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'PKS' || $data['STO'] == 'TMP') {
                        $saldo_h1_count[30][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'BRG' || $data['STO'] == 'SWJ') {
                        $saldo_h1_count[31][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'LWG' || $data['STO'] == 'SGS') {
                        $saldo_h1_count[32][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'DPT' || $data['STO'] == 'SBM') {
                        $saldo_h1_count[33][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'TUR' || $data['STO'] == 'BNR' || $data['STO'] == 'GDI') {
                        $saldo_h1_count[34][$data['WONUM']] = true;
                    }
                } elseif ($umur === -2) {
                    // SALDO_MANJA_H+2
                    if ($data['STO'] == 'BLR' || $data['STO'] == 'PAN') {
                        $saldo_h2_count[1][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'GUR' || $data['STO'] == 'WAT') {
                        $saldo_h2_count[2][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'KDI') {
                        $saldo_h2_count[3][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'MJT') {
                        $saldo_h2_count[4][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'NDL' || $data['STO'] == 'SBI') {
                        $saldo_h2_count[5][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'GON' || $data['STO'] == 'NJK') {
                        $saldo_h2_count[6][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'KAA' || $data['STO'] == 'PAE' || $data['STO'] == 'PPR') {
                        $saldo_h2_count[7][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'DRN' || $data['STO'] == 'PRI' || $data['STO'] == 'TRE') {
                        $saldo_h2_count[8][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'CAT' || $data['STO'] == 'KWR' || $data['STO'] == 'NGU' || $data['STO'] == 'TUL') {
                        $saldo_h2_count[9][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'KTS' || $data['STO'] == 'PRB' || $data['STO'] == 'WRJ') {
                        $saldo_h2_count[10][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'BNU' || $data['STO'] == 'KBN' || $data['STO'] == 'LDY' || $data['STO'] == 'WGI' || $data['STO'] == 'SNT') {
                        $saldo_h2_count[11][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'BJN' || $data['STO'] == 'KDU' || $data['STO'] == 'PAD' || $data['STO'] == 'SMJ') {
                        $saldo_h2_count[12][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'MNZ') {
                        $saldo_h2_count[13][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'CRB') {
                        $saldo_h2_count[14][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'MSP' || $data['STO'] == 'UTR') {
                        $saldo_h2_count[15][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'GGR' || $data['STO'] == 'MGT' || $data['STO'] == 'SAR') {
                        $saldo_h2_count[16][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'JGO' || $data['STO'] == 'KRJ' || $data['STO'] == 'NWI' || $data['STO'] == 'WKU') {
                        $saldo_h2_count[17][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'LOG' || $data['STO'] == 'PNG' || $data['STO'] == 'PNZ') {
                        $saldo_h2_count[18][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'PON' || $data['STO'] == 'SMO') {
                        $saldo_h2_count[19][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'JEN' || $data['STO'] == 'PLG' || $data['STO'] == 'SAT' || $data['STO'] == 'SLH') {
                        $saldo_h2_count[20][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'RGL' || $data['STO'] == 'TNZ') {
                        $saldo_h2_count[21][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'BCR' || $data['STO'] == 'JTR' || $data['STO'] == 'KRK' || $data['STO'] == 'MRR') {
                        $saldo_h2_count[22][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'BTU' || $data['STO'] == 'NTG') {
                        $saldo_h2_count[23][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'BLB') {
                        $saldo_h2_count[24][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'GDG') {
                        $saldo_h2_count[25][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'KPO') {
                        $saldo_h2_count[26][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'GKW' || $data['STO'] == 'KEP' || $data['STO'] == 'APG' || $data['STO'] == 'DNO' || $data['STO'] == 'PGK' || $data['STO'] == 'SBP') {
                        $saldo_h2_count[27][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'KLJ') {
                        $saldo_h2_count[28][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'MLG') {
                        $saldo_h2_count[29][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'PKS' || $data['STO'] == 'TMP') {
                        $saldo_h2_count[30][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'BRG' || $data['STO'] == 'SWJ') {
                        $saldo_h2_count[31][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'LWG' || $data['STO'] == 'SGS') {
                        $saldo_h2_count[32][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'DPT' || $data['STO'] == 'SBM') {
                        $saldo_h2_count[33][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'TUR' || $data['STO'] == 'BNR' || $data['STO'] == 'GDI') {
                        $saldo_h2_count[34][$data['WONUM']] = true;
                    }
                } elseif ($umur < -2) {
                    // SALDO_MANJA_H>2
                    if ($data['STO'] == 'BLR' || $data['STO'] == 'PAN') {
                        $saldo_h3_count[1][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'GUR' || $data['STO'] == 'WAT') {
                        $saldo_h3_count[2][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'KDI') {
                        $saldo_h3_count[3][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'MJT') {
                        $saldo_h3_count[4][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'NDL' || $data['STO'] == 'SBI') {
                        $saldo_h3_count[5][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'GON' || $data['STO'] == 'NJK') {
                        $saldo_h3_count[6][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'KAA' || $data['STO'] == 'PAE' || $data['STO'] == 'PPR') {
                        $saldo_h3_count[7][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'DRN' || $data['STO'] == 'PRI' || $data['STO'] == 'TRE') {
                        $saldo_h3_count[8][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'CAT' || $data['STO'] == 'KWR' || $data['STO'] == 'NGU' || $data['STO'] == 'TUL') {
                        $saldo_h3_count[9][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'KTS' || $data['STO'] == 'PRB' || $data['STO'] == 'WRJ') {
                        $saldo_h3_count[10][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'BNU' || $data['STO'] == 'KBN' || $data['STO'] == 'LDY' || $data['STO'] == 'WGI' || $data['STO'] == 'SNT') {
                        $saldo_h3_count[11][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'BJN' || $data['STO'] == 'KDU' || $data['STO'] == 'PAD' || $data['STO'] == 'SMJ') {
                        $saldo_h3_count[12][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'MNZ') {
                        $saldo_h3_count[13][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'CRB') {
                        $saldo_h3_count[14][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'MSP' || $data['STO'] == 'UTR') {
                        $saldo_h3_count[15][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'GGR' || $data['STO'] == 'MGT' || $data['STO'] == 'SAR') {
                        $saldo_h3_count[16][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'JGO' || $data['STO'] == 'KRJ' || $data['STO'] == 'NWI' || $data['STO'] == 'WKU') {
                        $saldo_h3_count[17][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'LOG' || $data['STO'] == 'PNG' || $data['STO'] == 'PNZ') {
                        $saldo_h3_count[18][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'PON' || $data['STO'] == 'SMO') {
                        $saldo_h3_count[19][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'JEN' || $data['STO'] == 'PLG' || $data['STO'] == 'SAT' || $data['STO'] == 'SLH') {
                        $saldo_h3_count[20][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'RGL' || $data['STO'] == 'TNZ') {
                        $saldo_h3_count[21][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'BCR' || $data['STO'] == 'JTR' || $data['STO'] == 'KRK' || $data['STO'] == 'MRR') {
                        $saldo_h3_count[22][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'BTU' || $data['STO'] == 'NTG') {
                        $saldo_h3_count[23][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'BLB') {
                        $saldo_h3_count[24][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'GDG') {
                        $saldo_h3_count[25][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'KPO') {
                        $saldo_h3_count[26][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'GKW' || $data['STO'] == 'KEP' || $data['STO'] == 'APG' || $data['STO'] == 'DNO' || $data['STO'] == 'PGK' || $data['STO'] == 'SBP') {
                        $saldo_h3_count[27][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'KLJ') {
                        $saldo_h3_count[28][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'MLG') {
                        $saldo_h3_count[29][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'PKS' || $data['STO'] == 'TMP') {
                        $saldo_h3_count[30][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'BRG' || $data['STO'] == 'SWJ') {
                        $saldo_h3_count[31][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'LWG' || $data['STO'] == 'SGS') {
                        $saldo_h3_count[32][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'DPT' || $data['STO'] == 'SBM') {
                        $saldo_h3_count[33][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'TUR' || $data['STO'] == 'BNR' || $data['STO'] == 'GDI') {
                        $saldo_h3_count[34][$data['WONUM']] = true;
                    }
                }

                // dd($umur);
            }

            $index++;
        }
        // Insert or update into the database
        foreach ($h1_count as $id_sektor => $values) {
            $count_h1 = count($values);
            $count_hi = count($hi_count[$id_sektor]);
            $count_saldo_h1 = count($saldo_h1_count[$id_sektor]);
            $count_saldo_h2 = count($saldo_h2_count[$id_sektor]);
            $count_saldo_h3 = count($saldo_h3_count[$id_sektor]);
            $total = $count_h1 + $count_hi + $count_saldo_h1 + $count_saldo_h2 + $count_saldo_h3;

            ProviManjaModel::updateOrCreate(
                ['id_sektor' => $id_sektor],
                [
                    'manja_expired_h-1' => $count_h1,
                    'manja_hi' => $count_hi,
                    'saldo_manja_h+1' => $count_saldo_h1,
                    'saldo_manja_h+2' => $count_saldo_h2,
                    'saldo_manja_h>2' => $count_saldo_h3,
                    'total' => $total,
                ]
            );
        }
    }
}
