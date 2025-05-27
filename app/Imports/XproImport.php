<?php

namespace App\Imports;

use App\Models\OrbitModel;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class XproImport implements ToCollection
{
    public function collection(Collection $collection)
    {
        dd($collection);
    }
}
