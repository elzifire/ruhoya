<?php

namespace App\Exports;

use App\Models\Hoya;

use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class HoyaExport implements FromCollection, WithStyles, WithColumnFormatting, WithHeadings, WithMapping, ShouldAutoSize
{
    public function styles(Worksheet $sheet)
    {
        return [
            1   => ['font' => ['bold' => true]],
        ];
    }

    public function headings(): array
    {
        return [
            "Nama",
            "Nama Lokal",
            "Author",
            "Daerah Pertama Ditemukan",
            "Daerah Sebaran",
            "Informasi Tipe",
            "Publikasi",
            "Link Publikasi",
            "Etimologi",
            "Manfaat",
            "Batang",
            "Daun",
            "Bentuk Bunga",
            "Kuncup Bunga",
            "Ukuran Bunga",
            "Warna Bunga",
            "Akar",
            "Tunas",
            "Sistem Reproduksi",
            "Dibuat Pada",
            "Diedit Pada",
        ];
    }

    public function map($hoya): array
    {
        return [
            $hoya->name,
            $hoya->local_name,
            $hoya->author,
            $hoya->origin,
            implode(", ", array_map(function($spread) { return $spread["description"]; }, $hoya->hoyaSpreads->toArray())),
            $hoya->information_type,
            $hoya->publication,
            $hoya->publication_link,
            $hoya->etymology,
            $hoya->benefit,
            $hoya->stem,
            $hoya->leaves,
            $hoya->flowers,
            $hoya->flower_buds,
            $hoya->flower_size,
            $hoya->flower_colors,
            $hoya->roots,
            $hoya->shoots,
            $hoya->reproduction_system,
            Date::dateTimeToExcel($hoya->created_at),
            Date::dateTimeToExcel($hoya->updated_at),
        ];
    }

    public function columnFormats(): array
    {
        return [
            'S' => NumberFormat::FORMAT_DATE_YYYYMMDDSLASH,
            'T' => NumberFormat::FORMAT_DATE_YYYYMMDDSLASH,
        ];
    }

    public function collection()
    {
        return Hoya::all();
    }
}
