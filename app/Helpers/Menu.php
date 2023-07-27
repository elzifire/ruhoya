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
                "url"   => "admin/",
                "icon"  => "bx bx-home"
            ],
            [
                "title" => "MASTER HOYA",
                "url"   => null,
            ],
            [
                "title" => "Hoya",
                "url"   => "admin/hoya",
                "icon"  => "bx bx-leaf"
            ],
            [
                "title" => "Asosiasi Serangga",
                "url"   => "admin/insect-association",
                "icon"  => "bx bx-bug"
            ],
            [
                "title" => "Hama",
                "url"   => "admin/pest",
                "icon"  => "bx bx-spray-can"
            ]
            ];
    }
}