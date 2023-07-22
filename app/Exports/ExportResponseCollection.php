<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

/**
   * ExportResponseCollection is a class for exporting import-status-response or any collection into excel
*/

class ExportResponseCollection implements FromCollection, WithHeadings
{
    public $title;

    public function __construct($data, $title="")
    {
        $this->collection = $data;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return $this->collection;
    }

    public function headings(): array
    {
        $headingColumn = $this->collection->first();
        return is_array($headingColumn) ? array_keys($headingColumn) :  array_keys($headingColumn->toArray());
    }
}
