<?php

namespace App\Imports;

use App\Models\Hoya;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class HoyaImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Hoya([
            "name"                  => $row["nama"],
            "local_name"            => $row["nama_lokal"],
            "author"                => $row["author"],
            "origin"                => $row["daerah_asal"],
            "type_information"      => $row["informasi_tipe"],
            "publication"           => $row["publikasi"],
            "publication_link"      => $row["link_publikasi"],
            "etymology"             => $row["etimologi"],
            "benefit"               => $row["manfaat"],
            "stem"                  => $row["batang"],
            "leaves"                => $row["daun"],
            "flowers"               => $row["bentuk_bunga"],
            "flower_buds"           => $row["kelopak_bunga"],
            "flower_size"           => $row["ukuran_bunga"],
            "flower_colors"         => $row["warna_bunga"],
            "roots"                 => $row["akar"],
            "shoots"                => $row["tunas"],
            "reproduction_system"   => $row["sistem_reproduksi"],
        ]);
    }
}
