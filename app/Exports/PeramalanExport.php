<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PeramalanExport implements FromArray, WithHeadings
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
            'Tanggal',
            'Stok',
        ];
    }

    public function array(): array
    {
        return $this->data;
    }
}
