<?php

namespace App\Helpers;

class Menu
{
    public static function get()
    {
        return [
            [
                "title" => "MENU",
                "url"   => null,
            ],
            [
                "title" => "Dashboard",
                "url"   => "",
                "icon"  => "bx bx-home"
            ],
            [
                "title" => "MASTER HOYA",
                "url"   => null,
            ],
            [
                "title" => "Hoya",
                "url"   => "hoya",
                "icon"  => "bx bx-leaf"
            ],
            [
                "title" => "Asosiasi Serangga",
                "url"   => "insect-association",
                "icon"  => "bx bx-bug"
            ],
            [
                "title" => "Hama",
                "url"   => "pest",
                "icon"  => "bx bx-spray-can"
            ]
            ];
    }
}