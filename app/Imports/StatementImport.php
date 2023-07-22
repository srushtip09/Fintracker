<?php

namespace App\Imports;

use App\Constants\BaseConstants;
use App\Exports\ExportResponseCollection;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class StatementImport implements ToCollection, WithHeadingRow
{
    public function __construct(){}

    public function collection(Collection $collection): bool
    {
        return true;
    }
}
