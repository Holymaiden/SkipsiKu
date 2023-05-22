<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class StockExport implements FromArray, WithHeadings
{

    protected $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function headings(): array
    {
        return [
            '#',
            'Product',
            'Unit',
            'Volume',
            'Date',
        ];
    }

    public function array(): array
    {
        return $this->data;
    }
}
