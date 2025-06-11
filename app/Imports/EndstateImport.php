<?php

namespace App\Imports;

use App\Models\EndstateModel;
use App\Models\PivotEndstateModel;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class EndstateImport implements ToCollection
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        $index = 1;
        // [ENDSTATE] PI_HI
        $pi_hi_counts = [
            1 => 0, // Kediri
            2 => 0,  // Madiun
            3 => 0, // Malang
            4 => 0 // Jatim Barat
        ];
        // [ENDSTATE] PS_HI
        $ps_hi_counts = [
            1 => 0, // Kediri
            2 => 0,  // Madiun
            3 => 0, // Malang
            4 => 0 // Jatim Barat
        ];
        // [ENDSTATE] ACCOMP
        $accomp_counts = [
            1 => 0, // Kediri
            2 => 0,  // Madiun
            3 => 0, // Malang
            4 => 0 // Jatim Barat
        ];
        // [ENDSTATE] PI_TOT
        $pi_tot_counts = [
            1 => [], // Kediri
            2 => [],  // Madiun
            3 => [], // Malang
            4 => [] // Jatim Barat
        ];
        // [ENDSTATE] PS_TOT
        $ps_tot_counts = [
            1 => [], // Kediri
            2 => [],  // Madiun
            3 => [], // Malang
            4 => [] // Jatim Barat
        ];
        // [ENDSTATE] TARGET_TOT
        $target_tot_counts = [
            1 => 0, // Kediri
            2 => 0, // Madiun
            3 => 0, // Malang
            4 => 0  // Jatim Barat
        ];


        // [PIVOT ENDSTATE] PI_TOT
        $pvt_pi_tot = [
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
            12 => [],  // WILAYAH KEDIRI
            13 => [],  // Bojonegoro
            14 => [],  // Madiun 1
            15 => [],  // Madiun 2
            16 => [],  // Madiun 3
            17 => [],  // Magetan
            18 => [],  // Ngawi
            19 => [],  // Pacitan
            20 => [],  // Ponorogo 1
            21 => [],  // Ponorogo 2
            22 => [],  // Tuban 1
            23 => [],  // Tuban 2
            24 => [],  // WILAYAH MADIUN
            25 => [],  // Batu
            26 => [],  // Blimbing
            27 => [],  // Gadang
            28 => [],  // Karang Ploso
            29 => [],  // Kepanjen
            30 => [],  // Klojen
            31 => [],  // Malang
            32 => [],  // Pakis
            33 => [],  // Sawojajar
            34 => [],  // Singosari
            35 => [],  // Turen 1
            36 => [],  // Turen 2
            37 => [],  // WILAYAH MALANG
        ];

        // [PIVOT ENDSTATE] PS_TOT
        $pvt_ps_tot = [
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
            12 => [],  // WILAYAH KEDIRI
            13 => [],  // Bojonegoro
            14 => [],  // Madiun 1
            15 => [],  // Madiun 2
            16 => [],  // Madiun 3
            17 => [],  // Magetan
            18 => [],  // Ngawi
            19 => [],  // Pacitan
            20 => [],  // Ponorogo 1
            21 => [],  // Ponorogo 2
            22 => [],  // Tuban 1
            23 => [],  // Tuban 2
            24 => [],  // WILAYAH MADIUN
            25 => [],  // Batu
            26 => [],  // Blimbing
            27 => [],  // Gadang
            28 => [],  // Karang Ploso
            29 => [],  // Kepanjen
            30 => [],  // Klojen
            31 => [],  // Malang
            32 => [],  // Pakis
            33 => [],  // Sawojajar
            34 => [],  // Singosari
            35 => [],  // Turen 1
            36 => [],  // Turen 2
            37 => [],  // WILAYAH MALANG
        ];

        // [PIVOT ENDSTATE] CANCEL_TOT
        $pvt_cncl_tot = [
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
            12 => [],  // WILAYAH KEDIRI
            13 => [],  // Bojonegoro
            14 => [],  // Madiun 1
            15 => [],  // Madiun 2
            16 => [],  // Madiun 3
            17 => [],  // Magetan
            18 => [],  // Ngawi
            19 => [],  // Pacitan
            20 => [],  // Ponorogo 1
            21 => [],  // Ponorogo 2
            22 => [],  // Tuban 1
            23 => [],  // Tuban 2
            24 => [],  // WILAYAH MADIUN
            25 => [],  // Batu
            26 => [],  // Blimbing
            27 => [],  // Gadang
            28 => [],  // Karang Ploso
            29 => [],  // Kepanjen
            30 => [],  // Klojen
            31 => [],  // Malang
            32 => [],  // Pakis
            33 => [],  // Sawojajar
            34 => [],  // Singosari
            35 => [],  // Turen 1
            36 => [],  // Turen 2
            37 => [],  // WILAYAH MALANG
        ];

        // [PIVOT ENDSTATE] FALLOUT_TOT
        $pvt_fo_tot = [
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
            12 => [],  // WILAYAH KEDIRI
            13 => [],  // Bojonegoro
            14 => [],  // Madiun 1
            15 => [],  // Madiun 2
            16 => [],  // Madiun 3
            17 => [],  // Magetan
            18 => [],  // Ngawi
            19 => [],  // Pacitan
            20 => [],  // Ponorogo 1
            21 => [],  // Ponorogo 2
            22 => [],  // Tuban 1
            23 => [],  // Tuban 2
            24 => [],  // WILAYAH MADIUN
            25 => [],  // Batu
            26 => [],  // Blimbing
            27 => [],  // Gadang
            28 => [],  // Karang Ploso
            29 => [],  // Kepanjen
            30 => [],  // Klojen
            31 => [],  // Malang
            32 => [],  // Pakis
            33 => [],  // Sawojajar
            34 => [],  // Singosari
            35 => [],  // Turen 1
            36 => [],  // Turen 2
            37 => [],  // WILAYAH MALANG
        ];

        $today = Carbon::now()->format('m/d/Y'); // Today's date in M/D/Y format
        $current_month = Carbon::now()->format('m-Y'); // Month and year for comparison

        foreach ($collection as $row) {
            // dd($row);
            if ($index > 1) {
                $data['WONUM']          = !empty($row[1]) ? $row[1] : '';
                $data['TGL_PI_AWAL']    = !empty($row[49]) ? Carbon::instance(Date::excelToDateTimeObject($row[49]))->format('m/d/Y') : '';
                $data['STATUS']         = !empty($row[32]) ? $row[32] : '';
                $data['STATUSDATE']     = !empty($row[33]) ? Carbon::instance(Date::excelToDateTimeObject($row[33]))->format('m/d/Y') : '';
                $data['DISTRICT_LAMA']  = !empty($row[8]) ? $row[8] : '';
                $data['DISTRICT_BARU']  = !empty($row[4]) ? $row[4] : '';
                $data['STO']            = !empty($row[6]) ? $row[6] : '';
                $data['CRMORDERTYPE']   = !empty($row[2]) ? $row[2] : '';

                // dd($data);

                // [ENDSTATE] Calculate PI_HI counts
                if ($data['TGL_PI_AWAL'] === $today) {
                    $pi_hi_counts[4]++;
                    if ($data['DISTRICT_LAMA'] == 'KEDIRI') {
                        $pi_hi_counts[1]++;
                    } elseif ($data['DISTRICT_LAMA'] == 'MADIUN') {
                        $pi_hi_counts[2]++;
                    } elseif ($data['DISTRICT_LAMA'] == 'MALANG') {
                        $pi_hi_counts[3]++;
                    }
                }

                // [ENDSTATE] Calculate PS_HI counts
                if ($data['STATUSDATE'] === $today && $data['STATUS'] === 'COMPWORK') {
                    $ps_hi_counts[4]++;
                    if ($data['DISTRICT_LAMA'] == 'KEDIRI') {
                        $ps_hi_counts[1]++;
                    } elseif ($data['DISTRICT_LAMA'] == 'MADIUN') {
                        $ps_hi_counts[2]++;
                    } elseif ($data['DISTRICT_LAMA'] == 'MALANG') {
                        $ps_hi_counts[3]++;
                    }
                }

                // [ENDSTATE] Calculate ACCOMP counts
                if ($data['STATUS'] === 'ACTCOMP') {
                    $accomp_counts[4]++;
                    if ($data['DISTRICT_LAMA'] == 'KEDIRI') {
                        $accomp_counts[1]++;
                    } elseif ($data['DISTRICT_LAMA'] == 'MADIUN') {
                        $accomp_counts[2]++;
                    } elseif ($data['DISTRICT_LAMA'] == 'MALANG') {
                        $accomp_counts[3]++;
                    }
                }

                // [ENDSTATE] Calculate PI_TOT counts
                $status_created_month_year = Carbon::createFromFormat('m/d/Y', $data['STATUSDATE'])->format('m-Y');
                if ($status_created_month_year === $current_month) {
                    $pi_tot_counts[4][$data['WONUM']] = true;
                    if ($data['DISTRICT_LAMA'] == 'KEDIRI') {
                        $pi_tot_counts[1][$data['WONUM']] = true;
                    } elseif ($data['DISTRICT_LAMA'] == 'MADIUN') {
                        $pi_tot_counts[2][$data['WONUM']] = true;
                    } elseif ($data['DISTRICT_LAMA'] == 'MALANG') {
                        $pi_tot_counts[3][$data['WONUM']] = true;
                    }
                }

                // [ENDSTATE] Calculate PS_TOT counts
                $status_date_month_year = Carbon::createFromFormat('m/d/Y', $data['STATUSDATE'])->format('m-Y');
                if ($status_date_month_year === $current_month && $data['STATUS'] === 'COMPWORK') {
                    $ps_tot_counts[4][$data['WONUM']] = true;
                    if ($data['DISTRICT_LAMA'] == 'KEDIRI') {
                        $ps_tot_counts[1][$data['WONUM']] = true;
                    } elseif ($data['DISTRICT_LAMA'] == 'MADIUN') {
                        $ps_tot_counts[2][$data['WONUM']] = true;
                    } elseif ($data['DISTRICT_LAMA'] == 'MALANG') {
                        $ps_tot_counts[3][$data['WONUM']] = true;
                    }
                }

                // [ENDSTATE] Insert TARGET_TOT 
                if ($data['DISTRICT_BARU'] == 'JATIM BARAT') {
                    $target_tot_counts[4] = 5578;
                }
                if ($data['DISTRICT_LAMA'] == 'KEDIRI') {
                    $target_tot_counts[1] = 1189;
                } elseif ($data['DISTRICT_LAMA'] == 'MADIUN') {
                    $target_tot_counts[2] = 1481;
                } elseif ($data['DISTRICT_LAMA'] == 'MALANG') {
                    $target_tot_counts[3] = 2908;
                }

                // [PIVOT ENDSTATE] Calculate PI_TOT
                $status_date_pi = Carbon::createFromFormat('m/d/Y', $data['STATUSDATE'])->format('m-Y');
                if ($data['CRMORDERTYPE'] === 'CREATE' && $status_date_pi === $current_month) {
                    if ($data['DISTRICT_LAMA'] == 'KEDIRI') {
                        $pvt_pi_tot[12][$data['WONUM']] = true;
                    } elseif ($data['DISTRICT_LAMA'] == 'MADIUN') {
                        $pvt_pi_tot[24][$data['WONUM']] = true;
                    } elseif ($data['DISTRICT_LAMA'] == 'MALANG') {
                        $pvt_pi_tot[37][$data['WONUM']] = true;
                    }

                    if ($data['STO'] == 'BLR' || $data['STO'] == 'PAN') {
                        $pvt_pi_tot[1][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'GUR' || $data['STO'] == 'WAT') {
                        $pvt_pi_tot[2][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'KDI') {
                        $pvt_pi_tot[3][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'MJT') {
                        $pvt_pi_tot[4][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'NDL' || $data['STO'] == 'SBI') {
                        $pvt_pi_tot[5][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'GON' || $data['STO'] == 'NJK') {
                        $pvt_pi_tot[6][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'KAA' || $data['STO'] == 'PAE' || $data['STO'] == 'PPR') {
                        $pvt_pi_tot[7][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'DRN' || $data['STO'] == 'PRI' || $data['STO'] == 'TRE') {
                        $pvt_pi_tot[8][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'CAT' || $data['STO'] == 'KWR' || $data['STO'] == 'NGU' || $data['STO'] == 'TUL') {
                        $pvt_pi_tot[9][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'KTS' || $data['STO'] == 'PRB' || $data['STO'] == 'WRJ') {
                        $pvt_pi_tot[10][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'BNU' || $data['STO'] == 'KBN' || $data['STO'] == 'LDY' || $data['STO'] == 'WGI' || $data['STO'] == 'SNT') {
                        $pvt_pi_tot[11][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'BJN' || $data['STO'] == 'KDU' || $data['STO'] == 'PAD' || $data['STO'] == 'SMJ') {
                        $pvt_pi_tot[13][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'MNZ') {
                        $pvt_pi_tot[14][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'CRB') {
                        $pvt_pi_tot[15][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'MSP' || $data['STO'] == 'UTR') {
                        $pvt_pi_tot[16][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'GGR' || $data['STO'] == 'MGT' || $data['STO'] == 'SAR') {
                        $pvt_pi_tot[17][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'JGO' || $data['STO'] == 'KRJ' || $data['STO'] == 'NWI' || $data['STO'] == 'WKU') {
                        $pvt_pi_tot[18][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'LOG' || $data['STO'] == 'PNG' || $data['STO'] == 'PNZ') {
                        $pvt_pi_tot[19][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'PON' || $data['STO'] == 'SMO') {
                        $pvt_pi_tot[20][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'JEN' || $data['STO'] == 'PLG' || $data['STO'] == 'SAT' || $data['STO'] == 'SLH') {
                        $pvt_pi_tot[21][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'RGL' || $data['STO'] == 'TNZ') {
                        $pvt_pi_tot[22][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'BCR' || $data['STO'] == 'JTR' || $data['STO'] == 'KRK' || $data['STO'] == 'MRR') {
                        $pvt_pi_tot[23][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'BTU' || $data['STO'] == 'NTG') {
                        $pvt_pi_tot[25][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'BLB') {
                        $pvt_pi_tot[26][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'GDG') {
                        $pvt_pi_tot[27][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'KPO') {
                        $pvt_pi_tot[28][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'GKW' || $data['STO'] == 'KEP' || $data['STO'] == 'APG' || $data['STO'] == 'DNO' || $data['STO'] == 'PGK' || $data['STO'] == 'SBP') {
                        $pvt_pi_tot[29][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'KLJ') {
                        $pvt_pi_tot[30][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'MLG') {
                        $pvt_pi_tot[31][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'PKS' || $data['STO'] == 'TMP') {
                        $pvt_pi_tot[32][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'BRG' || $data['STO'] == 'SWJ') {
                        $pvt_pi_tot[33][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'LWG' || $data['STO'] == 'SGS') {
                        $pvt_pi_tot[34][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'DPT' || $data['STO'] == 'SBM') {
                        $pvt_pi_tot[35][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'TUR' || $data['STO'] == 'BNR' || $data['STO'] == 'GDI') {
                        $pvt_pi_tot[36][$data['WONUM']] = true;
                    }
                }

                // [PIVOT ENDSTATE] Calculate PS_TOT
                $status_date_ps = Carbon::createFromFormat('m/d/Y', $data['STATUSDATE'])->format('m-Y');
                if ($data['CRMORDERTYPE'] === 'CREATE' && $data['STATUS'] === 'COMPWORK' && $status_date_ps === $current_month) {
                    if ($data['DISTRICT_LAMA'] == 'KEDIRI') {
                        $pvt_ps_tot[12][$data['WONUM']] = true;
                    } elseif ($data['DISTRICT_LAMA'] == 'MADIUN') {
                        $pvt_ps_tot[24][$data['WONUM']] = true;
                    } elseif ($data['DISTRICT_LAMA'] == 'MALANG') {
                        $pvt_ps_tot[37][$data['WONUM']] = true;
                    }

                    if ($data['STO'] == 'BLR' || $data['STO'] == 'PAN') {
                        $pvt_ps_tot[1][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'GUR' || $data['STO'] == 'WAT') {
                        $pvt_ps_tot[2][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'KDI') {
                        $pvt_ps_tot[3][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'MJT') {
                        $pvt_ps_tot[4][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'NDL' || $data['STO'] == 'SBI') {
                        $pvt_ps_tot[5][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'GON' || $data['STO'] == 'NJK') {
                        $pvt_ps_tot[6][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'KAA' || $data['STO'] == 'PAE' || $data['STO'] == 'PPR') {
                        $pvt_ps_tot[7][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'DRN' || $data['STO'] == 'PRI' || $data['STO'] == 'TRE') {
                        $pvt_ps_tot[8][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'CAT' || $data['STO'] == 'KWR' || $data['STO'] == 'NGU' || $data['STO'] == 'TUL') {
                        $pvt_ps_tot[9][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'KTS' || $data['STO'] == 'PRB' || $data['STO'] == 'WRJ') {
                        $pvt_ps_tot[10][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'BNU' || $data['STO'] == 'KBN' || $data['STO'] == 'LDY' || $data['STO'] == 'WGI' || $data['STO'] == 'SNT') {
                        $pvt_ps_tot[11][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'BJN' || $data['STO'] == 'KDU' || $data['STO'] == 'PAD' || $data['STO'] == 'SMJ') {
                        $pvt_ps_tot[13][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'MNZ') {
                        $pvt_ps_tot[14][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'CRB') {
                        $pvt_ps_tot[15][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'MSP' || $data['STO'] == 'UTR') {
                        $pvt_ps_tot[16][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'GGR' || $data['STO'] == 'MGT' || $data['STO'] == 'SAR') {
                        $pvt_ps_tot[17][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'JGO' || $data['STO'] == 'KRJ' || $data['STO'] == 'NWI' || $data['STO'] == 'WKU') {
                        $pvt_ps_tot[18][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'LOG' || $data['STO'] == 'PNG' || $data['STO'] == 'PNZ') {
                        $pvt_ps_tot[19][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'PON' || $data['STO'] == 'SMO') {
                        $pvt_ps_tot[20][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'JEN' || $data['STO'] == 'PLG' || $data['STO'] == 'SAT' || $data['STO'] == 'SLH') {
                        $pvt_ps_tot[21][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'RGL' || $data['STO'] == 'TNZ') {
                        $pvt_ps_tot[22][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'BCR' || $data['STO'] == 'JTR' || $data['STO'] == 'KRK' || $data['STO'] == 'MRR') {
                        $pvt_ps_tot[23][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'BTU' || $data['STO'] == 'NTG') {
                        $pvt_ps_tot[25][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'BLB') {
                        $pvt_ps_tot[26][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'GDG') {
                        $pvt_ps_tot[27][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'KPO') {
                        $pvt_ps_tot[28][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'GKW' || $data['STO'] == 'KEP' || $data['STO'] == 'APG' || $data['STO'] == 'DNO' || $data['STO'] == 'PGK' || $data['STO'] == 'SBP') {
                        $pvt_ps_tot[29][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'KLJ') {
                        $pvt_ps_tot[30][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'MLG') {
                        $pvt_ps_tot[31][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'PKS' || $data['STO'] == 'TMP') {
                        $pvt_ps_tot[32][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'BRG' || $data['STO'] == 'SWJ') {
                        $pvt_ps_tot[33][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'LWG' || $data['STO'] == 'SGS') {
                        $pvt_ps_tot[34][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'DPT' || $data['STO'] == 'SBM') {
                        $pvt_ps_tot[35][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'TUR' || $data['STO'] == 'BNR' || $data['STO'] == 'GDI') {
                        $pvt_ps_tot[36][$data['WONUM']] = true;
                    }
                }

                // [PIVOT ENDSTATE] Calculate CANCEL_TOT
                $status_date_month_year = Carbon::createFromFormat('m/d/Y', $data['STATUSDATE'])->format('m-Y');
                if ($data['CRMORDERTYPE'] === 'CREATE' && $data['STATUS'] === 'CANCLWORK' && $status_date_month_year === $current_month) {
                    if ($data['DISTRICT_LAMA'] == 'KEDIRI') {
                        $pvt_cncl_tot[12][$data['WONUM']] = true;
                    } elseif ($data['DISTRICT_LAMA'] == 'MADIUN') {
                        $pvt_cncl_tot[24][$data['WONUM']] = true;
                    } elseif ($data['DISTRICT_LAMA'] == 'MALANG') {
                        $pvt_cncl_tot[37][$data['WONUM']] = true;
                    }

                    if ($data['STO'] == 'BLR' || $data['STO'] == 'PAN') {
                        $pvt_cncl_tot[1][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'GUR' || $data['STO'] == 'WAT') {
                        $pvt_cncl_tot[2][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'KDI') {
                        $pvt_cncl_tot[3][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'MJT') {
                        $pvt_cncl_tot[4][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'NDL' || $data['STO'] == 'SBI') {
                        $pvt_cncl_tot[5][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'GON' || $data['STO'] == 'NJK') {
                        $pvt_cncl_tot[6][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'KAA' || $data['STO'] == 'PAE' || $data['STO'] == 'PPR') {
                        $pvt_cncl_tot[7][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'DRN' || $data['STO'] == 'PRI' || $data['STO'] == 'TRE') {
                        $pvt_cncl_tot[8][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'CAT' || $data['STO'] == 'KWR' || $data['STO'] == 'NGU' || $data['STO'] == 'TUL') {
                        $pvt_cncl_tot[9][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'KTS' || $data['STO'] == 'PRB' || $data['STO'] == 'WRJ') {
                        $pvt_cncl_tot[10][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'BNU' || $data['STO'] == 'KBN' || $data['STO'] == 'LDY' || $data['STO'] == 'WGI' || $data['STO'] == 'SNT') {
                        $pvt_cncl_tot[11][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'BJN' || $data['STO'] == 'KDU' || $data['STO'] == 'PAD' || $data['STO'] == 'SMJ') {
                        $pvt_cncl_tot[13][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'MNZ') {
                        $pvt_cncl_tot[14][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'CRB') {
                        $pvt_cncl_tot[15][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'MSP' || $data['STO'] == 'UTR') {
                        $pvt_cncl_tot[16][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'GGR' || $data['STO'] == 'MGT' || $data['STO'] == 'SAR') {
                        $pvt_cncl_tot[17][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'JGO' || $data['STO'] == 'KRJ' || $data['STO'] == 'NWI' || $data['STO'] == 'WKU') {
                        $pvt_cncl_tot[18][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'LOG' || $data['STO'] == 'PNG' || $data['STO'] == 'PNZ') {
                        $pvt_cncl_tot[19][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'PON' || $data['STO'] == 'SMO') {
                        $pvt_cncl_tot[20][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'JEN' || $data['STO'] == 'PLG' || $data['STO'] == 'SAT' || $data['STO'] == 'SLH') {
                        $pvt_cncl_tot[21][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'RGL' || $data['STO'] == 'TNZ') {
                        $pvt_cncl_tot[22][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'BCR' || $data['STO'] == 'JTR' || $data['STO'] == 'KRK' || $data['STO'] == 'MRR') {
                        $pvt_cncl_tot[23][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'BTU' || $data['STO'] == 'NTG') {
                        $pvt_cncl_tot[25][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'BLB') {
                        $pvt_cncl_tot[26][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'GDG') {
                        $pvt_cncl_tot[27][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'KPO') {
                        $pvt_cncl_tot[28][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'GKW' || $data['STO'] == 'KEP' || $data['STO'] == 'APG' || $data['STO'] == 'DNO' || $data['STO'] == 'PGK' || $data['STO'] == 'SBP') {
                        $pvt_cncl_tot[29][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'KLJ') {
                        $pvt_cncl_tot[30][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'MLG') {
                        $pvt_cncl_tot[31][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'PKS' || $data['STO'] == 'TMP') {
                        $pvt_cncl_tot[32][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'BRG' || $data['STO'] == 'SWJ') {
                        $pvt_cncl_tot[33][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'LWG' || $data['STO'] == 'SGS') {
                        $pvt_cncl_tot[34][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'DPT' || $data['STO'] == 'SBM') {
                        $pvt_cncl_tot[35][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'TUR' || $data['STO'] == 'BNR' || $data['STO'] == 'GDI') {
                        $pvt_cncl_tot[36][$data['WONUM']] = true;
                    }
                }

                // [PIVOT ENDSTATE] Calculate FALLOUT_TOT
                $status_date_month_year = Carbon::createFromFormat('m/d/Y', $data['STATUSDATE'])->format('m-Y');
                if ($data['CRMORDERTYPE'] === 'CREATE' && $data['STATUS'] === 'WORKFAIL' && $status_date_month_year === $current_month) {
                    if ($data['DISTRICT_LAMA'] == 'KEDIRI') {
                        $pvt_fo_tot[12][$data['WONUM']] = true;
                    } elseif ($data['DISTRICT_LAMA'] == 'MADIUN') {
                        $pvt_fo_tot[24][$data['WONUM']] = true;
                    } elseif ($data['DISTRICT_LAMA'] == 'MALANG') {
                        $pvt_fo_tot[37][$data['WONUM']] = true;
                    } 
                    if ($data['STO'] == 'BLR' || $data['STO'] == 'PAN') {
                        $pvt_fo_tot[1][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'GUR' || $data['STO'] == 'WAT') {
                        $pvt_fo_tot[2][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'KDI') {
                        $pvt_fo_tot[3][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'MJT') {
                        $pvt_fo_tot[4][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'NDL' || $data['STO'] == 'SBI') {
                        $pvt_fo_tot[5][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'GON' || $data['STO'] == 'NJK') {
                        $pvt_fo_tot[6][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'KAA' || $data['STO'] == 'PAE' || $data['STO'] == 'PPR') {
                        $pvt_fo_tot[7][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'DRN' || $data['STO'] == 'PRI' || $data['STO'] == 'TRE') {
                        $pvt_fo_tot[8][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'CAT' || $data['STO'] == 'KWR' || $data['STO'] == 'NGU' || $data['STO'] == 'TUL') {
                        $pvt_fo_tot[9][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'KTS' || $data['STO'] == 'PRB' || $data['STO'] == 'WRJ') {
                        $pvt_fo_tot[10][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'BNU' || $data['STO'] == 'KBN' || $data['STO'] == 'LDY' || $data['STO'] == 'WGI' || $data['STO'] == 'SNT') {
                        $pvt_fo_tot[11][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'BJN' || $data['STO'] == 'KDU' || $data['STO'] == 'PAD' || $data['STO'] == 'SMJ') {
                        $pvt_fo_tot[13][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'MNZ') {
                        $pvt_fo_tot[14][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'CRB') {
                        $pvt_fo_tot[15][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'MSP' || $data['STO'] == 'UTR') {
                        $pvt_fo_tot[16][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'GGR' || $data['STO'] == 'MGT' || $data['STO'] == 'SAR') {
                        $pvt_fo_tot[17][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'JGO' || $data['STO'] == 'KRJ' || $data['STO'] == 'NWI' || $data['STO'] == 'WKU') {
                        $pvt_fo_tot[18][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'LOG' || $data['STO'] == 'PNG' || $data['STO'] == 'PNZ') {
                        $pvt_fo_tot[19][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'PON' || $data['STO'] == 'SMO') {
                        $pvt_fo_tot[20][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'JEN' || $data['STO'] == 'PLG' || $data['STO'] == 'SAT' || $data['STO'] == 'SLH') {
                        $pvt_fo_tot[21][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'RGL' || $data['STO'] == 'TNZ') {
                        $pvt_fo_tot[22][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'BCR' || $data['STO'] == 'JTR' || $data['STO'] == 'KRK' || $data['STO'] == 'MRR') {
                        $pvt_fo_tot[23][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'BTU' || $data['STO'] == 'NTG') {
                        $pvt_fo_tot[25][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'BLB') {
                        $pvt_fo_tot[26][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'GDG') {
                        $pvt_fo_tot[27][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'KPO') {
                        $pvt_fo_tot[28][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'GKW' || $data['STO'] == 'KEP' || $data['STO'] == 'APG' || $data['STO'] == 'DNO' || $data['STO'] == 'PGK' || $data['STO'] == 'SBP') {
                        $pvt_fo_tot[29][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'KLJ') {
                        $pvt_fo_tot[30][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'MLG') {
                        $pvt_fo_tot[31][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'PKS' || $data['STO'] == 'TMP') {
                        $pvt_fo_tot[32][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'BRG' || $data['STO'] == 'SWJ') {
                        $pvt_fo_tot[33][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'LWG' || $data['STO'] == 'SGS') {
                        $pvt_fo_tot[34][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'DPT' || $data['STO'] == 'SBM') {
                        $pvt_fo_tot[35][$data['WONUM']] = true;
                    } elseif ($data['STO'] == 'TUR' || $data['STO'] == 'BNR' || $data['STO'] == 'GDI') {
                        $pvt_fo_tot[36][$data['WONUM']] = true;
                    }
                }
            }

            $index++;
        }

        // [ENDSTATE] Insert or update into the database
        foreach ($pi_hi_counts as $id_wilayah => $pi_hi_count) {
            $ps_hi_count = $ps_hi_counts[$id_wilayah];
            $accomp_count = $accomp_counts[$id_wilayah];
            $pi_tot_count = count($pi_tot_counts[$id_wilayah]);
            $ps_tot_count = count($ps_tot_counts[$id_wilayah]);
            $target_tot_count = $target_tot_counts[$id_wilayah];

            // [ENDSTATE] Update or create the record
            EndstateModel::updateOrCreate(
                ['id_wilayah' => $id_wilayah], // Condition to find the record
                [
                    'pi_hi' => $pi_hi_count,
                    'ps_hi' => $ps_hi_count,
                    'accomp' => $accomp_count,
                    'pi_tot' => $pi_tot_count,
                    'ps_tot' => $ps_tot_count,
                    'target_tot' => $target_tot_count
                ]
            );
        }

        // [PIVOT ENDSTATE] Insert or update into the database
        foreach ($pvt_pi_tot as $id_sektor => $values) {
            $count_pi_tot = count($values);
            $count_ps_tot = count($pvt_ps_tot[$id_sektor]);
            $count_cncl_tot = count($pvt_cncl_tot[$id_sektor]);
            $count_fo_tot = count($pvt_fo_tot[$id_sektor]);

            PivotEndstateModel::updateOrCreate(
                ['id_sektor' => $id_sektor],
                [
                    'pi_tot' => $count_pi_tot,
                    'ps_tot' => $count_ps_tot,
                    'cancel_tot' => $count_cncl_tot,
                    'fallout_tot' => $count_fo_tot,
                ]
            );
        }
    }
}
