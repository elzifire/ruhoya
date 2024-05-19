<?php

namespace App\Exports;

use App\Models\Hoya;
use App\Models\Morfology;

use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class HoyaExport implements FromCollection, WithStyles, WithHeadings, WithMapping, ShouldAutoSize
{
    public function styles(Worksheet $sheet)
    {
        return [
            1   => ['font' => ['bold' => true]],
        ];
    }

    public function headings(): array
    {
        $hoyas = ["name"];
        $morfologies = Morfology::get()->map(function($item) { return $item->name; })->toArray();

        return array_merge($hoyas, $morfologies);
    }

    public function map($hoya): array
    {
        $hoyas = [$hoya->name];
        $morfologies = collect($hoya->hoyaMorfologies ?? [])->map(function($item) { return $item->value; })->toArray();
        return array_merge($hoyas, $morfologies);
    }

    // public function columnFormats(): array
    // {
    //     return [
    //         'S' => NumberFormat::FORMAT_DATE_YYYYMMDDSLASH,
    //         'T' => NumberFormat::FORMAT_DATE_YYYYMMDDSLASH,
    //     ];
    // }

    public function collection()
    {
        return Hoya::with("hoyaMorfologies")->get();
    }
}
