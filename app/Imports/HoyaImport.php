<?php

namespace App\Imports;

use App\Models\Hoya;
use App\Models\HoyaSequence;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class HoyaImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) 
        {
            $hoyaName = $row["nama"];
            $hoya = Hoya::where("name", "like", "%$hoyaName%")->first();
            if ($hoya == null) {
                $hoya = Hoya::create([
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

            $sequences = [
                "bbcl"  => $row["sequence_rbcl"],
                "matk"  => $row["sequence_matk"],
                "nadh"  => $row["sequence_nadh"],
                "its 1" => $row["sequence_its_1"],
                "its 2" => $row["sequence_its_2"],
                "its 3" => $row["sequence_its_3"],
                "ets"   => $row["sequence_ets"],
                "psba"  => $row["sequence_psba"],
            ];

            foreach ($sequences as $key => $sequence) {
                if (isset($sequence) || !empty($sequence)) {
                    $exp = explode(";", $sequence);
                    
                    if (!empty($exp[0])) {
                        $type   = strtoupper($key);
                        $dna    = $exp[0];
                        $link   = $exp[1] ?? "";

                        HoyaSequence::create([
                            "hoya_id"       => $hoya->id,
                            "dna_type"      => trim($type),
                            "dna_sequence"  => trim($dna),
                            "link"          => trim($link),
                        ]);
                    }
                }
            }
        }
    }
}
