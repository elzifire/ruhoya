<?php

namespace App\Helpers;

class Hoya
{
    public static function renderDescription($data)
    {
        $morfologies = [];
        if (!empty($data['stem'])) array_push($morfologies, ["Batang", "<b>{$data["stem"]}</b>"]);
        if (!empty($data['leaves'])) array_push($morfologies, ["Daun", "<b>{$data["leaves"]}</b>"]);
        if (!empty($data['flowers'])) array_push($morfologies, ["Bentuk bunga", "<b>{$data["flowers"]}</b>"]);
        if (!empty($data['flower_buds'])) array_push($morfologies, ["Kuncup bunga", "<b>{$data["flower_buds"]}</b>"]);
        if (!empty($data['flower_size'])) array_push($morfologies, ["Ukuran bunga", "<b>{$data["flower_size"]}</b>"]);
        if (!empty($data['flower_colors'])) array_push($morfologies, ["Warna bunga", "<b>{$data["flower_colors"]}</b>"]);
        if (!empty($data['roots'])) array_push($morfologies, ["Akar", "<b>{$data["roots"]}</b>"]);
        if (!empty($data['shoots'])) array_push($morfologies, ["Tunas", "<b>{$data["shoots"]}</b>"]);

        $arr2str = implode(", ", array_map(function($item) { return implode(" ", $item); }, $morfologies));
        $arr2str = count($morfologies) ? "Memiliki ciri - ciri " . $arr2str : "";
        
        return "Hoya <i>{$data['name']}</i>, {$data['etymology']}. Berasal dari {$data['origin']}. Hoya <i>{$data['name']}</i> {$arr2str}";
    }
}